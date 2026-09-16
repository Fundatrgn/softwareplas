<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Referans;
use App\Models\ReferansCategory;
use Illuminate\Http\Request;

class ReferansController extends Controller
{
    public function index()
    {
        $categories = ReferansCategory::get();
        $data = Referans::with('category')->orderBy('created_at', 'DESC')->get();
        return view('dashboard.referanslar.index', ['data' => $data,'categories'=>$categories]);
    }
    public function edit($id)
    {
        $categories = ReferansCategory::all();
        $data = Referans::find($id);
        return view('dashboard.referanslar.add', ['data' => $data,'categories'=>$categories]);
    }
    public function add()
    {
        $categories = ReferansCategory::all();
        return view('dashboard.referanslar.add',['categories'=>$categories]);
    }
    public function store(Request $request)
    {
        if ($request->id) {
            $item = Referans::find($request->id);
        } else {
            $item = new Referans();
        }

        $item->title = $request->title;
        $item->kategori = $request->kategori;
        $item->konum = $request->konum;
        $item->yazilim = $request->yazilim;
         $item->content = $request->content;
        $item->musteri = $request->musteri;
        $item->order = $request->order;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $item->image =  $imageName;
        }
       
        $item->save();
        return redirect('/admin/referanslar')->with('success', 'Kayıt Başarıyla Eklendi.');
    }
    public function del($id)
    {
        $data = Referans::destroy($id);
        return redirect('/admin/referanslar')->with('success', 'Kayıt Başarıyla Silindi.');
    }
}
