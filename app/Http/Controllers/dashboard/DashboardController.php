<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Yönetici panele girer girmez göreceği detaylı özet: bugünün
     * randevu programı + genel istatistik kartları + dikkat gerektiren
     * (sık gelmeyen) danışanlar. Daha kapsamlı rapor için "Raporlar"
     * sayfasına yönlendirir (bkz. ReportController).
     */
    public function index()
    {
        $bugun = Carbon::today();
        $haftaBaslangic = Carbon::now()->startOfWeek();
        $haftaBitis = Carbon::now()->endOfWeek();
        $ayBaslangic = Carbon::now()->startOfMonth();

        $bugunkuRandevular = Appointment::with('patient', 'service')
            ->onDate($bugun->toDateString())
            ->blocking()
            ->orderBy('starts_at')
            ->get();

        $ozet = [
            'bugun' => $bugunkuRandevular->count(),
            'bu_hafta' => Appointment::blocking()->whereBetween('starts_at', [$haftaBaslangic, $haftaBitis])->count(),
            'bekleyen_onay' => Appointment::where('status', Appointment::STATUS_PENDING)->where('starts_at', '>=', $bugun)->count(),
            'bu_ay_tamamlanan' => Appointment::where('status', Appointment::STATUS_COMPLETED)->where('starts_at', '>=', $ayBaslangic)->count(),
            'toplam_danisan' => Patient::count(),
        ];

        // Bkz. ReportController için aynı HAVING/SQLite notu: filtre PHP tarafında yapılıyor.
        $noShowUyarilari = Patient::withCount(['appointments as gelmedi_sayisi' => function ($q) {
                $q->where('status', Appointment::STATUS_NO_SHOW);
            }])
            ->get()
            ->filter(fn ($p) => $p->gelmedi_sayisi >= ReportController::NO_SHOW_WARNING_THRESHOLD)
            ->sortByDesc('gelmedi_sayisi')
            ->take(5)
            ->values();

        return view('dashboard.home', [
            'bugunkuRandevular' => $bugunkuRandevular,
            'ozet' => $ozet,
            'noShowUyarilari' => $noShowUyarilari,
        ]);
    }
}
