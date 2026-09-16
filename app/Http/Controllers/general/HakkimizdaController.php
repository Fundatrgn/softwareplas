<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Models\Hakkimizda;
use Illuminate\Http\Request;

class HakkimizdaController extends Controller
{
    public function index()
    {
        $hakkimizda = Hakkimizda::orderBy('position', 'ASC')->get();

        $data = [
            "hakkimizda" => $hakkimizda,
        ];
        return view('general.about', ['data' => $data]);
    }
}
