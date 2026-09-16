<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $data = Slider::orderBy('sira', 'ASC')->get();
        return view('dashboard.slider.index', ['data' => $data]);
    }
    public function edit($id)
    {
        $data = Slider::find($id);
        return view('dashboard.slider.add', ['data' => $data]);
    }
    public function add()
    {
        return view('dashboard.slider.add');
    }
    public function updateSpeed(Request $request)
    {
        $saniye = (int) $request->saniye;
        if ($saniye < 2) $saniye = 2;
        if ($saniye > 30) $saniye = 30;

        $settings = \App\Models\Setting::first();
        if ($settings) {
            $settings->slider_speed = $saniye * 1000;
            $settings->save();
        }
        return redirect('/admin/slider')->with('hiz_success', 'Geçiş süresi güncellendi.');
    }
    public function store(Request $request)
    {
        try {
            if ($request->id) {
                $item = Slider::find($request->id);
            } else {
                $item = new Slider();
            }
            $item->title = $request->title;
            $item->subtitle = $request->subtitle;
            $item->btn_text = $request->btn_text;
            $item->sira = $request->sira;
            $item->text_position = in_array($request->text_position, ['sol', 'orta', 'sag'], true)
                ? $request->text_position
                : 'orta';
            // Şablondan kalma, admin formunda hiç gösterilmeyen eski alanlar.
            // Veritabanında boş bırakılamaz olduğu için burada güvenli
            // varsayılan (boş metin) atanıyor.
            $item->first = $item->first ?? '';
            $item->second = $item->second ?? '';
            $item->threed = $item->threed ?? '';

            $imageName = $this->uploadImage($request);
            if ($imageName) {
                $item->image = $imageName;
            }

            $item->save();
            return redirect('/admin/slider')->with('success', 'Kayıt Başarıyla Eklendi.');
        } catch (\RuntimeException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Slider kaydetme hatası: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Kayıt sırasında beklenmeyen bir hata oluştu: ' . $e->getMessage());
        }
    }
    public function del($id)
    {
        $data = Slider::destroy($id);
        return redirect('/admin/slider')->with('success', 'Kayıt Başarıyla Silindi.');
    }
}
