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
            $item->created_by = auth()->id();
        }

        $item->name = $request->name;
        $item->email = $request->email;

        // Düzenlerken şifre alanı boş bırakılırsa mevcut şifre korunur;
        // sadece yeni kayıtta ya da şifre gerçekten değiştirilmek
        // istendiğinde güncellenir.
        if ($request->filled('password')) {
            $item->password = bcrypt($request->password);
        }

        // Rolü sadece Yönetici değiştirebilir/atayabilir; Editör rolündeki
        // biri (buraya zaten role middleware'i sayesinde erişemez ama
        // savunma amaçlı) kendi rolünü ya da başkasınınkini yükseltemez.
        if (auth()->user()->isYonetici()) {
            $item->role = in_array($request->role, array_keys(User::ROLES), true)
                ? $request->role
                : User::ROLE_EDITOR;
        } elseif (! $item->exists) {
            $item->role = User::ROLE_EDITOR;
        }

        $item->save();
        return redirect('/admin/kullanicilar')->with('success', 'Kayıt Başarıyla Eklendi.');
    }
    public function del($id)
    {
        if ((int) $id === (int) auth()->id()) {
            return redirect('/admin/kullanicilar')->with('error', 'Kendi hesabınızı silemezsiniz.');
        }
        User::destroy($id);
        return redirect('/admin/kullanicilar')->with('success', 'Kayıt Başarıyla Silindi.');
    }
}
