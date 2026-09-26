<?php

namespace App\Http\Controllers\danisan;

use App\Http\Controllers\Controller;
use App\Models\TestAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortalController extends Controller
{
    public function index()
    {
        $patient = Auth::guard('patient')->user();

        $assignments = $patient->testAssignments()->with('test')->orderByDesc('created_at')->get();

        return view('danisan.panel', [
            'patient' => $patient,
            'bekleyenler' => $assignments->where('status', TestAssignment::STATUS_PENDING),
            'tamamlananlar' => $assignments->where('status', TestAssignment::STATUS_COMPLETED),
        ]);
    }

    public function showTest($id)
    {
        $patient = Auth::guard('patient')->user();
        $assignment = TestAssignment::with('test')
            ->where('patient_id', $patient->id)
            ->findOrFail($id);

        if ($assignment->isCompleted()) {
            return redirect('/danisan/panel')->with('error', 'Bu testi zaten tamamladınız.');
        }

        return view('danisan.test', [
            'assignment' => $assignment,
            'sorular' => $assignment->applicableQuestions(),
            'formAction' => "/danisan/test/{$assignment->id}",
        ]);
    }

    public function submitTest(Request $request, $id)
    {
        $patient = Auth::guard('patient')->user();
        $assignment = TestAssignment::with('test')
            ->where('patient_id', $patient->id)
            ->findOrFail($id);

        if ($assignment->isCompleted()) {
            return redirect('/danisan/panel')->with('error', 'Bu testi zaten tamamladınız.');
        }

        $request->validate(['cevap' => 'required|array']);
        $assignment->applyAnswers($request->input('cevap'));

        return redirect('/danisan/panel')->with('success', 'Test tamamlandı, teşekkür ederiz.');
    }
}
