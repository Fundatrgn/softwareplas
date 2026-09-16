<?php

namespace App\Services\Notifications;

use App\Models\Setting;

/**
 * Ayarlar panelindeki "sms_provider" alanına göre doğru SMS sürücüsünü
 * seçer. Şu an sadece "log" sürücüsü mevcuttur (bkz. LogSmsGateway).
 * Gerçek bir sağlayıcı entegre edildiğinde buraya yeni bir "case"
 * eklenmesi yeterlidir; geri kalan randevu/bildirim kodu değişmeden
 * çalışmaya devam eder.
 */
class SmsManager
{
    public static function driver(?Setting $settings = null): SmsGatewayInterface
    {
        $provider = $settings->sms_provider ?? 'log';

        return match ($provider) {
            // 'netgsm' => new NetgsmSmsGateway($settings),
            // 'iletimerkezi' => new IletiMerkeziSmsGateway($settings),
            default => new LogSmsGateway(),
        };
    }
}
