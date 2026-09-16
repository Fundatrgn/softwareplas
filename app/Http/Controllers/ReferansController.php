<?php

namespace App\Http\Controllers;

use App\Models\ReferansLogo;
use Illuminate\Http\Request;

class ReferansController extends Controller
{
    public function index()
    {
        $data = ReferansLogo::orderBy('created_at', 'DESC')->get();
        return view('dashboard.referanslogo.index', ['data' => $data]);
    }
    public function edit($id)
    {
        $data = ReferansLogo::find($id);
        return view('dashboard.referanslogo.add', ['data' => $data]);
    }
    public function add()
    {
        return view('dashboard.referanslogo.add');
    }
    public function store(Request $request)
    {
        if ($request->id) {
            $item = ReferansLogo::find($request->id);
        } else {
            $item = new ReferansLogo();
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $item->image =  $imageName;
        }
       
        $item->save();
        return redirect('/admin/referanslogo')->with('success', 'Kayıt Başarıyla Eklendi.');
    }
    public function del($id)
    {
        $data = ReferansLogo::destroy($id);
        return redirect('/admin/referanslogo')->with('success', 'Kayıt Başarıyla Silindi.');
    }
}
