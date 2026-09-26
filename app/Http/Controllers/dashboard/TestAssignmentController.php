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
     * Bir danışana yeni bir test atar (danışan portalında görünür).
     * POST /admin/danisanlar/{patient}/test-ata
     */
    public function assign(Request $request, $patientId)
    {
        $patient = Patient::findOrFail($patientId);

        $request->validate([
            'test_id' => 'required|exists:tests,id',
        ]);

        $assignment = new TestAssignment();
        $assignment->patient_id = $patient->id;
        $assignment->test_id = $request->test_id;
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
        $assignment = TestAssignment::with('patient', 'test.questions')->findOrFail($id);

        return view('dashboard.testler.show', ['assignment' => $assignment]);
    }

    public function destroy($id)
    {
        $assignment = TestAssignment::findOrFail($id);
        $patientId = $assignment->patient_id;
        $assignment->delete();

        return redirect('/admin/danisanlar/' . $patientId)->with('success', 'Test ataması silindi.');
    }
}
