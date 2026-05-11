<?php

namespace App\Console\Commands;

use App\Models\Cita;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendReminderNotifications extends Command
{
    protected $signature = 'notifications:send-reminders';
    protected $description = 'Envia recordatoris de cites per a demà';

    public function handle(NotificationService $notifications): void
    {
        $demà = Carbon::now()->addDay()->toDateString();

        $cites = Cita::where('fecha', $demà)
            ->where('estado', 'reservada')
            ->with(['cliente', 'doctor', 'tratamiento'])
            ->get();

        $count = 0;
        foreach ($cites as $cita) {
            $notifications->enviarRecordatori($cita);
            $count++;
        }

        $this->info("S'han enviat {$count} recordatoris.");
    }
}
