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
        'question_ids' => 'array',
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

    /**
     * Bu atamada kullanılacak sorular: admin bu atamaya özel bir soru
     * alt kümesi seçtiyse (question_ids) sadece onlar, aksi halde
     * testin tüm soruları.
     */
    public function applicableQuestions()
    {
        $tumSorular = $this->test->questions()->with('options')->get();

        if (empty($this->question_ids)) {
            return $tumSorular;
        }

        return $tumSorular->whereIn('id', $this->question_ids)->values();
    }

    /**
     * Formdan gelen cevapları (cevap[soru_id] = seçenek_id | [seçenek_id,...] | metin)
     * doğrular, puanlar ve kaydeder. Tek/çoklu seçim sorularının puanı
     * seçilen seçeneklerin "value" toplamıdır; açık uçlu sorular puanlamaya
     * dahil edilmez, sadece metin olarak saklanır.
     */
    public function applyAnswers(array $cevaplar): void
    {
        $sorular = $this->applicableQuestions();
        $answers = [];
        $toplam = 0;

        foreach ($sorular as $q) {
            $cevap = $cevaplar[$q->id] ?? null;

            if ($q->type === 'text') {
                $answers[$q->id] = (string) $cevap;
                continue;
            }

            if ($q->type === 'multi_choice') {
                $secilenler = array_map('intval', (array) $cevap);
                $answers[$q->id] = $secilenler;
                $toplam += $q->options->whereIn('id', $secilenler)->sum('value');
                continue;
            }

            // single_choice
            $secilenId = (int) $cevap;
            $answers[$q->id] = $secilenId;
            $toplam += (int) ($q->options->firstWhere('id', $secilenId)?->value ?? 0);
        }

        $this->answers = $answers;
        $this->score = $toplam;
        $this->status = self::STATUS_COMPLETED;
        $this->completed_at = now();
        $this->save();
    }
}
