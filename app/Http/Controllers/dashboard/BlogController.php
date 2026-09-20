<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $data = Blog::with('category')->orderBy('created_at', 'DESC')->get();
        return view('dashboard.blog.index', ['data' => $data]);
    }
    public function edit($id)
    {
        $categories =BlogCategory::orderBy('title','ASC')->get();

        $data = Blog::find($id);
        return view('dashboard.blog.add', ['data' => $data,'categories'=>$categories]);
    }
    public function add()
    {
        $categories =BlogCategory::orderBy('title','ASC')->get();

        return view('dashboard.blog.add',['categories'=>$categories]);
    }
    public function store(Request $request)
    {
        if ($request->id) {
            $item = Blog::find($request->id);
        } else {
            $item = new Blog();
        }

        $item->title = $request->title;
        $item->category_id = $request->category_id ?: null;
        $item->summary = $request->summary;
        $item->content = $request->content;
        $item->tags = $request->tags;
        $item->slug = Str::slug($request->title);
        try {
            $imageName = $this->uploadImage($request);
            if ($imageName) {
                $item->image = $imageName;
            }
        } catch (\RuntimeException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        $item->save();
        return redirect('/admin/blog')->with('success', 'Kayıt Başarıyla Eklendi.');
    }
    public function del($id)
    {
        $data = Blog::destroy($id);
        return redirect('/admin/blog')->with('success', 'Kayıt Başarıyla Silindi.');
    }
}
