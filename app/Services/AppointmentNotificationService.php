<?php

namespace App\Services;

use App\Mail\AppointmentNotificationMail;
use App\Models\Appointment;
use App\Models\NotificationLog;
use App\Models\Setting;
use App\Services\Notifications\SmsManager;
use Illuminate\Support\Facades\Mail;
use Throwable;

/**
 * Randevu bildirimlerinin (e-posta + SMS) tek merkezden yönetildiği
 * servis. Randevu oluşturulduğunda/durumu değiştiğinde buradaki
 * metodlar çağrılır; her deneme (başarılı/başarısız) notification_logs
 * tablosuna kaydedilir, böylece admin panelinden "hangi bildirim ne
 * zaman, kime gitti" görülebilir.
 *
 * SMS tarafı şu an gerçek bir sağlayıcıya bağlı değil (log sürücüsü) —
 * bkz. App\Services\Notifications\SmsManager. E-posta gerçekten
 * çalışır durumdadır (Laravel Mail; .env'deki MAIL_* ayarlarına göre).
 */
class AppointmentNotificationService
{
    public function notifyCreated(Appointment $appointment): void
    {
        $settings = Setting::first();

        $heading = 'Randevunuz Alındı';
        $intro = 'Randevu talebiniz sisteme kaydedildi. Aşağıda randevu detaylarını bulabilirsiniz.';

        $this->sendEmail($appointment, $settings, 'olusturuldu', $heading, $intro);
        $this->sendSms($appointment, $settings, 'olusturuldu',
            "Sayın {$this->patientName($appointment)}, {$appointment->starts_at->format('d.m.Y H:i')} tarihli randevunuz alınmıştır.");

        $this->notifyClinic($appointment, $settings);
    }

    public function notifyStatusChanged(Appointment $appointment): void
    {
        $settings = Setting::first();

        $heading = match ($appointment->status) {
            Appointment::STATUS_CONFIRMED => 'Randevunuz Onaylandı',
            Appointment::STATUS_CANCELLED => 'Randevunuz İptal Edildi',
            Appointment::STATUS_COMPLETED => 'Randevunuz Tamamlandı',
            default => 'Randevu Durumu Güncellendi',
        };
        $intro = 'Randevunuzun durumu güncellendi: ' . $appointment->statusLabel() . '.';

        $this->sendEmail($appointment, $settings, 'durum_guncellendi', $heading, $intro);
        $this->sendSms($appointment, $settings, 'durum_guncellendi',
            "Sayın {$this->patientName($appointment)}, {$appointment->starts_at->format('d.m.Y H:i')} tarihli randevunuzun durumu: {$appointment->statusLabel()}.");
    }

    /**
     * @param int $gunOnce Randevudan kaç gün önce gönderildiği (ör. 1, 7).
     *                     notification_logs'ta bu bilgiye göre ayrı bir
     *                     "type" ile kaydedilir, böylece aynı randevu için
     *                     farklı hatırlatma zamanlamaları birbirini
     *                     engellemez/tekrar etmez.
     */
    public function notifyReminder(Appointment $appointment, int $gunOnce = 1): void
    {
        $settings = Setting::first();
        $type = "hatirlatma_{$gunOnce}gun";

        $gunMetni = $gunOnce === 1 ? '1 gün' : "{$gunOnce} gün";

        $this->sendEmail($appointment, $settings, $type, 'Randevu Hatırlatması',
            "Randevunuza {$gunMetni} kaldı. Yaklaşan randevunuzu hatırlatmak isteriz.");
        $this->sendSms($appointment, $settings, $type,
            "Sayın {$this->patientName($appointment)}, {$appointment->starts_at->format('d.m.Y H:i')} tarihinde randevunuz bulunmaktadır ({$gunMetni} kaldı).");

        $appointment->update(['reminder_sent_at' => now()]);
    }

    protected function notifyClinic(Appointment $appointment, ?Setting $settings): void
    {
        if (empty($settings?->email)) {
            return;
        }

        try {
            Mail::to($settings->email)->send(new AppointmentNotificationMail(
                $appointment,
                'Yeni Randevu Talebi',
                'Sitede yeni bir randevu talebi/kaydı oluşturuldu.'
            ));

            NotificationLog::create([
                'appointment_id' => $appointment->id,
                'channel' => NotificationLog::CHANNEL_EMAIL,
                'type' => 'klinik_bilgilendirme',
                'recipient' => $settings->email,
                'status' => NotificationLog::STATUS_SENT,
            ]);
        } catch (Throwable $e) {
            NotificationLog::create([
                'appointment_id' => $appointment->id,
                'channel' => NotificationLog::CHANNEL_EMAIL,
                'type' => 'klinik_bilgilendirme',
                'recipient' => $settings->email,
                'status' => NotificationLog::STATUS_FAILED,
                'error' => $e->getMessage(),
            ]);
        }
    }

    protected function sendEmail(Appointment $appointment, ?Setting $settings, string $type, string $heading, string $intro): void
    {
        if (! ($settings->notify_email_enabled ?? true)) {
            return;
        }

        $to = $appointment->patient_email_snapshot ?? $appointment->patient?->email;
        if (empty($to)) {
            return;
        }

        $cancellable = ! in_array($appointment->status, [
            Appointment::STATUS_CANCELLED,
            Appointment::STATUS_COMPLETED,
            Appointment::STATUS_NO_SHOW,
        ], true);

        try {
            Mail::to($to)->send(new AppointmentNotificationMail($appointment, $heading, $intro, $cancellable));

            NotificationLog::create([
                'appointment_id' => $appointment->id,
                'channel' => NotificationLog::CHANNEL_EMAIL,
                'type' => $type,
                'recipient' => $to,
                'status' => NotificationLog::STATUS_SENT,
            ]);
        } catch (Throwable $e) {
            NotificationLog::create([
                'appointment_id' => $appointment->id,
                'channel' => NotificationLog::CHANNEL_EMAIL,
                'type' => $type,
                'recipient' => $to,
                'status' => NotificationLog::STATUS_FAILED,
                'error' => $e->getMessage(),
            ]);
        }
    }

    protected function sendSms(Appointment $appointment, ?Setting $settings, string $type, string $message): void
    {
        if (! ($settings->notify_sms_enabled ?? false)) {
            return;
        }

        $to = $appointment->patient_phone_snapshot ?? $appointment->patient?->phone;
        if (empty($to)) {
            return;
        }

        $result = SmsManager::driver($settings)->send($to, $message);

        NotificationLog::create([
            'appointment_id' => $appointment->id,
            'channel' => NotificationLog::CHANNEL_SMS,
            'type' => $type,
            'recipient' => $to,
            'message' => $message,
            'status' => $result['success'] ? NotificationLog::STATUS_SENT : NotificationLog::STATUS_FAILED,
            'error' => $result['error'] ?? null,
        ]);
    }

    protected function patientName(Appointment $appointment): string
    {
        return $appointment->patient_name_snapshot ?? $appointment->patient?->name ?? '';
    }
}
