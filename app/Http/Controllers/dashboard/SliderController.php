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
    public function store(Request $request)
    {
        try {
            if ($request->id) {
                $item = Slider::find($request->id);
            } else {
                $item = new Slider();
            }
            foreach (['badge', 'title', 'title2', 'subtitle', 'btn_text', 'btn_url', 'btn2_text', 'btn2_url'] as $field) {
                $item->{$field} = $request->input($field);
            }
            $item->sira = (int) $request->input('sira', 1);

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
