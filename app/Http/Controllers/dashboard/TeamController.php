<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $data = Team::orderBy('name', 'ASC')->get();
        return view('dashboard.kurumsal.team.index', ['data' => $data]);
    }
    public function edit($id)
    {
        $data = Team::find($id);
        return view('dashboard.kurumsal.team.add', ['data' => $data]);
    }
    public function add()
    {
        return view('dashboard.kurumsal.team.add');
    }
    public function store(Request $request)
    {
        if ($request->id) {
            $item = Team::find($request->id);
        } else {
            $item = new Team();
        }

        $item->title = $request->title;
        $item->name = $request->name;
        $item->linkedin = $request->linkedin;
        $item->instagram = $request->instagram;
        $item->twitter = $request->twitter;
        $item->youtube = $request->youtube;
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
        return redirect('/admin/ekibimiz')->with('success', 'Kayıt Başarıyla Eklendi.');
    }
    public function del($id)
    {
        $data = Team::destroy($id);
        return redirect('/admin/ekibimiz')->with('success', 'Kayıt Başarıyla Silindi.');
    }
}
