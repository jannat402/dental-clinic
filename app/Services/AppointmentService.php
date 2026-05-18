<?php

namespace App\Services;

use App\Models\Cita;
use App\Models\Horario;
use App\Models\Tratamiento;
use Carbon\Carbon;

class AppointmentService
{
    // Validar que la cita se pide con >=24h de antelación
    public function validarAntelacio(string $fecha, string $horaInicio = '00:00:00'): bool
    {
        return Carbon::parse($fecha . ' ' . $horaInicio)->gte(Carbon::now()->addHours(24));
    }

    // Validar que se puede modificar/cancelar (>=48h antes)
    public function validarModificacio(string $fecha, string $horaInicio = '00:00:00'): bool
    {
        return Carbon::parse($fecha . ' ' . $horaInicio)->gte(Carbon::now()->addHours(48));
    }

    // Bloqueo temporal de 10 minutos con cache
    public function bloquejarTemporalment(int $idDoctor, string $fecha, string $horaInicio, string $horaFin): string
    {
        $clau = "reserva_temp:{$idDoctor}:{$fecha}:{$horaInicio}";
        $bloquejat = cache()->lock($clau, 600); // 600s = 10min

        if (!$bloquejat->get()) {
            throw new \RuntimeException('Aquesta franja ja està reservada temporalment per un altre usuari.');
        }

        return $clau;
    }

    // Liberar bloqueo temporal
    public function alliberarBloqueig(string $clau): void
    {
        cache()->forget($clau);
    }

    // Buscar franjas alternativas libres para un doctor en una fecha
    public function obtenirAlternatives(int $idDoctor, string $fecha, string $horaInicio, int $duradaMinuts): array
    {
        $horario = Horario::where('id_doctor', $idDoctor)
            ->where('fecha', $fecha)
            ->where('disponible', true)
            ->first();

        if (!$horario) return [];

        $citesExistents = Cita::where('id_doctor', $idDoctor)
            ->where('fecha', $fecha)
            ->whereIn('estado', ['reservada', 'pendiente_pago'])
            ->get();

        $franjaInici = Carbon::parse($horario->hora_inicio);
        $franjaFi = Carbon::parse($horario->hora_fin);
        $alternatives = [];

        while ($franjaInici->copy()->addMinutes($duradaMinuts)->lte($franjaFi)) {
            $candidataFi = $franjaInici->copy()->addMinutes($duradaMinuts);
            $conflicte = $citesExistents->contains(function ($cita) use ($franjaInici, $candidataFi) {
                $citaInici = Carbon::parse($cita->hora_inicio);
                $citaFi = Carbon::parse($cita->hora_fin);
                return $franjaInici->lt($citaFi) && $candidataFi->gt($citaInici);
            });

            $horaCandidata = $franjaInici->format('H:i');
            if ($horaCandidata !== $horaInicio && !$conflicte) {
                $alternatives[] = $horaCandidata;
            }

            $franjaInici->addMinutes($duradaMinuts);
        }

        return $alternatives;
    }

    // Reubicar citas cuando se cierra una franja
    public function reubicarCitesAfectades(int $idDoctor, string $fecha): array
    {
        $cites = Cita::where('id_doctor', $idDoctor)
            ->where('fecha', $fecha)
            ->whereIn('estado', ['reservada', 'pendiente_pago'])
            ->get();

        $reubicades = [];
        foreach ($cites as $cita) {
            $tractament = Tratamiento::find($cita->id_tratamiento);
            $alternatives = $this->obtenirAlternatives($idDoctor, $fecha, $cita->hora_inicio, $tractament?->duracion_minutos ?? 30);

            if (!empty($alternatives)) {
                $novaHora = $alternatives[0];
                $novaHoraFi = Carbon::parse($novaHora)->addMinutes($tractament?->duracion_minutos ?? 30)->format('H:i:s');
                $cita->update(['hora_inicio' => $novaHora, 'hora_fin' => $novaHoraFi]);
                $reubicades[] = $cita;
            }
        }

        return $reubicades;
    }
}
