<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class AppointmentNotificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Appointment $appointment;
    public string $heading;
    public string $intro;
    public bool $includeCancelLink;

    public function __construct(Appointment $appointment, string $heading, string $intro, bool $includeCancelLink = false)
    {
        $this->appointment = $appointment;
        $this->heading = $heading;
        $this->intro = $intro;
        $this->includeCancelLink = $includeCancelLink;
    }

    public function build()
    {
        $cancelUrl = null;

        if ($this->includeCancelLink && $this->appointment->starts_at->isFuture()) {
            $cancelUrl = URL::signedRoute('randevu.iptal', ['id' => $this->appointment->id]);
        }

        return $this->subject($this->heading)
            ->view('emails.appointment')
            ->with([
                'appointment' => $this->appointment,
                'heading' => $this->heading,
                'intro' => $this->intro,
                'cancelUrl' => $cancelUrl,
            ]);
    }
}
