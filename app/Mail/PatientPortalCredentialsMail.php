<?php

namespace App\Mail;

use App\Models\Patient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PatientPortalCredentialsMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Patient $patient;
    public string $plainPassword;

    public function __construct(Patient $patient, string $plainPassword)
    {
        $this->patient = $patient;
        $this->plainPassword = $plainPassword;
    }

    public function build()
    {
        return $this->subject('Danışan Portalı Giriş Bilgileriniz')
            ->view('emails.patient-portal-credentials')
            ->with([
                'patient' => $this->patient,
                'plainPassword' => $this->plainPassword,
                'loginUrl' => url('/danisan/giris'),
            ]);
    }
}
