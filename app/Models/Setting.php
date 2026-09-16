<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $casts = [
        'working_hours' => 'array',
        'closed_dates' => 'array',
        'notify_email_enabled' => 'boolean',
        'notify_sms_enabled' => 'boolean',
    ];
}
