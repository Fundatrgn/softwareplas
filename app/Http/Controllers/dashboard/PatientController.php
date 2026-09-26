<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Test;
use App\Services\PatientPortalService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q'));

        $patients = Patient::withCount('appointments')
            ->when($q !== '', function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%")
                    ->orWhere('username', 'like', "%{$q}%");
            })
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        return view('dashboard.danisanlar.index', ['data' => $patients, 'q' => $q]);
    }

    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        $appointments = $patient->appointments()
            ->with('service', 'psychologist')
            ->orderByDesc('starts_at')
            ->get();

        $gelmediSayisi = $appointments->where('status', \App\Models\Appointment::STATUS_NO_SHOW)->count();

        $testAssignments = $patient->testAssignments()->with('test')->orderByDesc('created_at')->get();
        $tests = Test::orderBy('name')->get();

        return view('dashboard.danisanlar.show', [
            'patient' => $patient,
            'appointments' => $appointments,
            'gelmediSayisi' => $gelmediSayisi,
            'testAssignments' => $testAssignments,
            'tests' => $tests,
        ]);
    }

    /**
     * Danışan Portalı şifresini (yoksa oluşturarak, varsa sıfırlayarak)
     * üretir ve danışana e-posta ile gönderir. Danışan kendisi şifresini
     * asla sıfırlayamaz — bu bilerek sadece buradan tetiklenir.
     */
    public function resetPortalPassword($id, PatientPortalService $portal)
    {
        $patient = Patient::findOrFail($id);

        if (empty($patient->email)) {
            return redirect()->back()->with('error', 'Bu danışanın kayıtlı bir e-postası yok; portal şifresi gönderilemedi. Önce e-posta adresini ekleyin.');
        }

        $portal->resetPassword($patient);

        return redirect()->back()->with('success', 'Danışan portalı giriş bilgileri oluşturuldu/sıfırlandı ve e-posta ile gönderildi.');
    }

    /**
     * Admin/psikolog danışan için ELLE bir şifre belirler (yüz yüze
     * görüşmede e-posta beklemeden sözlü iletmek için). İsterse aynı
     * anda bilgilendirme e-postası da gönderilebilir.
     */
    public function setPortalPassword(Request $request, $id, PatientPortalService $portal)
    {
        $patient = Patient::findOrFail($id);

        $request->validate([
            'yeni_sifre' => 'required|string|min:4|max:64',
        ]);

        $portal->setPassword($patient, $request->yeni_sifre, $request->boolean('eposta_gonder'));

        return redirect()->back()->with('success', 'Danışan portalı şifresi belirlendi' . ($request->boolean('eposta_gonder') ? ' ve e-posta ile gönderildi.' : '.'));
    }

    /**
     * Bir danışanın tüm randevu/seans geçmişini ve doktor notlarını
     * PDF olarak indirir. "Telefon numarasıyla sorgulama" akışı: admin
     * Danışanlar listesinde telefonla arar, danışana tıklar, detay
     * sayfasındaki bu butondan raporu indirir.
     */
    public function pdfReport($id)
    {
        $patient = Patient::findOrFail($id);
        $appointments = $patient->appointments()
            ->with('service', 'psychologist')
            ->orderByDesc('starts_at')
            ->get();

        $testAssignments = $patient->testAssignments()
            ->with('test')
            ->orderByDesc('created_at')
            ->get();

        $pdf = Pdf::loadView('dashboard.danisanlar.pdf-rapor', [
            'patient' => $patient,
            'appointments' => $appointments,
            'testAssignments' => $testAssignments,
        ])->setPaper('a4');

        $dosyaAdi = 'danisan-raporu-' . \Illuminate\Support\Str::slug($patient->name) . '.pdf';

        return $pdf->download($dosyaAdi);
    }

    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('dashboard.danisanlar.add', ['data' => $patient]);
    }

    public function add()
    {
        return view('dashboard.danisanlar.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:32',
            'email' => 'nullable|email|max:255',
        ]);

        if ($request->id) {
            $patient = Patient::findOrFail($request->id);
        } else {
            $patient = new Patient();
        }

        $patient->name = $request->name;
        $patient->phone = $request->phone;
        $patient->email = $request->email;
        $patient->birth_date = $request->birth_date ?: null;
        $patient->gender = $request->gender;
        $patient->notes = $request->notes;
        $patient->save();

        return redirect('/admin/danisanlar/' . $patient->id)->with('success', 'Danışan bilgileri kaydedildi.');
    }
}
