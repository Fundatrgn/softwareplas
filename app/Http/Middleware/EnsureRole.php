<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Admin panelinde rol bazlı erişim kısıtlaması. "Psikolog" rolündeki
 * bir kullanıcı, izin verilmeyen bir bölüme (ör. Ayarlar, Kullanıcı
 * Yönetimi, İçerik yönetimi) doğrudan URL ile gitmeye çalışırsa,
 * sessiz bir 403 yerine anlaşılır bir mesajla randevu takvimine
 * yönlendirilir — menüde zaten görünmeyen bir bağlantıya "yanlışlıkla"
 * gitmiş olma ihtimaline karşı.
 */
class EnsureRole
{
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        $user = $request->user();

        if (! $user || ! in_array($user->role, $roles, true)) {
            return redirect('/admin/randevular')->with('error', 'Bu bölüme erişim yetkiniz yok.');
        }

        return $next($request);
    }
}
