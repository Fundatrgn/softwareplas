<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $data = Setting::get();
        return view('dashboard.ayarlar.index', ['data' => $data]);
    }
    public function edit($id)
    {
        $data = Setting::find($id);
        return view('dashboard.ayarlar.add', ['data' => $data]);
    }
    public function add()
    {

        return view('dashboard.ayarlar.add');
    }
    public function store(Request $request)
    {
        if ($request->id) {
            $item = Setting::find($request->id);
        } else {
            $item = new Setting();
        }

        $item->site_title = $request->site_title ?? '';
        $item->description = $request->description ?? '';
        $item->sidebar_bio = $request->sidebar_bio ?? '';
        $item->kvkk_text = $request->kvkk_text ?? '';
        $item->keywords = $request->keywords ?? '';
        $item->author = $request->author ?? '';
        // linkedin/youtube/twitter/facebook/phone/email veritabanında NOT NULL
        // olduğu için boş bırakılırsa (ör. Twitter hesabı olmayan bir kullanıcı)
        // null yerine boş metin kaydedilir; aksi halde kayıt SQL hatasıyla çöker.
        $item->linkedin = $request->linkedin ?? '';
        $item->instagram = $request->instagram ?? '';
        $item->youtube = $request->youtube ?? '';
        $item->twitter = $request->twitter ?? '';
        $item->facebook = $request->facebook ?? '';
        $item->phone = $request->phone ?? '';
        $item->email = $request->email ?? '';
        $item->address = $request->address ?? '';

        // Site Görünümü / Renkler
        $item->accent_color = $request->accent_color ?: '#D9784B';
        $item->secondary_color = $request->secondary_color ?: '#7FA36F';
        $item->heading_color = $request->heading_color ?: '#1F2D30';
        $item->body_text_color = $request->body_text_color ?: '#4B5A5E';
        $item->background_color = $request->background_color ?: '#F7F5F0';
        $item->whatsapp_number = $request->whatsapp_number;

        // Randevu / Çalışma Saatleri
        $workingHours = [];
        foreach (['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'] as $day) {
            $dayInput = $request->input("hours.$day");
            if (! empty($dayInput['acik'])) {
                $workingHours[$day] = [
                    'start' => $dayInput['start'] ?? '09:00',
                    'end' => $dayInput['end'] ?? '18:00',
                    'break_start' => $dayInput['break_start'] ?? null,
                    'break_end' => $dayInput['break_end'] ?? null,
                ];
            } else {
                $workingHours[$day] = null;
            }
        }
        $item->working_hours = $workingHours;

        $closedDates = collect(preg_split('/[\r\n,]+/', (string) $request->closed_dates))
            ->map(fn ($d) => trim($d))
            ->filter()
            ->values()
            ->all();
        $item->closed_dates = $closedDates;

        $item->appointment_duration_minutes = $request->appointment_duration_minutes ?: 50;

        // Bildirimler (E-posta / SMS)
        $item->notify_email_enabled = $request->boolean('notify_email_enabled');
        $item->notify_sms_enabled = $request->boolean('notify_sms_enabled');
        $item->sms_provider = $request->sms_provider ?: 'log';
        $item->sms_api_key = $request->sms_api_key;
        $item->sms_api_secret = $request->sms_api_secret;
        $item->sms_sender_title = $request->sms_sender_title;

        try {
            $imageName = $this->uploadImage($request, 'image');
            if ($imageName) {
                $item->image = $imageName;
            }
            $faviconName = $this->uploadImage($request, 'favicon');
            if ($faviconName) {
                $item->favicon = $faviconName;
            }
        } catch (\RuntimeException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
        $item->save();
        return redirect('/admin/ayarlar')->with('success', 'Kayıt Başarıyla Güncellendi.');
    }
    public function del($id)
    {
        $data = Setting::destroy($id);
        return redirect('/admin/ayarlar')->with('success', 'Kayıt Başarıyla Silindi.');
    }
}
