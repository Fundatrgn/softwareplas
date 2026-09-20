<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EmailSettingController extends Controller
{
    /**
     * Admin panelinden seçilebilecek hazır hatırlatma zamanlamaları
     * (gün cinsinden, randevudan kaç gün önce). Birden fazlası aynı anda
     * seçilebilir (ör. hem 1 gün hem 7 gün kala).
     */
    public const HATIRLATMA_SECENEKLERI = [
        1 => '1 gün kala',
        2 => '2 gün kala',
        3 => '3 gün kala',
        5 => '5 gün kala',
        7 => '7 gün kala',
    ];

    public function index()
    {
        $settings = Setting::first();
        return view('dashboard.email-ayarlar.index', [
            'data' => $settings,
            'hatirlatmaSecenekleri' => self::HATIRLATMA_SECENEKLERI,
        ]);
    }

    public function store(Request $request)
    {
        $item = Setting::first();

        $item->notify_email_enabled = $request->boolean('notify_email_enabled');

        $secilenler = array_map('intval', $request->input('reminder_intervals_days', []));
        $secilenler = array_values(array_intersect($secilenler, array_keys(self::HATIRLATMA_SECENEKLERI)));
        $item->reminder_intervals_days = $secilenler;

        $item->save();

        return redirect('/admin/email-ayarlar')->with('success', 'E-posta ayarları güncellendi.');
    }

    /**
     * Danışanlara giden e-postanın gerçekte nasıl göründüğünü admin
     * panelinden (örnek/sahte verilerle) önizlemek için kullanılır.
     * GET /admin/email-ayarlar/onizleme
     */
    public function preview()
    {
        $appointment = new Appointment([
            'starts_at' => Carbon::now()->addDay()->setTime(14, 30),
            'ends_at' => Carbon::now()->addDay()->setTime(15, 20),
            'patient_name_snapshot' => 'Ayşe Yılmaz',
            'status' => Appointment::STATUS_CONFIRMED,
            'request_note' => 'İlk kez görüşmeye geliyorum, biraz erken gelebilirim.',
        ]);

        return view('emails.appointment', [
            'appointment' => $appointment,
            'heading' => 'Randevunuz Onaylandı',
            'intro' => 'Randevunuzun durumu güncellendi: Onaylandı.',
            'cancelUrl' => '#',
        ]);
    }
}
