<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestAssignment extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'bekliyor';
    const STATUS_COMPLETED = 'tamamlandi';

    protected $casts = [
        'answers' => 'array',
        'completed_at' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function severityLabel(): ?string
    {
        if (! $this->isCompleted() || $this->score === null) {
            return null;
        }
        return $this->test->severityLabel($this->score);
    }
}
