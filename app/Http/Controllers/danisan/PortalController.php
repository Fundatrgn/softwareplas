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
        $assignment = TestAssignment::with('test.questions')
            ->where('patient_id', $patient->id)
            ->findOrFail($id);

        if ($assignment->isCompleted()) {
            return redirect('/danisan/panel')->with('error', 'Bu testi zaten tamamladınız.');
        }

        return view('danisan.test', ['assignment' => $assignment]);
    }

    public function submitTest(Request $request, $id)
    {
        $patient = Auth::guard('patient')->user();
        $assignment = TestAssignment::with('test.questions')
            ->where('patient_id', $patient->id)
            ->findOrFail($id);

        if ($assignment->isCompleted()) {
            return redirect('/danisan/panel')->with('error', 'Bu testi zaten tamamladınız.');
        }

        $questionIds = $assignment->test->questions->pluck('id');
        $rules = [];
        foreach ($questionIds as $qid) {
            $rules["cevap.$qid"] = 'required|integer|min:0|max:3';
        }
        $request->validate($rules);

        $answers = [];
        $toplam = 0;
        foreach ($questionIds as $qid) {
            $deger = (int) $request->input("cevap.$qid");
            $answers[$qid] = $deger;
            $toplam += $deger;
        }

        $assignment->answers = $answers;
        $assignment->score = $toplam;
        $assignment->status = TestAssignment::STATUS_COMPLETED;
        $assignment->completed_at = now();
        $assignment->save();

        return redirect('/danisan/panel')->with('success', 'Test tamamlandı, teşekkür ederiz.');
    }
}
