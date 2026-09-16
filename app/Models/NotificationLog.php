<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationLog extends Model
{
    use HasFactory;

    const CHANNEL_EMAIL = 'email';
    const CHANNEL_SMS = 'sms';

    const STATUS_SENT = 'gonderildi';
    const STATUS_FAILED = 'basarisiz';
    const STATUS_PENDING = 'beklemede';

    protected $fillable = [
        'appointment_id',
        'channel',
        'type',
        'recipient',
        'status',
        'message',
        'error',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
