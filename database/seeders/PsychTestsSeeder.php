<?php

namespace Database\Seeders;

use App\Models\Test;
use App\Models\TestQuestion;
use Illuminate\Database\Seeder;

/**
 * Danışan Portalı öz-değerlendirme testleri (PHQ-9, GAD-7 — serbestçe
 * kullanılabilen, telifsiz standart tarama ölçekleri).
 */
class PsychTestsSeeder extends Seeder
{
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
            $q = new TestQuestion();
            $q->test_id = $phq9->id;
            $q->order = $i + 1;
            $q->text = $soru;
            $q->save();
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
            $q = new TestQuestion();
            $q->test_id = $gad7->id;
            $q->order = $i + 1;
            $q->text = $soru;
            $q->save();
        }
    }
}
