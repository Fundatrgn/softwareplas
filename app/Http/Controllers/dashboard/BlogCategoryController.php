<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $data = BlogCategory::orderBy('created_at', 'DESC')->get();
        return view('dashboard.blog.category.index', ['data' => $data]);
    }
    public function edit($id)
    {
        $data = BlogCategory::find($id);
        return view('dashboard.blog.category.add', ['data' => $data]);
    }
    public function add()
    {
        return view('dashboard.blog.category.add');
    }
    public function store(Request $request)
    {
        if ($request->id) {
            $item = BlogCategory::find($request->id);
        } else {
            $item = new BlogCategory();
        }

        $item->title = $request->title;
        $item->slug = Str::slug($request->title);
        $item->save();
        return redirect('/admin/blog/kategori')->with('success', 'Kayıt Başarıyla Eklendi.');
    }
    public function del($id)
    {
        $data = BlogCategory::destroy($id);
        return redirect('/admin/blog/kategori')->with('success', 'Kayıt Başarıyla Silindi.');
    }
}
