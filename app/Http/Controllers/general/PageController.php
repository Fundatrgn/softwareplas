<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('general.sayfa', ['page' => $page]);
    }
}
