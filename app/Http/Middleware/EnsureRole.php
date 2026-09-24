<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Admin panelinde rol bazlı erişim kısıtlaması. "Editör" rolündeki bir
 * kullanıcı, izin verilmeyen bir bölüme (ör. Ayarlar, Kullanıcı
 * Yönetimi, gelen mesajlar) doğrudan URL ile gitmeye çalışırsa, sessiz
 * bir 403 yerine anlaşılır bir mesajla panel anasayfasına yönlendirilir.
 */
class EnsureRole
{
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        $user = $request->user();

        if (! $user || ! in_array($user->role, $roles, true)) {
            return redirect('/admin')->with('error', 'Bu bölüme erişim yetkiniz yok.');
        }

        return $next($request);
    }
}
