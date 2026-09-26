<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\TestQuestion;
use App\Models\TestQuestionOption;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Admin'in kendi öz-değerlendirme testlerini/sorularını hazırlayabildiği
 * yönetim ekranı. PHQ-9/GAD-7 de dahil tüm testler aynı yapıyı kullanır;
 * bu yüzden hazır gelen ölçekler de buradan (soru ekleme/çıkarma hariç,
 * bkz. not) düzenlenebilir hale gelir.
 */
class TestBuilderController extends Controller
{
    public function index()
    {
        $data = Test::withCount('questions')->orderBy('name')->get();
        return view('dashboard.test-sablonlari.index', ['data' => $data]);
    }

    public function add()
    {
        return view('dashboard.test-sablonlari.add');
    }

    public function edit($id)
    {
        $data = Test::findOrFail($id);
        return view('dashboard.test-sablonlari.add', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        if ($request->id) {
            $test = Test::findOrFail($request->id);
        } else {
            $test = new Test();
            $test->key = $this->uniqueKey($request->name);
        }

        $test->name = $request->name;
        $test->description = $request->description;
        $test->save();

        return redirect('/admin/test-sablonlari/' . $test->id . '/sorular')->with('success', 'Test kaydedildi. Şimdi sorularını ekleyebilirsiniz.');
    }

    public function destroy($id)
    {
        Test::destroy($id);
        return redirect('/admin/test-sablonlari')->with('success', 'Test ve tüm soruları silindi.');
    }

    /**
     * Bir testin sorularını yönetme ekranı (liste + yeni soru ekleme formu).
     */
    public function questions($testId)
    {
        $test = Test::with(['questions.options'])->findOrFail($testId);
        return view('dashboard.test-sablonlari.sorular', ['test' => $test]);
    }

    public function storeQuestion(Request $request, $testId)
    {
        $test = Test::findOrFail($testId);

        $request->validate([
            'text' => 'required|string|max:2000',
            'type' => 'required|in:single_choice,multi_choice,text',
            'option_label' => 'required_unless:type,text|array',
            'option_label.*' => 'nullable|string|max:255',
            'option_value' => 'required_unless:type,text|array',
            'option_value.*' => 'nullable|integer',
        ]);

        $question = new TestQuestion();
        $question->test_id = $test->id;
        $question->order = $test->questions()->max('order') + 1;
        $question->text = $request->text;
        $question->type = $request->type;
        $question->save();

        if ($question->hasOptions()) {
            $this->saveOptions($question, $request->option_label ?? [], $request->option_value ?? []);
        }

        return redirect('/admin/test-sablonlari/' . $test->id . '/sorular')->with('success', 'Soru eklendi.');
    }

    public function editQuestion($id)
    {
        $question = TestQuestion::with('options')->findOrFail($id);
        return view('dashboard.test-sablonlari.soru-duzenle', ['question' => $question]);
    }

    public function updateQuestion(Request $request, $id)
    {
        $question = TestQuestion::findOrFail($id);

        $request->validate([
            'text' => 'required|string|max:2000',
            'type' => 'required|in:single_choice,multi_choice,text',
            'option_label' => 'required_unless:type,text|array',
            'option_label.*' => 'nullable|string|max:255',
            'option_value' => 'required_unless:type,text|array',
            'option_value.*' => 'nullable|integer',
        ]);

        $question->text = $request->text;
        $question->type = $request->type;
        $question->save();

        $question->options()->delete();
        if ($question->hasOptions()) {
            $this->saveOptions($question, $request->option_label ?? [], $request->option_value ?? []);
        }

        return redirect('/admin/test-sablonlari/' . $question->test_id . '/sorular')->with('success', 'Soru güncellendi.');
    }

    public function destroyQuestion($id)
    {
        $question = TestQuestion::findOrFail($id);
        $testId = $question->test_id;
        $question->delete();

        return redirect('/admin/test-sablonlari/' . $testId . '/sorular')->with('success', 'Soru silindi.');
    }

    private function saveOptions(TestQuestion $question, array $labels, array $values): void
    {
        foreach ($labels as $i => $label) {
            $label = trim((string) $label);
            if ($label === '') {
                continue;
            }
            $option = new TestQuestionOption();
            $option->test_question_id = $question->id;
            $option->label = $label;
            $option->value = (int) ($values[$i] ?? 0);
            $option->order = $i;
            $option->save();
        }
    }

    private function uniqueKey(string $name): string
    {
        $base = Str::slug($name) ?: 'test';
        $key = $base;
        $i = 2;
        while (Test::where('key', $key)->exists()) {
            $key = $base . '-' . $i;
            $i++;
        }
        return $key;
    }
}
