<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $data = Testimonial::orderBy('order')->orderBy('id')->get();
        return view('dashboard.yorumlar.index', ['data' => $data]);
    }

    public function edit($id)
    {
        $data = Testimonial::find($id);
        return view('dashboard.yorumlar.add', ['data' => $data]);
    }

    public function add()
    {
        return view('dashboard.yorumlar.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string|max:2000',
        ]);

        if ($request->id) {
            $item = Testimonial::find($request->id);
        } else {
            $item = new Testimonial();
        }

        $item->name = $request->name;
        $item->role = $request->role;
        $item->content = $request->content;
        $item->order = (int) ($request->order ?: 0);
        $item->save();

        return redirect('/admin/yorumlar')->with('success', 'Kayıt Başarıyla Kaydedildi.');
    }

    public function del($id)
    {
        Testimonial::destroy($id);
        return redirect('/admin/yorumlar')->with('success', 'Kayıt Başarıyla Silindi.');
    }
}
