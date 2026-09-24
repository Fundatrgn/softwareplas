<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Services;
use App\Models\ServicesCategory;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class HizmetlerController extends Controller
{
    public function index()
    {
        $data = Services::orderBy('order')->get();
        return view('dashboard.hizmetler.index', ['data' => $data]);
    }
    public function edit($id)
    {
        $categories =ServicesCategory::orderBy('title','ASC')->get();
        $data = Services::find($id);
        return view('dashboard.hizmetler.add', ['data' => $data,'categories'=>  $categories]);
    }
    public function add()
    {
        $categories =ServicesCategory::orderBy('title','ASC')->get();

        return view('dashboard.hizmetler.add',['categories'=>  $categories]);
    }
    public function store(Request $request)
    {
        if ($request->id) {
            $item = Services::find($request->id);
        } else {
            $item = new Services();
        }

        $item->title = $request->title;
        $item->category_id = $request->category_id ?: null;
        $item->summary = $request->summary;
        $item->content = $request->content;
        $item->tags = $request->tags;
        $item->order = (int) $request->order;

        $base = Str::slug($request->title) ?: 'hizmet';
        $slug = $base;
        $i = 2;
        while (Services::where('slug', $slug)->where('id', '!=', $item->id ?? 0)->exists()) {
            $slug = $base . '-' . $i++;
        }
        $item->slug = $slug;

        try {
            $imageName = $this->uploadImage($request);
            if ($imageName) {
                $item->image = $imageName;
                $this->resizeAndCropImage(public_path('images/' . $imageName), 800, 600);
            }
        } catch (\RuntimeException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
        $item->save();
        return redirect('/admin/hizmetler')->with('success', 'Kayıt Başarıyla Güncellendi.');
    }
    public function del($id)
    {
        $data = Services::destroy($id);
        return redirect('/admin/hizmetler')->with('success', 'Kayıt Başarıyla Silindi.');
    }
}
