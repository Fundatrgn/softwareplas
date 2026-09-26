<?php

namespace App\Http\Controllers\danisan;

use App\Http\Controllers\Controller;
use App\Models\TestAssignment;
use Illuminate\Http\Request;

/**
 * Yüz yüze görüşmede kullanılmak üzere: danışan portalına giriş
 * yapmadan, sadece imzalı (signed) bir bağlantıyla TEK bir test
 * atamasının doldurulmasını sağlar. Psikolog, admin panelinden bu
 * bağlantıyı alıp kendi ekranında danışana açabilir.
 */
class GuestTestController extends Controller
{
    public function handle(Request $request, $assignmentId)
    {
        $assignment = TestAssignment::with('test')->findOrFail($assignmentId);

        if ($assignment->isCompleted()) {
            return view('danisan.test-misafir-tamamlandi', ['assignment' => $assignment]);
        }

        if ($request->isMethod('post')) {
            $request->validate(['cevap' => 'required|array']);
            $assignment->applyAnswers($request->input('cevap'));

            return view('danisan.test-misafir-tamamlandi', ['assignment' => $assignment]);
        }

        return view('danisan.test', [
            'assignment' => $assignment,
            'sorular' => $assignment->applicableQuestions(),
            'formAction' => $request->fullUrl(),
        ]);
    }
}
