<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $data = Page::orderBy('order')->orderBy('id')->get();
        return view('dashboard.sayfalar.index', ['data' => $data]);
    }

    public function edit($id)
    {
        $data = Page::find($id);
        return view('dashboard.sayfalar.add', ['data' => $data]);
    }

    public function add()
    {
        return view('dashboard.sayfalar.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        if ($request->id) {
            $item = Page::find($request->id);
        } else {
            $item = new Page();
        }

        $item->title = $request->title;
        $item->slug = Str::slug($request->title);
        $item->content = $request->content;
        $item->order = (int) ($request->order ?: 0);
        $item->save();

        return redirect('/admin/sayfalar')->with('success', 'Kayıt Başarıyla Kaydedildi.');
    }

    public function del($id)
    {
        Page::destroy($id);
        return redirect('/admin/sayfalar')->with('success', 'Kayıt Başarıyla Silindi.');
    }
}
