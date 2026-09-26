<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Test;
use App\Models\TestAssignment;
use Illuminate\Http\Request;

class TestAssignmentController extends Controller
{
    /**
     * Bir test seçildikten sonra, atamadan önce hangi soruların dahil
     * edileceğini seçme adımı (varsayılan: tümü işaretli).
     * GET /admin/danisanlar/{patient}/test-ata/{test}
     */
    public function customize($patientId, $testId)
    {
        $patient = Patient::findOrFail($patientId);
        $test = Test::with('questions.options')->findOrFail($testId);

        return view('dashboard.danisanlar.test-ata-ozellestir', [
            'patient' => $patient,
            'test' => $test,
        ]);
    }

    /**
     * Bir danışana yeni bir test atar (danışan portalında görünür).
     * POST /admin/danisanlar/{patient}/test-ata
     */
    public function assign(Request $request, $patientId)
    {
        $patient = Patient::findOrFail($patientId);

        $request->validate([
            'test_id' => 'required|exists:tests,id',
            'question_ids' => 'nullable|array',
            'question_ids.*' => 'integer|exists:test_questions,id',
        ]);

        $test = Test::findOrFail($request->test_id);
        $secilenSorular = $request->input('question_ids', []);
        $tumSoruSayisi = $test->questions()->count();

        $assignment = new TestAssignment();
        $assignment->patient_id = $patient->id;
        $assignment->test_id = $test->id;
        // Tüm sorular işaretliyse null bırakılır (testin ileride
        // eklenecek yeni sorularını da otomatik kapsasın diye);
        // aksi halde sadece seçilen alt küme kaydedilir.
        $assignment->question_ids = (count($secilenSorular) < $tumSoruSayisi) ? array_values($secilenSorular) : null;
        $assignment->assigned_by = auth()->id();
        $assignment->status = TestAssignment::STATUS_PENDING;
        $assignment->save();

        return redirect('/admin/danisanlar/' . $patient->id)->with('success', 'Test danışana atandı.');
    }

    /**
     * Tamamlanmış bir testin cevap detayını gösterir.
     * GET /admin/testler/{id}
     */
    public function show($id)
    {
        $assignment = TestAssignment::with('patient', 'test.questions.options')->findOrFail($id);

        return view('dashboard.testler.show', [
            'assignment' => $assignment,
            'sorular' => $assignment->applicableQuestions(),
        ]);
    }

    public function destroy($id)
    {
        $assignment = TestAssignment::findOrFail($id);
        $patientId = $assignment->patient_id;
        $assignment->delete();

        return redirect('/admin/danisanlar/' . $patientId)->with('success', 'Test ataması silindi.');
    }
}
