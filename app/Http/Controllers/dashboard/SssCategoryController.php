<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\SssCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SssCategoryController extends Controller
{
    public function index()
    {
        $data = SssCategory::orderBy('created_at', 'DESC')->get();
        return view('dashboard.sss.category.index', ['data' => $data]);
    }
    public function edit($id)
    {
        $data = SssCategory::find($id);
        return view('dashboard.sss.category.add', ['data' => $data]);
    }
    public function add()
    {
        return view('dashboard.sss.category.add');
    }
    public function store(Request $request)
    {
        if ($request->id) {
            $item = SssCategory::find($request->id);
        } else {
            $item = new SssCategory();
        }

        $item->title = $request->title;
        $item->slug = Str::slug($request->title);
        $item->save();
        return redirect('/admin/sss/kategori')->with('success', 'Kayıt Başarıyla Eklendi.');
    }
    public function del($id)
    {
        $data = SssCategory::destroy($id);
        return redirect('/admin/sss/kategori')->with('success', 'Kayıt Başarıyla Silindi.');
    }
}
