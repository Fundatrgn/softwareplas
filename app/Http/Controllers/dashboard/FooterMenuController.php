<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\FooterLink;
use App\Models\Setting;
use Illuminate\Http\Request;

class FooterMenuController extends Controller
{
    /**
     * Footer'da "Hizmetlerimiz" sekmesinin yanına eklenebilecek üçüncü
     * bağlantı listesi için admin panelinden seçilebilecek hazır sayfalar.
     * İhtiyaç halinde buraya yeni bir sayfa eklemek yeterlidir.
     */
    public const SAYFA_SECENEKLERI = [
        '/' => 'Anasayfa',
        '/hakkimizda' => 'Hakkımızda',
        '/ekibimiz' => 'Ekibimiz',
        '/hizmetler' => 'Hizmetlerimiz',
        '/blog' => 'Blog',
        '/sss' => 'Sık Sorulan Sorular',
        '/iletisim' => 'İletişim',
        '/randevu' => 'Randevu Al',
    ];

    public function index()
    {
        $data = FooterLink::orderBy('order')->orderBy('id')->get();
        $settings = Setting::first();
        return view('dashboard.footer-menu.index', [
            'data' => $data,
            'sayfaSecenekleri' => self::SAYFA_SECENEKLERI,
            'menuBasligi' => $settings->footer_menu_title ?? '',
        ]);
    }

    public function edit($id)
    {
        $data = FooterLink::find($id);
        return view('dashboard.footer-menu.add', [
            'data' => $data,
            'sayfaSecenekleri' => self::SAYFA_SECENEKLERI,
        ]);
    }

    public function add()
    {
        return view('dashboard.footer-menu.add', [
            'sayfaSecenekleri' => self::SAYFA_SECENEKLERI,
        ]);
    }

    /**
     * Footer'daki bu bağlantı listesinin başlığını (ör. "Kurumsal") kaydeder.
     */
    public function updateBaslik(Request $request)
    {
        $item = Setting::first();
        $item->footer_menu_title = $request->footer_menu_title ?: null;
        $item->save();

        return redirect('/admin/footer-menu')->with('success', 'Footer menü başlığı güncellendi.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sayfa' => 'required_if:url_tipi,sayfa|nullable|string|max:255',
            'ozel_url' => 'required_if:url_tipi,ozel|nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
        ]);

        if ($request->id) {
            $item = FooterLink::find($request->id);
        } else {
            $item = new FooterLink();
        }

        $item->title = $request->title;
        $item->url = $request->url_tipi === 'ozel' ? $request->ozel_url : $request->sayfa;
        $item->order = (int) ($request->order ?: 0);
        $item->save();

        return redirect('/admin/footer-menu')->with('success', 'Kayıt Başarıyla Kaydedildi.');
    }

    public function del($id)
    {
        FooterLink::destroy($id);
        return redirect('/admin/footer-menu')->with('success', 'Kayıt Başarıyla Silindi.');
    }
}
