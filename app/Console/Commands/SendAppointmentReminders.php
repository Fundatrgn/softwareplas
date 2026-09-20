<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use App\Models\Setting;
use App\Services\AppointmentNotificationService;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

/**
 * Yaklaşan randevusu olan danışanlara, admin panelinde (E-posta Ayarları)
 * seçilen her bir zamanlama için (ör. "7 gün kala" VE "1 gün kala" aynı
 * anda) otomatik hatırlatma (e-posta/SMS) gönderir. Zamanlayıcı
 * (app/Console/Kernel.php) tarafından her saat başı tetiklenir; her
 * randevu + zamanlama kombinasyonu için hatırlatma sadece bir kez
 * gönderilir (notification_logs tablosunda "hatirlatma_{gun}gun" tipiyle
 * kaydedilmiş olması kontrol edilir).
 *
 * Bu komutun gerçekten çalışması için sunucuda Laravel scheduler'ın
 * cron'a bağlanmış olması gerekir:
 *   * * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1
 */
class SendAppointmentReminders extends Command
{
    protected $signature = 'appointments:send-reminders {--gun= : Sadece belirli bir gün önce (ör. 1) için gönder; boşsa Ayarlar > E-posta Ayarları\'ndaki tüm seçili zamanlamalar kullanılır}';

    protected $description = 'Yaklaşan randevular için (admin panelinde seçilen tüm zamanlamalarda) hatırlatma e-postası/SMS gönderir';

    public function handle(AppointmentNotificationService $notifier): int
    {
        $settings = Setting::first();

        $gunSecenekleri = $this->option('gun')
            ? [(int) $this->option('gun')]
            : ($settings->reminder_intervals_days ?: [1]);

        $toplamGonderilen = 0;

        foreach ($gunSecenekleri as $gunOnce) {
            $gunOnce = (int) $gunOnce;
            if ($gunOnce < 1) {
                continue;
            }

            $type = "hatirlatma_{$gunOnce}gun";
            $hedefSaat = Carbon::now()->addDays($gunOnce);
            // Saatlik cron'a uygun 1 saatlik dar bir pencere: aynı randevu
            // için bu zamanlama daha önce hiç kontrol edilmemiş gibi
            // davranıp gereksiz yere her çalıştırmada taranmasını önler.
            $windowStart = $hedefSaat->copy()->subHour();
            $windowEnd = $hedefSaat;

            $appointments = Appointment::whereIn('status', [Appointment::STATUS_PENDING, Appointment::STATUS_CONFIRMED])
                ->whereBetween('starts_at', [$windowStart, $windowEnd])
                ->whereDoesntHave('notificationLogs', function ($q) use ($type) {
                    $q->where('type', $type);
                })
                ->get();

            foreach ($appointments as $appointment) {
                $notifier->notifyReminder($appointment, $gunOnce);
                $toplamGonderilen++;
            }
        }

        $this->info("{$toplamGonderilen} randevu için hatırlatma gönderildi.");

        return self::SUCCESS;
    }
}
