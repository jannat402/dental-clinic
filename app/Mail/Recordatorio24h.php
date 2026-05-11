<?php

namespace App\Mail;

use App\Models\Cita;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Recordatorio24h extends Mailable
{
    use Queueable, SerializesModels;

    public Cita $cita;

    public function __construct(Cita $cita)
    {
        $this->cita = $cita;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Recordatori: tens una cita demà - Dental Clinic',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.recordatorio-24h',
        );
    }
}
