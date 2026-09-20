<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use App\Models\Setting;
use App\Services\AppointmentNotificationService;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

/**
 * Ertesi gün randevusu olan danışanlara otomatik hatırlatma (e-posta/SMS)
 * gönderir. Zamanlayıcı (app/Console/Kernel.php) tarafından her saat
 * başı tetiklenir; bir randevu için hatırlatma sadece bir kez gönderilir
 * (reminder_sent_at alanı işaretlenir).
 *
 * Bu komutun gerçekten çalışması için sunucuda Laravel scheduler'ın
 * cron'a bağlanmış olması gerekir:
 *   * * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1
 */
class SendAppointmentReminders extends Command
{
    protected $signature = 'appointments:send-reminders {--hours= : Kaç saat sonrasına kadar olan randevular hatırlatılsın (boşsa Ayarlar > Randevu Bildirimleri\'ndeki değer kullanılır)}';

    protected $description = 'Yaklaşan randevular için hatırlatma e-postası/SMS gönderir';

    public function handle(AppointmentNotificationService $notifier): int
    {
        $hours = (int) ($this->option('hours') ?: (Setting::first()->reminder_hours_before ?? 24));
        $windowStart = Carbon::now();
        $windowEnd = Carbon::now()->addHours($hours);

        $appointments = Appointment::whereNull('reminder_sent_at')
            ->whereIn('status', [Appointment::STATUS_PENDING, Appointment::STATUS_CONFIRMED])
            ->whereBetween('starts_at', [$windowStart, $windowEnd])
            ->get();

        foreach ($appointments as $appointment) {
            $notifier->notifyReminder($appointment);
        }

        $this->info("{$appointments->count()} randevu için hatırlatma gönderildi.");

        return self::SUCCESS;
    }
}
