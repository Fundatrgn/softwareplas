<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Models\Sss;
use App\Models\SssCategory;
use Illuminate\Http\Request;

class SSSController extends Controller
{
    public function index()
    {
        $categories = SssCategory::orderBy('title', 'ASC')->get();
        $sorular = Sss::with('category')->orderBy('id', 'ASC')->get();

        return view('general.sss', [
            'data' => [
                'categories' => $categories,
                'sorular' => $sorular,
            ],
        ]);
    }

    public function category($category_id)
    {
        return $this->index();
    }
}
