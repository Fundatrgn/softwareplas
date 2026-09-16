<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Sss;
use App\Models\SssCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SssController extends Controller
{
    public function index()
    {
        $data = Sss::with('category')->orderBy('created_at', 'DESC')->get();
        return view('dashboard.sss.index', ['data' => $data]);
    }
    public function edit($id)
    {
        $categories =SssCategory::orderBy('title','ASC')->get();

        $data = Sss::find($id);
        return view('dashboard.sss.add', ['data' => $data,'categories'=>$categories]);
    }
    public function add()
    {
        $categories =SssCategory::orderBy('title','ASC')->get();

        return view('dashboard.sss.add',['categories'=>$categories]);
    }
    public function store(Request $request)
    {
        if ($request->id) {
            $item = Sss::find($request->id);
        } else {
            $item = new Sss();
        }

        $item->title = $request->title;
        $item->category_id = $request->category_id;
        $item->content = $request->content;
        $item->save();
        return redirect('/admin/sss')->with('success', 'Kayıt Başarıyla Eklendi.');
    }
    public function del($id)
    {
        $data = Sss::destroy($id);
        return redirect('/admin/sss')->with('success', 'Kayıt Başarıyla Silindi.');
    }
}
