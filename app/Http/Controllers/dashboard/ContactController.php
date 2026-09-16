<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        $data = Contact::get();
        return view('dashboard.contact.index', ['data' => $data]);
    }
    public function edit($id)
    {
        $data = Contact::find($id);
        return view('dashboard.contact.add', ['data' => $data]);
    }
    public function add()
    {

        return view('dashboard.ayarlar.add');
    }
    public function store(Request $request)
    {
        if ($request->id) {
            $item = Contact::find($request->id);
        } else {
            $item = new Contact();
        }
        $item->name = $request->name;
        $item->email = $request->email;
        $item->phone = $request->phone;
        $item->type = $request->type ?? "Hızlı İletişim";
        $item->content = $request->content ." ".$request->website ?? ''; 
        $item->save();
        return redirect()->back()->with('success', 'Mesajınız bize ulaştı en kısa sürede size dönüş yapılacaktır.');
    }
    public function del($id)
    {
        $data = Contact::destroy($id);
        return redirect('/admin/contact')->with('success', 'Kayıt Başarıyla Silindi.');
    }
}
