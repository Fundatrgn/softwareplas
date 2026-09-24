<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\ServicesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HizmetlerCategories extends Controller
{
    public function index()
    {
        $data = ServicesCategory::orderBy('created_at', 'DESC')->get();
        return view('dashboard.hizmetler.category.index', ['data' => $data]);
    }
    public function edit($id)
    {
        $data = ServicesCategory::find($id);
        return view('dashboard.hizmetler.category.add', ['data' => $data]);
    }
    public function add()
    {
        return view('dashboard.hizmetler.category.add');
    }
    public function store(Request $request)
    {
        if ($request->id) {
            $item = ServicesCategory::find($request->id);
        } else {
            $item = new ServicesCategory();
        }

        $item->title = $request->title;
        $item->slug = Str::slug($request->title);
        $item->save();
        return redirect('/admin/hizmetler/kategori')->with('success', 'Kayıt Başarıyla Eklendi.');
    }
    public function del($id)
    {
        $data = ServicesCategory::destroy($id);
        return redirect('/admin/hizmetler/kategori')->with('success', 'Kayıt Başarıyla Silindi.');
    }
}
