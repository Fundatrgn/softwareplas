<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Hakkimizda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HakkimizdaController extends Controller
{
    //
    public function index()
    {
        $data = Hakkimizda::orderBy('position', 'ASC')->get();
        return view('dashboard.kurumsal.about.index', ['data' => $data]);
    }
    public function edit($id)
    {
        $data = Hakkimizda::find($id);
        return view('dashboard.kurumsal.about.add', ['data' => $data]);
    }
    public function add()
    {
        return view('dashboard.kurumsal.about.add');
    }
    public function store(Request $request)
    {
        if ($request->id) {
            $item = Hakkimizda::find($request->id);
        } else {
            $item = new Hakkimizda();
        }

        $item->title = $request->title;
        $item->subtitle = $request->subtitle;
        $item->position = $request->position;
        $item->content = $request->content;

        try {
            $imageName = $this->uploadImage($request);
            if ($imageName) {
                $item->image = $imageName;
            }
        } catch (\RuntimeException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
       
        $item->save();
        return redirect('/admin/hakkimizda')->with('success', 'Kayıt Başarıyla Eklendi.');
    }
    public function del($id)
    {
        $data = Hakkimizda::destroy($id);
        return redirect('/admin/hakkimizda')->with('success', 'Kayıt Başarıyla Silindi.');
    }
}
