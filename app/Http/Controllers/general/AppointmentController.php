<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Services;
use App\Models\Setting;
use App\Services\AppointmentNotificationService;
use App\Services\AvailabilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    public function index()
    {
        $hizmetler = Services::orderBy('order', 'ASC')->get();

        return view('general.randevu', [
            'hizmetler' => $hizmetler,
        ]);
    }

    /**
     * AJAX: bir ay için gün gün müsaitlik durumu (kapalı/dolu/müsait/geçmiş).
     * GET /randevu/musaitlik?ay=2026-09
     */
    public function monthAvailability(Request $request)
    {
        $ay = $request->query('ay');
        $start = $ay ? Carbon::parse($ay . '-01') : Carbon::now()->startOfMonth();
        $start = $start->copy()->startOfMonth();
        $end = $start->copy()->endOfMonth();

        $availability = new AvailabilityService();

        $days = [];
        $cursor = $start->copy();
        while ($cursor->lte($end)) {
            $info = $availability->dayAvailability($cursor->copy());
            $days[] = [
                'date' => $info['date'],
                'closed' => $info['closed'],
                'past' => $info['past'],
                'full' => $info['full'],
            ];
            $cursor->addDay();
        }

        return response()->json([
            'month' => $start->format('Y-m'),
            'days' => $days,
        ]);
    }

    /**
     * AJAX: bir günün müsait/dolu saatleri.
     * GET /randevu/saatler?tarih=2026-09-20
     */
    public function dayAvailability(Request $request)
    {
        $tarih = $request->query('tarih');

        $validator = Validator::make(['tarih' => $tarih], [
            'tarih' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Geçersiz tarih.'], 422);
        }

        $date = Carbon::parse($tarih)->startOfDay();
        $availability = new AvailabilityService();

        return response()->json($availability->dayAvailability($date));
    }

    public function store(Request $request, AppointmentNotificationService $notifier)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:32',
            'email' => 'nullable|email|max:255',
            'service_id' => 'nullable|exists:services,id',
            'tarih' => 'required|date',
            'saat' => 'required|date_format:H:i',
            'not' => 'nullable|string|max:2000',
            'kvkk_onay' => 'required|accepted',
        ], [
            'kvkk_onay.required' => 'Devam etmek için KVKK metnini onaylamanız gerekir.',
            'kvkk_onay.accepted' => 'Devam etmek için KVKK metnini onaylamanız gerekir.',
        ]);

        $startsAt = Carbon::parse($request->tarih . ' ' . $request->saat);

        if ($startsAt->lt(Carbon::now())) {
            return redirect()->back()->withInput()->with('error', 'Geçmiş bir tarih/saat için randevu alınamaz.');
        }

        $settings = Setting::first();
        $availability = new AvailabilityService($settings);

        if (! $availability->isSlotAvailable($startsAt)) {
            return redirect()->back()->withInput()->with('error', 'Seçtiğiniz saat maalesef az önce doldu. Lütfen başka bir saat seçin.');
        }

        $patient = Patient::where('phone', $request->phone)->first();
        if (! $patient) {
            $patient = Patient::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'kvkk_approved' => true,
            ]);
        } else {
            $patient->fill([
                'name' => $request->name,
                'email' => $request->email ?: $patient->email,
                'kvkk_approved' => true,
            ])->save();
        }

        $duration = $availability->slotDuration();

        $appointment = Appointment::create([
            'patient_id' => $patient->id,
            'service_id' => $request->service_id,
            'starts_at' => $startsAt,
            'ends_at' => $startsAt->copy()->addMinutes($duration),
            'duration_minutes' => $duration,
            'status' => Appointment::STATUS_PENDING,
            'source' => Appointment::SOURCE_WEB,
            'patient_name_snapshot' => $patient->name,
            'patient_phone_snapshot' => $patient->phone,
            'patient_email_snapshot' => $patient->email,
            'request_note' => $request->not,
        ]);

        $notifier->notifyCreated($appointment);

        return redirect('/randevu')->with('success', 'Randevu talebiniz alındı! ' . $startsAt->translatedFormat('d F Y, H:i') . ' için kaydınız oluşturuldu. En kısa sürede sizinle iletişime geçilecektir.');
    }

    /**
     * Danışanın, e-postasındaki imzalı (signed) linke tıklayarak kendi
     * randevusunu giriş yapmadan iptal edebilmesi. Link sahte/tahmin
     * edilemez olsun diye Laravel'in imzalı URL mekanizması kullanılır
     * (bkz. App\Mail\AppointmentNotificationMail); imza geçersizse/
     * değiştirilmişse "signed" middleware 403 döner.
     */
    public function cancel(Request $request, $id, AppointmentNotificationService $notifier)
    {
        $appointment = Appointment::findOrFail($id);

        if (in_array($appointment->status, [Appointment::STATUS_CANCELLED, Appointment::STATUS_COMPLETED, Appointment::STATUS_NO_SHOW], true)) {
            return view('general.randevu-iptal', [
                'appointment' => $appointment,
                'zatenIslendi' => true,
            ]);
        }

        $appointment->status = Appointment::STATUS_CANCELLED;
        $appointment->cancel_reason = 'Danışan tarafından e-posta linki ile iptal edildi.';
        $appointment->save();

        $notifier->notifyStatusChanged($appointment);

        return view('general.randevu-iptal', [
            'appointment' => $appointment,
            'zatenIslendi' => false,
        ]);
    }
}
