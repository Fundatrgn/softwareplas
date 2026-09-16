<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q'));

        $patients = Patient::withCount('appointments')
            ->when($q !== '', function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")->orWhere('phone', 'like', "%{$q}%");
            })
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        return view('dashboard.danisanlar.index', ['data' => $patients, 'q' => $q]);
    }

    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        $appointments = $patient->appointments()
            ->with('service', 'psychologist')
            ->orderByDesc('starts_at')
            ->get();

        return view('dashboard.danisanlar.show', ['patient' => $patient, 'appointments' => $appointments]);
    }

    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('dashboard.danisanlar.add', ['data' => $patient]);
    }

    public function add()
    {
        return view('dashboard.danisanlar.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:32',
            'email' => 'nullable|email|max:255',
        ]);

        if ($request->id) {
            $patient = Patient::findOrFail($request->id);
        } else {
            $patient = new Patient();
        }

        $patient->name = $request->name;
        $patient->phone = $request->phone;
        $patient->email = $request->email;
        $patient->birth_date = $request->birth_date ?: null;
        $patient->gender = $request->gender;
        $patient->notes = $request->notes;
        $patient->save();

        return redirect('/admin/danisanlar/' . $patient->id)->with('success', 'Danışan bilgileri kaydedildi.');
    }
}
