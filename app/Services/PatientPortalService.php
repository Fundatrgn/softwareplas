<?php

namespace App\Services;

use App\Mail\PatientPortalCredentialsMail;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

/**
 * Danışan Portalı giriş bilgilerini yönetir. Danışan kendi şifresini asla
 * sıfırlayamaz; bu bilerek tek yönlü, sadece admin/psikolog tarafından
 * tetiklenen bir akıştır (randevu onayı ile otomatik, ya da admin panelinden
 * elle "Şifreyi Sıfırla").
 */
class PatientPortalService
{
    /**
     * Danışanın portal girişi yoksa oluşturur ve e-posta ile gönderir.
     * Zaten girişi varsa hiçbir şey yapmaz (mevcut şifreyi geçersiz kılmaz).
     */
    public function ensureCredentials(Patient $patient): void
    {
        if ($patient->hasPortalAccess()) {
            return;
        }

        $this->generateAndSend($patient);
    }

    /**
     * Admin panelinden elle tetiklenir: mevcut şifreyi geçersiz kılıp
     * yenisini üretir ve danışana e-postayla gönderir.
     */
    public function resetPassword(Patient $patient): string
    {
        return $this->generateAndSend($patient, forceNewPassword: true);
    }

    private function generateAndSend(Patient $patient, bool $forceNewPassword = false): string
    {
        if (empty($patient->username)) {
            $patient->username = $this->generateUsername($patient);
        }

        $plainPassword = $this->generatePassword();
        $patient->password = Hash::make($plainPassword);
        $patient->portal_credentials_sent_at = now();
        $patient->save();

        if (! empty($patient->email)) {
            try {
                Mail::to($patient->email)->send(new PatientPortalCredentialsMail($patient, $plainPassword));
            } catch (\Throwable $e) {
                // E-posta gönderimi (ör. sandbox/ağ kısıtlaması) başarısız olsa
                // bile şifre veritabanında güncellenmiş olarak kalır; admin
                // panelinden "Şifreyi Görüntüle/Sıfırla" ile paylaşılabilir.
            }
        }

        return $plainPassword;
    }

    private function generateUsername(Patient $patient): string
    {
        return 'p' . $patient->id;
    }

    private function generatePassword(): string
    {
        // Karışması kolay karakterler (0/O, 1/l/I) çıkarılmış, okunması
        // kolay 8 haneli bir şifre.
        $alphabet = 'ABCDEFGHJKMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789';
        $password = '';
        for ($i = 0; $i < 8; $i++) {
            $password .= $alphabet[random_int(0, strlen($alphabet) - 1)];
        }
        return $password;
    }
}
