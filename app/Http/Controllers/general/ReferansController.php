<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Models\Referans;
use App\Models\ReferansCategory;
use Illuminate\Http\Request;

class ReferansController extends Controller
{
    public function index()
    {
        $referans = Referans::with('category')->orderBy('order', 'ASC')->get();
        $referansCategory = ReferansCategory::get();

        $data = [
            "referans" => $referans,
            "referansCategory" => $referansCategory,
        ];
        return view('general.portfolio', ['data' => $data]);
    }
    public function detay($id)
    {
        $referans = Referans::with('category')->where('id', $id)->first();
        if ($referans) {
            // Önceki kayıt
            $previousReferans = Referans::where('id', '<', $referans->id)->orderBy('id', 'desc')->first();

            // Sonraki kayıt
            $nextReferans = Referans::where('id', '>', $referans->id)->orderBy('id', 'asc')->first();
        }
        $referansCategory = ReferansCategory::get();

        $data = [
            "title" => $referans->title ?? '',
            "referans" => $referans,
            "referansCategory" => $referansCategory,
            "previousReferans" => $previousReferans,
            "nextReferans" => $nextReferans,
        ];
        return view('general.portfolio-detay', ['data' => $data]);
    }
}
