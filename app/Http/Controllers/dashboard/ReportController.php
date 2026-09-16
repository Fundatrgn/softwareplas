<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Sık gelmeyen (no-show) danışan uyarısı için eşik: bir danışanın
     * "gelmedi" sayısı bu değere ulaşınca hem raporda hem danışan
     * detay sayfasında uyarı rozeti gösterilir.
     */
    const NO_SHOW_WARNING_THRESHOLD = 2;

    public function index()
    {
        $durumSayilari = Appointment::select('status', DB::raw('count(*) as adet'))
            ->groupBy('status')
            ->pluck('adet', 'status');

        $toplamRandevu = $durumSayilari->sum();

        $durumDagilimi = collect(Appointment::STATUSES)->map(function ($label, $key) use ($durumSayilari, $toplamRandevu) {
            $adet = $durumSayilari->get($key, 0);
            return [
                'key' => $key,
                'label' => $label,
                'adet' => $adet,
                'yuzde' => $toplamRandevu > 0 ? round(($adet / $toplamRandevu) * 100, 1) : 0,
            ];
        })->values();

        $buAyBaslangic = Carbon::now()->startOfMonth();
        $buAyRandevuSayisi = Appointment::where('starts_at', '>=', $buAyBaslangic)->count();
        $buAyTamamlanan = Appointment::where('starts_at', '>=', $buAyBaslangic)->where('status', Appointment::STATUS_COMPLETED)->count();
        $buAyIptal = Appointment::where('starts_at', '>=', $buAyBaslangic)->where('status', Appointment::STATUS_CANCELLED)->count();
        $buAyGelmedi = Appointment::where('starts_at', '>=', $buAyBaslangic)->where('status', Appointment::STATUS_NO_SHOW)->count();

        $buAyYeniDanisan = Patient::where('created_at', '>=', $buAyBaslangic)->count();
        $toplamDanisan = Patient::count();

        // En çok gelmeyen (no-show) danışanlar.
        // Not: HAVING ile alias filtrelemek SQLite'ta desteklenmiyor
        // ("HAVING clause on a non-aggregate query"), bu yüzden filtre
        // PHP tarafında yapılıyor; danışan sayısı bir klinik için küçük
        // ölçekli olduğundan performans sorunu oluşturmuyor.
        $noShowListesi = Patient::withCount([
                'appointments as toplam_randevu',
                'appointments as gelmedi_sayisi' => function ($q) {
                    $q->where('status', Appointment::STATUS_NO_SHOW);
                },
            ])
            ->get()
            ->filter(fn ($p) => $p->gelmedi_sayisi >= 1)
            ->sortByDesc('gelmedi_sayisi')
            ->take(15)
            ->values();

        // Son 6 ay randevu trendi
        $aylikTrend = collect(range(5, 0))->map(function ($i) {
            $ay = Carbon::now()->subMonths($i)->startOfMonth();
            $ayBitis = $ay->copy()->endOfMonth();
            return [
                'label' => $ay->translatedFormat('M Y'),
                'toplam' => Appointment::whereBetween('starts_at', [$ay, $ayBitis])->count(),
                'tamamlanan' => Appointment::whereBetween('starts_at', [$ay, $ayBitis])->where('status', Appointment::STATUS_COMPLETED)->count(),
                'gelmedi' => Appointment::whereBetween('starts_at', [$ay, $ayBitis])->where('status', Appointment::STATUS_NO_SHOW)->count(),
                'iptal' => Appointment::whereBetween('starts_at', [$ay, $ayBitis])->where('status', Appointment::STATUS_CANCELLED)->count(),
            ];
        });

        return view('dashboard.raporlar.index', [
            'durumDagilimi' => $durumDagilimi,
            'toplamRandevu' => $toplamRandevu,
            'buAyRandevuSayisi' => $buAyRandevuSayisi,
            'buAyTamamlanan' => $buAyTamamlanan,
            'buAyIptal' => $buAyIptal,
            'buAyGelmedi' => $buAyGelmedi,
            'buAyYeniDanisan' => $buAyYeniDanisan,
            'toplamDanisan' => $toplamDanisan,
            'noShowListesi' => $noShowListesi,
            'aylikTrend' => $aylikTrend,
            'esik' => self::NO_SHOW_WARNING_THRESHOLD,
        ]);
    }
}
