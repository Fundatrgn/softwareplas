<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    public function index()
    {
        $data = Team::orderBy('name', 'ASC')->get();
        return view('general.ekibimiz', ['data' => $data]);
    }

    public function detay($id, $slug)
    {
        $item = Team::findOrFail($id);
        return view('general.ekibimiz-detay', ['item' => $item]);
    }

    public static function slug(Team $team): string
    {
        return Str::slug($team->name);
    }
}
