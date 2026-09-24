<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Contact;
use App\Models\Project;
use App\Models\Services;
use App\Models\Sss;

class DashboardController extends Controller
{
    public function index()
    {
        $ozet = [
            ['Projeler', Project::count(), 'briefcase-outline', '/admin/projeler', 'bg-gradient-purple'],
            ['Hizmetler', Services::count(), 'layers-outline', '/admin/hizmetler', 'bg-gradient-info'],
            ['Blog Yazıları', Blog::count(), 'newspaper-outline', '/admin/blog', 'bg-gradient-success'],
            ['Gelen Mesajlar', Contact::count(), 'mail-outline', '/admin/contact', 'bg-gradient-danger'],
        ];

        return view('dashboard.home', [
            'ozet' => $ozet,
            'sonMesajlar' => auth()->user()->isYonetici() ? Contact::orderBy('created_at', 'DESC')->limit(5)->get() : collect(),
            'sonYazilar' => Blog::orderBy('created_at', 'DESC')->limit(5)->get(),
            'eksikler' => $this->eksikler(),
        ]);
    }

    /** Sitenin eksiksiz görünmesi için doldurulması önerilen alanlar. */
    private function eksikler(): array
    {
        $s = \App\Models\Setting::first();
        $list = [];
        if (! $s?->profile_image) {
            $list[] = ['Profil fotoğrafınızı yükleyin (Google\'daki kişi bilgisinde de kullanılır).', '/admin/ayarlar'];
        }
        if (! $s?->image) {
            $list[] = ['Logonuzu yükleyin (yüklenmezse adınız yazı olarak görünür).', '/admin/ayarlar'];
        }
        if (Project::whereNull('image')->exists()) {
            $list[] = ['Bazı projelerde kapak görseli yok; şimdilik markaya uygun yedek görsel gösteriliyor.', '/admin/projeler'];
        }
        if (Brand::whereNull('logo')->exists()) {
            $list[] = ['Bazı markaların logosu yok; marka adı yazı olarak gösteriliyor.', '/admin/markalar'];
        }
        if (Sss::count() === 0) {
            $list[] = ['Sık sorulan sorular ekleyin.', '/admin/sss'];
        }

        return $list;
    }
}
