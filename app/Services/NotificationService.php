<?php

namespace App\Services;

use App\Models\Cita;
use App\Mail\CitaConfirmada;
use App\Mail\CitaModificada;
use App\Mail\CitaCancelada;
use App\Mail\Recordatorio24h;
use App\Notifications\CitaRecordatorio;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    public function enviarConfirmacio(Cita $cita): void
    {
        try {
            Mail::to($cita->cliente->email)->send(new CitaConfirmada($cita));
        } catch (\Exception $e) {
            Log::error("Error enviant confirmació cita {$cita->id_cita}: {$e->getMessage()}");
        }
    }

    public function enviarModificacio(Cita $cita): void
    {
        try {
            Mail::to($cita->cliente->email)->send(new CitaModificada($cita));
        } catch (\Exception $e) {
            Log::error("Error enviant modificació cita {$cita->id_cita}: {$e->getMessage()}");
        }
    }

    public function enviarCancelacio(Cita $cita): void
    {
        try {
            Mail::to($cita->cliente->email)->send(new CitaCancelada($cita));
        } catch (\Exception $e) {
            Log::error("Error enviant cancel·lació cita {$cita->id_cita}: {$e->getMessage()}");
        }
    }

    public function enviarRecordatori(Cita $cita): void
    {
        try {
            Mail::to($cita->cliente->email)->send(new Recordatorio24h($cita));
        } catch (\Exception $e) {
            Log::error("Error enviant recordatori cita {$cita->id_cita}: {$e->getMessage()}");
        }
    }
}
