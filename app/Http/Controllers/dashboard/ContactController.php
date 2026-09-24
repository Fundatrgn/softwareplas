<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $data = Contact::orderBy('created_at', 'DESC')->get();
        return view('dashboard.contact.index', ['data' => $data]);
    }

    public function edit($id)
    {
        $data = Contact::findOrFail($id);
        return view('dashboard.contact.add', ['data' => $data]);
    }

    /**
     * Sitedeki iletişim formundan gelen mesajı kaydeder. "website" adlı
     * gizli alan bir bal küpüdür (honeypot): gerçek ziyaretçiler bu alanı
     * görmez; dolu gelirse gönderim bir spam botuna aittir ve sessizce
     * yok sayılır.
     */
    public function store(Request $request)
    {
        if ($request->filled('website')) {
            return redirect()->back()->with('success', 'Mesajınız alındı, teşekkürler.');
        }

        $data = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email:rfc,filter|max:190',
            'phone' => 'nullable|string|max:40',
            'type' => 'nullable|string|max:120',
            'content' => 'required|string|max:5000',
            'kvkk' => 'accepted',
        ], [
            'name.required' => 'Lütfen adınızı yazın.',
            'email.required' => 'Lütfen e-posta adresinizi yazın.',
            'email.email' => 'Lütfen geçerli bir e-posta adresi yazın.',
            'content.required' => 'Lütfen mesajınızı yazın.',
            'kvkk.accepted' => 'Devam etmek için KVKK aydınlatma metnini onaylamanız gerekiyor.',
        ]);

        Contact::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'type' => $data['type'] ?? 'İletişim Formu',
            'content' => $data['content'],
        ]);

        return redirect(url()->previous() . '#contact')->with('contact_success', 'Mesajınız ulaştı, en kısa sürede size dönüş yapacağım. Teşekkürler!');
    }

    public function del($id)
    {
        Contact::destroy($id);
        return redirect('/admin/contact')->with('success', 'Kayıt Başarıyla Silindi.');
    }
}
