<?php

namespace App\Services\Notifications;

use Illuminate\Support\Facades\Log;

/**
 * Varsayılan SMS "sürücüsü". Gerçek bir SMS sağlayıcısı (NetGSM,
 * İleti Merkezi, Twilio vb.) henüz bağlı değil; bu sürücü mesajı
 * gerçekten göndermek yerine sadece log dosyasına yazar ve başarılı
 * kabul eder. Böylece randevu akışının geri kalanı (bildirim kaydı,
 * "gönderildi" işaretlemesi vb.) tam olarak gerçek bir sağlayıcı
 * bağlandığında çalışacak şekilde şimdiden test edilebilir.
 *
 * Gerçek sağlayıcı eklemek için: bu arayüzü (SmsGatewayInterface)
 * implemente eden yeni bir sınıf yazıp SmsManager::driver() içine
 * eklemek yeterlidir.
 */
class LogSmsGateway implements SmsGatewayInterface
{
    public function send(string $to, string $message): array
    {
        Log::info('[SMS-LOG] Gönderilecek SMS (gerçek sağlayıcı bağlı değil)', [
            'to' => $to,
            'message' => $message,
        ]);

        return ['success' => true, 'error' => null];
    }
}
