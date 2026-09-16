<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Request as HttpRequest;


class BlogController extends Controller
{
    public function index()
    {
        $blog = Blog::with('category')->orderBy('created_at', 'DESC')->paginate(6);
        $lastestBlog = Blog::with('category')->orderBy('created_at', 'DESC')->limit(8)->get();
        $blogCategory = BlogCategory::limit(10)->get();

        $data = [
            "blog" => $blog,
            "lastestBlog" => $lastestBlog,
            "blogCategory" => $blogCategory,
        ];
        return view('general.blog', ['data' => $data]);
    }
    public function category($category_id)
    {
        $blog = Blog::with('category')->where('category_id', $category_id)->orderBy('created_at', 'DESC')->paginate(6);
        $lastestBlog = Blog::with('category')->orderBy('created_at', 'DESC')->limit(8)->get();
        $blogCategory = BlogCategory::limit(10)->get();
        $blogCategor = BlogCategory::find($category_id);
        $data = [
            "title" => "Blog: " . ($blogCategor->title ?? ''),
            "blog" => $blog,
            "lastestBlog" => $lastestBlog,
            "blogCategory" => $blogCategory,
        ];
        return view('general.blog', ['data' => $data]);
    }
    public function search(HttpRequest $request)
    {
        $search = $request->search;

        // Arama sorgusu ile blogları alın
        $blogs = Blog::with('category')
            ->where(function ($query) use ($search) {
                $query->where('title', 'like', "%$search%")
                    ->orWhere('summary', 'like', "%$search%")
                    ->orWhere('content', 'like', "%$search%");
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(6);
    
        $lastestBlog = Blog::with('category')
            ->orderBy('created_at', 'DESC')
            ->limit(8)
            ->get();
    
        $blogCategory = BlogCategory::limit(10)->get();
    
        $data = [
            "title" => "Blog Arama: $search",
            "blog" => $blogs,
            "lastestBlog" => $lastestBlog,
            "blogCategory" => $blogCategory,
        ];
    
        return view('general.blog', ['data' => $data]);
    }
    public function detay($id,$slug)
    {
        $blog = Blog::with('category')->where('id',$id)->first();
        $lastestBlog = Blog::with('category')->orderBy('created_at', 'DESC')->limit(8)->get();
        $blogCategory = BlogCategory::limit(10)->get();
        $data = [
            "title" => $blog[0]->title ?? '',
            "blog" => $blog,
            "lastestBlog" => $lastestBlog,
            "blogCategory" => $blogCategory,
        ];
        return view('general.blog-detay', ['data' => $data]);
    }
}
