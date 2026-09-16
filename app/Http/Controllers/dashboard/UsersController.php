<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $data = User::get();
        return view('dashboard.users.index', ['data' => $data]);
    }
    public function edit($id)
    {
        $data = User::find($id);
        return view('dashboard.users.add', ['data' => $data]);
    }
    public function add()
    {

        return view('dashboard.users.add');
    }
    public function store(Request $request)
    {
        if ($request->id) {
            $item = User::find($request->id);
        } else {
            $item = new User();
        }

        $item->name = $request->name;
        $item->email = $request->email;
        $item->password = bcrypt($request->password);
        $item->created_by = 1;
        // auth()->user()->id
        $item->save();
        return redirect('/admin/kullanicilar')->with('success', 'Kayıt Başarıyla Eklendi.');
    }
    public function del($id)
    {
        $data = User::destroy($id);
        return redirect('/admin/kullanicilar')->with('success', 'Kayıt Başarıyla Silindi.');
    }
}
