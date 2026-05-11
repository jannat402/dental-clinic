<?php

namespace App\Console\Commands;

use App\Models\Horario;
use App\Services\AppointmentService;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ReallocateAppointments extends Command
{
    protected $signature = 'appointments:reallocate';
    protected $description = 'Reubica cites afectades per tancament de franges del dia següent';

    public function handle(AppointmentService $appointmentService, NotificationService $notificationService): void
    {
        $demà = Carbon::now()->addDay()->toDateString();

        $horarisBloquejats = Horario::where('fecha', $demà)
            ->where('disponible', false)
            ->get();

        $totalReubicades = 0;
        foreach ($horarisBloquejats as $horari) {
            $cites = $appointmentService->reubicarCitesAfectades($horari->id_doctor, $demà);
            foreach ($cites as $cita) {
                $notificationService->enviarModificacio($cita);
                $totalReubicades++;
            }
        }

        $this->info("S'han reubicat {$totalReubicades} cites.");
    }
}
