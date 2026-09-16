<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\ReferansCategory;
use Illuminate\Http\Request;use Illuminate\Support\Str;

class ReferansCategoryController extends Controller
{
    public function index()
    {
        $data = ReferansCategory::orderBy('created_at', 'DESC')->get();
        return view('dashboard.referanslar.category.index', ['data' => $data]);
    }
    public function edit($id)
    {
        $data = ReferansCategory::find($id);
        return view('dashboard.referanslar.category.add', ['data' => $data]);
    }
    public function add()
    {
        return view('dashboard.referanslar.category.add');
    }
    public function store(Request $request)
    {
        if ($request->id) {
            $item = ReferansCategory::find($request->id);
        } else {
            $item = new ReferansCategory();
        }

        $item->title = $request->title;
        $item->slug = Str::slug($request->title);
        $item->save();
        return redirect('/admin/referanslar/kategori')->with('success', 'Kayıt Başarıyla Eklendi.');
    }
    public function del($id)
    {
        $data = ReferansCategory::destroy($id);
        return redirect('/admin/referanslar/kategori')->with('success', 'Kayıt Başarıyla Silindi.');
    }
}
