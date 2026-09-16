<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    // Durumlar
    const STATUS_PENDING = 'bekliyor';
    const STATUS_CONFIRMED = 'onaylandi';
    const STATUS_COMPLETED = 'tamamlandi';
    const STATUS_CANCELLED = 'iptal';
    const STATUS_NO_SHOW = 'gelmedi';

    const STATUSES = [
        self::STATUS_PENDING => 'Bekliyor',
        self::STATUS_CONFIRMED => 'Onaylandı',
        self::STATUS_COMPLETED => 'Tamamlandı',
        self::STATUS_CANCELLED => 'İptal Edildi',
        self::STATUS_NO_SHOW => 'Gelmedi',
    ];

    // Kaynaklar
    const SOURCE_WEB = 'web';
    const SOURCE_PANEL = 'panel';
    const SOURCE_WALKIN = 'yuz_yuze';

    const SOURCES = [
        self::SOURCE_WEB => 'Web Sitesi',
        self::SOURCE_PANEL => 'CRM Panel',
        self::SOURCE_WALKIN => 'Yüz Yüze (Kurum Ziyareti)',
    ];

    // Bu durumlarda slot dolu sayılır (yeni randevu alınamaz)
    const BLOCKING_STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_CONFIRMED,
        self::STATUS_COMPLETED,
    ];

    protected $fillable = [
        'patient_id',
        'service_id',
        'user_id',
        'created_by',
        'starts_at',
        'ends_at',
        'duration_minutes',
        'status',
        'source',
        'patient_name_snapshot',
        'patient_phone_snapshot',
        'patient_email_snapshot',
        'request_note',
        'doctor_notes',
        'cancel_reason',
        'confirmation_sent_at',
        'reminder_sent_at',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'confirmation_sent_at' => 'datetime',
        'reminder_sent_at' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function service()
    {
        return $this->belongsTo(Services::class, 'service_id');
    }

    public function psychologist()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function notificationLogs()
    {
        return $this->hasMany(NotificationLog::class);
    }

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    public function sourceLabel(): string
    {
        return self::SOURCES[$this->source] ?? $this->source;
    }

    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function scopeBlocking($query)
    {
        return $query->whereIn('status', self::BLOCKING_STATUSES);
    }

    public function scopeOnDate($query, string $date)
    {
        return $query->whereDate('starts_at', $date);
    }

    public function scopeOverlapping($query, $startsAt, $endsAt)
    {
        return $query->where('starts_at', '<', $endsAt)
            ->where('ends_at', '>', $startsAt);
    }
}
