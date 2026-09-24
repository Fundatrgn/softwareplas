<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Brand;
use App\Models\ProcessStep;
use App\Models\Project;
use App\Models\Services;
use App\Models\Slider;
use App\Models\Sss;
use App\Models\Testimonial;
use App\Models\Timeline;
use Illuminate\Http\Request;

/**
 * Halka açık sitenin (Aigocy şablonu) tüm sayfaları.
 */
class SiteController extends Controller
{
    public function home()
    {
        return view('site.home', [
            'hero' => Slider::orderBy('sira')->orderBy('id')->first(),
            'intro' => About::orderBy('position')->first(),
            'brands' => Brand::orderBy('order')->get(),
            'services' => Services::orderBy('order')->get(),
            'projects' => Project::where('is_featured', true)->orderBy('order')->limit(4)->get(),
            'steps' => ProcessStep::orderBy('order')->get(),
            'testimonials' => Testimonial::orderBy('order')->get(),
            'posts' => Blog::with('category')->latest()->limit(3)->get(),
            'faqs' => Sss::orderBy('id')->limit(5)->get(),
        ]);
    }

    public function about()
    {
        $blocks = About::orderBy('position')->get();

        return view('site.about', [
            'intro' => $blocks->first(),
            'values' => $blocks->slice(1)->values(),
            'brands' => Brand::orderBy('order')->get(),
            'timeline' => Timeline::orderBy('order')->get(),
            'testimonials' => Testimonial::orderBy('order')->get(),
            'faqs' => Sss::orderBy('id')->limit(5)->get(),
        ]);
    }

    public function services()
    {
        return view('site.services', [
            'services' => Services::orderBy('order')->get(),
            'brands' => Brand::orderBy('order')->get(),
            'steps' => ProcessStep::orderBy('order')->get(),
            'faqs' => Sss::orderBy('id')->limit(5)->get(),
        ]);
    }

    public function service(string $slug)
    {
        $service = Services::where('slug', $slug)->firstOrFail();

        return view('site.service', [
            'service' => $service,
            'others' => Services::where('id', '!=', $service->id)->orderBy('order')->get(),
            'steps' => ProcessStep::orderBy('order')->get(),
        ]);
    }

    public function projects()
    {
        return view('site.projects', [
            'projects' => Project::orderBy('order')->orderByDesc('id')->get(),
            'testimonials' => Testimonial::orderBy('order')->get(),
        ]);
    }

    public function project(string $slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $all = Project::orderBy('order')->orderByDesc('id')->get();
        $index = $all->search(fn ($p) => $p->id === $project->id);
        $next = $all->count() > 1 ? $all[($index + 1) % $all->count()] : null;

        return view('site.project', compact('project', 'next'));
    }

    public function blog(Request $request)
    {
        $query = Blog::with('category')->latest();
        $search = trim((string) $request->query('q'));
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('summary', 'like', "%{$search}%")
                    ->orWhere('tags', 'like', "%{$search}%");
            });
        }

        return view('site.blog', $this->blogSidebar() + [
            'posts' => $query->paginate(6)->withQueryString(),
            'search' => $search,
            'category' => null,
        ]);
    }

    public function blogCategory(string $slug)
    {
        $category = BlogCategory::where('slug', $slug)->firstOrFail();

        return view('site.blog', $this->blogSidebar() + [
            'posts' => Blog::with('category')->where('category_id', $category->id)->latest()->paginate(6),
            'search' => '',
            'category' => $category,
        ]);
    }

    public function blogPost(string $slug)
    {
        $post = Blog::with('category')->where('slug', $slug)->firstOrFail();

        return view('site.blog-post', $this->blogSidebar() + ['post' => $post]);
    }

    public function faq()
    {
        return view('site.faq', ['faqs' => Sss::with('category')->orderBy('category_id')->orderBy('id')->get()]);
    }

    public function contact()
    {
        return view('site.contact', ['faqs' => Sss::orderBy('id')->limit(4)->get()]);
    }

    public function kvkk()
    {
        return view('site.kvkk');
    }

    private function blogSidebar(): array
    {
        $posts = Blog::latest()->get(['id', 'title', 'slug', 'image', 'tags', 'created_at']);

        return [
            'recentPosts' => $posts->take(3),
            'categories' => BlogCategory::withCount('posts')->orderBy('title')->get(),
            'popularTags' => $posts->flatMap(fn ($p) => $p->tagList())->countBy()->sortDesc()->keys()->take(10),
        ];
    }
}
