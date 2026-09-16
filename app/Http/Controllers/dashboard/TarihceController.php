<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Tarihce;
use Illuminate\Http\Request;

class TarihceController extends Controller
{
    public function index()
    {
        $data = Tarihce::orderBy('year', 'DESC')->get();
        return view('dashboard.tarihce.index', ['data' => $data]);
    }
    public function edit($id)
    {
        $data = Tarihce::find($id);
        return view('dashboard.tarihce.add', ['data' => $data]);
    }
    public function add()
    {
        return view('dashboard.tarihce.add');
    }
    public function store(Request $request)
    {
        if ($request->id) {
            $item = Tarihce::find($request->id);
        } else {
            $item = new Tarihce();
        }

        $item->title = $request->title;
        $item->year = $request->year;
      

        $item->save();
        return redirect('/admin/tarihce')->with('success', 'Kayıt Başarıyla Eklendi.');
    }
    public function del($id)
    {
        $data = Tarihce::destroy($id);
        return redirect('/admin/tarihce')->with('success', 'Kayıt Başarıyla Silindi.');
    }
}
