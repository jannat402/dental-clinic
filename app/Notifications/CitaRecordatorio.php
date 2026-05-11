<?php

namespace App\Notifications;

use App\Models\Cita;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CitaRecordatorio extends Notification
{
    use Queueable;

    public Cita $cita;

    public function __construct(Cita $cita)
    {
        $this->cita = $cita;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Recordatori: tens una cita demà - Dental Clinic')
            ->greeting('Hola ' . $this->cita->cliente->nombre)
            ->line('Et recordem que tens una cita demà:')
            ->line('Data: ' . $this->cita->fecha)
            ->line('Hora: ' . $this->cita->hora_inicio)
            ->line('Doctor: ' . $this->cita->doctor->nombre . ' ' . $this->cita->doctor->apellidos)
            ->line('Tractament: ' . $this->cita->tratamiento->nombre_tratamiento)
            ->line('Si no pots assistir, recorda cancel·lar amb 48h d\'antelació.')
            ->salutation('Dental Clinic');
    }
}
