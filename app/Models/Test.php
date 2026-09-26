<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    public function questions()
    {
        return $this->hasMany(TestQuestion::class)->orderBy('order');
    }

    public function assignments()
    {
        return $this->hasMany(TestAssignment::class);
    }

    /**
     * PHQ-9 ve GAD-7 için standart, klinik olarak yaygın kullanılan
     * (telifsiz/serbest) şiddet aralıkları. Farklı bir test eklenirse
     * burada yeni bir dal eklenmesi yeterlidir.
     */
    public function severityLabel(int $score): string
    {
        if ($this->key === 'phq9') {
            return match (true) {
                $score >= 20 => 'Şiddetli',
                $score >= 15 => 'Orta-Şiddetli',
                $score >= 10 => 'Orta Düzey',
                $score >= 5 => 'Hafif',
                default => 'Minimal',
            };
        }

        if ($this->key === 'gad7') {
            return match (true) {
                $score >= 15 => 'Şiddetli',
                $score >= 10 => 'Orta Düzey',
                $score >= 5 => 'Hafif',
                default => 'Minimal',
            };
        }

        return '—';
    }
}
