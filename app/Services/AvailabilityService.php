<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Setting;
use Illuminate\Support\Carbon;

/**
 * Randevu müsaitlik hesaplamalarının tek merkezi. Hem halka açık
 * randevu sayfası (resources/views/general/randevu.blade.php + AJAX),
 * hem de admin CRM takvimi (dashboard/randevular) aynı mantığı kullanır
 * ki "dolu saat" tanımı her yerde tutarlı olsun.
 */
class AvailabilityService
{
    protected Setting $settings;

    const DAY_KEYS = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];

    const DEFAULT_WORKING_HOURS = [
        'mon' => ['start' => '09:00', 'end' => '18:00', 'break_start' => '12:00', 'break_end' => '13:00'],
        'tue' => ['start' => '09:00', 'end' => '18:00', 'break_start' => '12:00', 'break_end' => '13:00'],
        'wed' => ['start' => '09:00', 'end' => '18:00', 'break_start' => '12:00', 'break_end' => '13:00'],
        'thu' => ['start' => '09:00', 'end' => '18:00', 'break_start' => '12:00', 'break_end' => '13:00'],
        'fri' => ['start' => '09:00', 'end' => '18:00', 'break_start' => '12:00', 'break_end' => '13:00'],
        'sat' => null,
        'sun' => null,
    ];

    public function __construct(?Setting $settings = null)
    {
        $this->settings = $settings ?? Setting::first() ?? new Setting();
    }

    public function workingHours(): array
    {
        $stored = $this->settings->working_hours ?? null;

        if (empty($stored)) {
            return self::DEFAULT_WORKING_HOURS;
        }

        return array_merge(self::DEFAULT_WORKING_HOURS, $stored);
    }

    public function closedDates(): array
    {
        return $this->settings->closed_dates ?? [];
    }

    public function slotDuration(): int
    {
        return (int) ($this->settings->appointment_duration_minutes ?? 50);
    }

    public function dayConfig(Carbon $date): ?array
    {
        $key = self::DAY_KEYS[$date->dayOfWeek];
        $hours = $this->workingHours();

        if (in_array($date->toDateString(), $this->closedDates(), true)) {
            return null;
        }

        return $hours[$key] ?? null;
    }

    public function isClosedDay(Carbon $date): bool
    {
        return $this->dayConfig($date) === null;
    }

    /**
     * Bir günün tüm slot başlangıç saatlerini (öğle arası hariç) döner.
     * @return string[] "H:i" formatında
     */
    public function slotsForDate(Carbon $date): array
    {
        $config = $this->dayConfig($date);
        if (! $config) {
            return [];
        }

        $duration = $this->slotDuration();
        $slots = [];

        $cursor = Carbon::parse($date->toDateString() . ' ' . $config['start']);
        $end = Carbon::parse($date->toDateString() . ' ' . $config['end']);

        $breakStart = ! empty($config['break_start']) ? Carbon::parse($date->toDateString() . ' ' . $config['break_start']) : null;
        $breakEnd = ! empty($config['break_end']) ? Carbon::parse($date->toDateString() . ' ' . $config['break_end']) : null;

        while ($cursor->copy()->addMinutes($duration)->lte($end)) {
            $slotEnd = $cursor->copy()->addMinutes($duration);

            $overlapsBreak = $breakStart && $breakEnd
                && $cursor->lt($breakEnd) && $slotEnd->gt($breakStart);

            if (! $overlapsBreak) {
                $slots[] = $cursor->format('H:i');
            }

            $cursor->addMinutes($duration);
        }

        return $slots;
    }

    /**
     * @return string[] O gün için dolu (alınmış) slot başlangıç saatleri
     */
    public function bookedSlotsForDate(Carbon $date, ?int $excludeAppointmentId = null): array
    {
        $query = Appointment::onDate($date->toDateString())->blocking();

        if ($excludeAppointmentId) {
            $query->where('id', '!=', $excludeAppointmentId);
        }

        return $query->get()->map(fn ($a) => $a->starts_at->format('H:i'))->all();
    }

    /**
     * @return array{date: string, closed: bool, full: bool, past: bool, slots: array<array{time:string, available:bool}>}
     */
    public function dayAvailability(Carbon $date): array
    {
        $isPast = $date->isBefore(Carbon::today());
        $closed = $this->isClosedDay($date);
        $allSlots = $closed ? [] : $this->slotsForDate($date);
        $booked = $closed ? [] : $this->bookedSlotsForDate($date);

        $now = Carbon::now();
        $slots = array_map(function ($time) use ($booked, $date, $now) {
            $slotDateTime = Carbon::parse($date->toDateString() . ' ' . $time);
            $isPastSlot = $slotDateTime->lt($now);

            return [
                'time' => $time,
                'available' => ! in_array($time, $booked, true) && ! $isPastSlot,
            ];
        }, $allSlots);

        $availableCount = count(array_filter($slots, fn ($s) => $s['available']));

        return [
            'date' => $date->toDateString(),
            'closed' => $closed,
            'past' => $isPast,
            'full' => ! $closed && ! $isPast && count($allSlots) > 0 && $availableCount === 0,
            'slots' => $slots,
        ];
    }

    public function isSlotAvailable(Carbon $startsAt, ?int $excludeAppointmentId = null): bool
    {
        if ($this->isClosedDay($startsAt)) {
            return false;
        }

        if (! in_array($startsAt->format('H:i'), $this->slotsForDate($startsAt), true)) {
            return false;
        }

        return ! in_array($startsAt->format('H:i'), $this->bookedSlotsForDate($startsAt, $excludeAppointmentId), true);
    }
}
