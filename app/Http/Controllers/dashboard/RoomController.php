<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RoomController extends Controller
{
    public function index()
    {
        $data = Room::orderBy('name')->get();
        return view('dashboard.odalar.index', ['data' => $data]);
    }

    public function edit($id)
    {
        $data = Room::find($id);
        return view('dashboard.odalar.add', ['data' => $data]);
    }

    public function add()
    {
        return view('dashboard.odalar.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        if ($request->id) {
            $item = Room::find($request->id);
        } else {
            $item = new Room();
        }

        $item->name = $request->name;
        $item->is_active = $request->boolean('is_active');
        $item->save();

        return redirect('/admin/odalar')->with('success', 'Kayıt Başarıyla Kaydedildi.');
    }

    public function del($id)
    {
        Room::destroy($id);
        return redirect('/admin/odalar')->with('success', 'Kayıt Başarıyla Silindi.');
    }

    /**
     * Oda doluluk durumu: seçilen güne ait, oda ataması yapılmış
     * (onaylanmış/tamamlanmış) randevuları oda bazında listeler.
     * Amaç: aynı oda/saat için karışıklık olmadan hızlıca göz atabilmek.
     */
    public function durum(Request $request)
    {
        $tarih = $request->query('tarih') ?: now()->toDateString();
        $date = Carbon::parse($tarih)->startOfDay();

        $rooms = Room::where('is_active', true)->orderBy('name')->get();

        $appointments = Appointment::with('patient', 'room')
            ->whereDate('starts_at', $date->toDateString())
            ->whereIn('status', [Appointment::STATUS_CONFIRMED, Appointment::STATUS_COMPLETED])
            ->orderBy('starts_at')
            ->get()
            ->groupBy('room_id');

        return view('dashboard.odalar.durum', [
            'rooms' => $rooms,
            'appointments' => $appointments,
            'tarih' => $date->toDateString(),
        ]);
    }
}
