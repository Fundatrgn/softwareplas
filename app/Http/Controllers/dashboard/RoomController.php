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
     * Oda doluluk durumu: her aktif oda için seçilen aya ait bir takvim
     * gösterir; her günün altında o gün/o odada dolu olan saat aralıkları
     * listelenir. Amaç: yönetici ve psikolog randevu oluştururken/onaylarken
     * hangi odanın hangi gün/saatte dolu olduğunu tek bakışta görsün —
     * sistem zaten aynı oda+saat çakışmasına izin vermiyor (bkz.
     * AppointmentController), bu ekran sadece görsel bir taslak/rehber.
     */
    public function durum(Request $request)
    {
        $ay = $request->query('ay') ?: now()->format('Y-m');
        $start = Carbon::parse($ay . '-01')->startOfMonth();
        $end = $start->copy()->endOfMonth();

        $rooms = Room::where('is_active', true)->orderBy('name')->get();

        $appointments = Appointment::with('patient')
            ->whereBetween('starts_at', [$start->copy()->startOfDay(), $end->copy()->endOfDay()])
            ->whereIn('status', [Appointment::STATUS_CONFIRMED, Appointment::STATUS_COMPLETED])
            ->orderBy('starts_at')
            ->get()
            ->groupBy(function ($a) {
                return $a->room_id . '_' . $a->starts_at->format('Y-m-d');
            });

        $calendarStart = $start->copy()->startOfWeek(Carbon::MONDAY);
        $calendarEnd = $end->copy()->endOfWeek(Carbon::MONDAY);
        $days = [];
        $cursor = $calendarStart->copy();
        while ($cursor->lte($calendarEnd)) {
            $days[] = $cursor->copy();
            $cursor->addDay();
        }
        $weeks = array_chunk($days, 7);

        return view('dashboard.odalar.durum', [
            'rooms' => $rooms,
            'appointmentsByRoomDay' => $appointments,
            'weeks' => $weeks,
            'ay' => $start->format('Y-m'),
            'ayBaslik' => $start->translatedFormat('F Y'),
            'oncekiAy' => $start->copy()->subMonth()->format('Y-m'),
            'sonrakiAy' => $start->copy()->addMonth()->format('Y-m'),
            'buAy' => $start->format('Y-m'),
        ]);
    }
}
