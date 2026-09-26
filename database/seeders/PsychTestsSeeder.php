<?php

namespace Database\Seeders;

use App\Models\Test;
use App\Models\TestQuestion;
use App\Models\TestQuestionOption;
use Illuminate\Database\Seeder;

/**
 * Danışan Portalı öz-değerlendirme testleri (PHQ-9, GAD-7 — serbestçe
 * kullanılabilen, telifsiz standart tarama ölçekleri). Diğer tüm testler
 * gibi tek-seçimli sorular + seçenek/puan yapısı kullanır (bkz.
 * TestQuestionOption), böylece admin panelinden de düzenlenebilirler.
 */
class PsychTestsSeeder extends Seeder
{
    private array $olcek = [
        ['label' => 'Hiç', 'value' => 0],
        ['label' => 'Birkaç gün', 'value' => 1],
        ['label' => 'Yarısından fazla günlerde', 'value' => 2],
        ['label' => 'Neredeyse her gün', 'value' => 3],
    ];

    public function run(): void
    {
        if (Test::where('key', 'phq9')->exists()) {
            return;
        }

        $phq9 = new Test();
        $phq9->key = 'phq9';
        $phq9->name = 'PHQ-9 (Depresyon Tarama Ölçeği)';
        $phq9->description = 'Son 2 haftada aşağıdaki sorunlardan ne sıklıkla rahatsızlık duydunuz?';
        $phq9->save();

        $phq9Sorular = [
            'İşleri yapmaya karşı ilgi duymama veya bunlardan zevk almama',
            'Kendini çökkün, depresif ya da umutsuz hissetme',
            'Uykuya dalmakta/uykuyu sürdürmekte güçlük çekme, ya da çok fazla uyuma',
            'Yorgun hissetme veya enerjisinin az olması',
            'İştahsızlık ya da aşırı yeme',
            'Kendini kötü hissetme; başarısız biri olduğunu ya da kendinizi/ailenizi hayal kırıklığına uğrattığınızı düşünme',
            'Gazete okumak veya televizyon izlemek gibi işlere odaklanmakta güçlük çekme',
            'Başkalarının fark edebileceği kadar yavaş hareket etme/konuşma, ya da tam tersi her zamankinden çok daha huzursuz/hareketli olma',
            'Kendinize zarar vermeyi düşünme veya keşke ölseydim diye düşünme',
        ];
        foreach ($phq9Sorular as $i => $soru) {
            $this->soruEkle($phq9->id, $i + 1, $soru);
        }

        $gad7 = new Test();
        $gad7->key = 'gad7';
        $gad7->name = 'GAD-7 (Anksiyete Tarama Ölçeği)';
        $gad7->description = 'Son 2 haftada aşağıdaki sorunlardan ne sıklıkla rahatsızlık duydunuz?';
        $gad7->save();

        $gad7Sorular = [
            'Sinirli, endişeli ya da gergin hissetme',
            'Endişelenmeyi durduramama ya da kontrol edememe',
            'Farklı konular hakkında çok fazla endişelenme',
            'Rahatlamakta güçlük çekme',
            'Yerinde duramayacak kadar huzursuz hissetme',
            'Kolayca sinirlenme ya da huzursuzlaşma',
            'Sanki kötü bir şey olacakmış gibi korku hissetme',
        ];
        foreach ($gad7Sorular as $i => $soru) {
            $this->soruEkle($gad7->id, $i + 1, $soru);
        }
    }

    private function soruEkle(int $testId, int $sira, string $metin): void
    {
        $q = new TestQuestion();
        $q->test_id = $testId;
        $q->order = $sira;
        $q->text = $metin;
        $q->type = TestQuestion::TYPE_SINGLE;
        $q->save();

        foreach ($this->olcek as $i => $secenek) {
            $opt = new TestQuestionOption();
            $opt->test_question_id = $q->id;
            $opt->label = $secenek['label'];
            $opt->value = $secenek['value'];
            $opt->order = $i;
            $opt->save();
        }
    }
}
