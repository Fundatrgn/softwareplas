<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{
    use HasFactory;

    const TYPE_SINGLE = 'single_choice';
    const TYPE_MULTI = 'multi_choice';
    const TYPE_TEXT = 'text';

    const TYPES = [
        self::TYPE_SINGLE => 'Tek Seçim (çoktan seçmeli)',
        self::TYPE_MULTI => 'Çoklu Seçim (birden fazla seçenek)',
        self::TYPE_TEXT => 'Açık Uçlu (yazılı cevap)',
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function options()
    {
        return $this->hasMany(TestQuestionOption::class)->orderBy('order');
    }

    public function typeLabel(): string
    {
        return self::TYPES[$this->type] ?? $this->type;
    }

    public function hasOptions(): bool
    {
        return in_array($this->type, [self::TYPE_SINGLE, self::TYPE_MULTI]);
    }
}
