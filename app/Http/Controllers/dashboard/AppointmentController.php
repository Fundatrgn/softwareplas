<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Services;
use App\Models\Setting;
use App\Models\User;
use App\Services\AppointmentNotificationService;
use App\Services\AvailabilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AppointmentController extends Controller
{
    /**
     * CRM randevu takvimi (ay görünümü).
     */
    public function index()
    {
        return view('dashboard.randevular.index');
    }

    /**
     * AJAX: ay içindeki her gün için doluluk özeti.
     * GET /admin/randevular/ay?ay=2026-09
     */
    public function month(Request $request)
    {
        $ay = $request->query('ay');
        $start = ($ay ? Carbon::parse($ay . '-01') : Carbon::now())->startOfMonth();
        $end = $start->copy()->endOfMonth();

        $availability = new AvailabilityService();

        $counts = Appointment::blocking()
            ->whereBetween('starts_at', [$start->copy()->startOfDay(), $end->copy()->endOfDay()])
            ->get()
            ->groupBy(fn ($a) => $a->starts_at->format('Y-m-d'))
            ->map->count();

        $days = [];
        $cursor = $start->copy();
        while ($cursor->lte($end)) {
            $info = $availability->dayAvailability($cursor->copy());
            $days[] = [
                'date' => $info['date'],
                'closed' => $info['closed'],
                'past' => $info['past'],
                'full' => $info['full'],
                'total_slots' => count($info['slots']),
                'booked_count' => $counts->get($info['date'], 0),
            ];
            $cursor->addDay();
        }

        return response()->json(['month' => $start->format('Y-m'), 'days' => $days]);
    }

    /**
     * AJAX: bir günün saat bazlı görünümü (slot + o slotta kim var).
     * GET /admin/randevular/gun?tarih=2026-09-20
     */
    public function day(Request $request)
    {
        $tarih = $request->query('tarih');
        $request->validate(['tarih' => 'required|date']);

        $date = Carbon::parse($tarih)->startOfDay();
        $availability = new AvailabilityService();
        $info = $availability->dayAvailability($date);

        $appointments = Appointment::with('patient', 'service')
            ->onDate($date->toDateString())
            ->blocking()
            ->orderBy('starts_at')
            ->get()
            ->keyBy(fn ($a) => $a->starts_at->format('H:i'));

        $slots = array_map(function ($slot) use ($appointments) {
            $appointment = $appointments->get($slot['time']);
            return [
                'time' => $slot['time'],
                'available' => $slot['available'],
                'appointment' => $appointment ? [
                    'id' => $appointment->id,
                    'patient_name' => $appointment->patient_name_snapshot ?? $appointment->patient?->name,
                    'status' => $appointment->status,
                    'status_label' => $appointment->statusLabel(),
                    'service' => $appointment->service?->title,
                ] : null,
            ];
        }, $info['slots']);

        return response()->json([
            'date' => $info['date'],
            'closed' => $info['closed'],
            'past' => $info['past'],
            'slots' => $slots,
        ]);
    }

    /**
     * Yeni randevu formu (CRM'den — planlı ya da yüz yüze gelen danışan için).
     * GET /admin/randevular/ekle?tarih=&saat=
     */
    public function create(Request $request)
    {
        return view('dashboard.randevular.add', [
            'hizmetler' => Services::orderBy('order', 'ASC')->get(),
            'psikologlar' => User::orderBy('name')->get(),
            'tarih' => $request->query('tarih'),
            'saat' => $request->query('saat'),
        ]);
    }

    /**
     * AJAX: telefon/isimle danışan arama (otomatik tamamlama).
     * GET /admin/danisanlar/ara?q=
     */
    public function searchPatients(Request $request)
    {
        $q = trim((string) $request->query('q'));
        if ($q === '') {
            return response()->json([]);
        }

        $patients = Patient::where('name', 'like', "%{$q}%")
            ->orWhere('phone', 'like', "%{$q}%")
            ->orderBy('name')
            ->limit(10)
            ->get(['id', 'name', 'phone', 'email']);

        return response()->json($patients);
    }

    public function store(Request $request, AppointmentNotificationService $notifier)
    {
        $request->validate([
            'patient_id' => 'nullable|exists:patients,id',
            'name' => 'required_without:patient_id|string|max:255',
            'phone' => 'required_without:patient_id|string|max:32',
            'email' => 'nullable|email|max:255',
            'service_id' => 'nullable|exists:services,id',
            'user_id' => 'nullable|exists:users,id',
            'tarih' => 'required|date',
            'saat' => 'required|date_format:H:i',
            'not' => 'nullable|string|max:2000',
            'source' => 'required|in:panel,yuz_yuze',
        ]);

        $startsAt = Carbon::parse($request->tarih . ' ' . $request->saat);

        $settings = Setting::first();
        $availability = new AvailabilityService($settings);

        if (! $availability->isSlotAvailable($startsAt)) {
            return redirect()->back()->withInput()->with('error', 'Bu saat dolu ya da uygun değil. Lütfen başka bir saat seçin.');
        }

        if ($request->patient_id) {
            $patient = Patient::findOrFail($request->patient_id);
            if ($request->filled('name')) {
                $patient->name = $request->name;
            }
            if ($request->filled('email')) {
                $patient->email = $request->email;
            }
            if ($request->filled('phone')) {
                $patient->phone = $request->phone;
            }
            $patient->save();
        } else {
            $patient = Patient::firstOrCreate(
                ['phone' => $request->phone],
                ['name' => $request->name, 'email' => $request->email]
            );
            if ($patient->wasRecentlyCreated === false) {
                $patient->fill(['name' => $request->name, 'email' => $request->email ?: $patient->email])->save();
            }
        }

        $duration = $availability->slotDuration();

        $appointment = Appointment::create([
            'patient_id' => $patient->id,
            'service_id' => $request->service_id,
            'user_id' => $request->user_id,
            'created_by' => auth()->id(),
            'starts_at' => $startsAt,
            'ends_at' => $startsAt->copy()->addMinutes($duration),
            'duration_minutes' => $duration,
            'status' => Appointment::STATUS_CONFIRMED,
            'source' => $request->source,
            'patient_name_snapshot' => $patient->name,
            'patient_phone_snapshot' => $patient->phone,
            'patient_email_snapshot' => $patient->email,
            'request_note' => $request->not,
        ]);

        $notifier->notifyCreated($appointment);

        return redirect('/admin/randevular/' . $appointment->id)->with('success', 'Randevu oluşturuldu.');
    }

    public function show($id)
    {
        $appointment = Appointment::with('patient', 'service', 'psychologist', 'notificationLogs')->findOrFail($id);

        return view('dashboard.randevular.show', ['appointment' => $appointment]);
    }

    public function updateStatus(Request $request, $id, AppointmentNotificationService $notifier)
    {
        $appointment = Appointment::findOrFail($id);

        $request->validate([
            'status' => 'required|in:' . implode(',', array_keys(Appointment::STATUSES)),
            'doctor_notes' => 'nullable|string',
            'cancel_reason' => 'nullable|string',
        ]);

        if ($request->status === Appointment::STATUS_COMPLETED) {
            $notes = trim((string) ($request->doctor_notes ?? $appointment->doctor_notes));
            if ($notes === '') {
                return redirect()->back()->withInput()->with('error', 'Randevuyu "Tamamlandı" olarak işaretlemek için doktor notu girmeniz zorunludur.');
            }
            $appointment->doctor_notes = $notes;
        } elseif ($request->filled('doctor_notes')) {
            $appointment->doctor_notes = $request->doctor_notes;
        }

        if ($request->status === Appointment::STATUS_CANCELLED) {
            $appointment->cancel_reason = $request->cancel_reason;
        }

        $appointment->status = $request->status;
        $appointment->save();

        $notifier->notifyStatusChanged($appointment);

        return redirect()->back()->with('success', 'Randevu durumu güncellendi: ' . $appointment->statusLabel());
    }
}
