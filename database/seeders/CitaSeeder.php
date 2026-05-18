<?php

namespace Database\Seeders;

use App\Models\Cita;
use App\Models\Cliente;
use App\Models\Doctor;
use App\Models\Horario;
use App\Models\Tratamiento;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CitaSeeder extends Seeder
{
    public function run(): void
    {
        $clients = Cliente::all();
        $tractaments = Tratamiento::all();
        $doctors = Doctor::all();

        // Per cada doctor, crear 3-5 cites en dies diferents
        foreach ($doctors as $doctor) {
            $horariosDisponibles = Horario::where('id_doctor', $doctor->id_doctor)
                ->where('disponible', true)
                ->where('fecha', '>=', now()->addHours(24)->toDateString())
                ->get();

            if ($horariosDisponibles->isEmpty()) {
                continue;
            }

            $numCites = min(rand(3, 5), $horariosDisponibles->count());

            for ($i = 0; $i < $numCites; $i++) {
                $horario = $horariosDisponibles->random();
                $cliente = $clients->random();
                $tractament = $tractaments->random();

                $iniciFranja = Carbon::parse($horario->hora_inicio);
                $fiFranja = Carbon::parse($horario->hora_fin);
                $durada = $tractament->duracion_minutos;

                // Buscar un slot lliure dins el horari
                $slot = $this->trobarSlotLliure($doctor->id_doctor, $horario->fecha, $iniciFranja, $fiFranja, $durada);

                if ($slot === null) {
                    continue;
                }

                Cita::create([
                    'id_cliente' => $cliente->id_cliente,
                    'id_doctor' => $doctor->id_doctor,
                    'id_tratamiento' => $tractament->id_tratamiento,
                    'id_admin' => null,
                    'fecha' => $horario->fecha,
                    'hora_inicio' => $slot->format('H:i:s'),
                    'hora_fin' => $slot->copy()->addMinutes($durada)->format('H:i:s'),
                    'estado' => 'reservada',
                    'tipo_reserva' => 'online',
                    'fecha_dato' => now(),
                    'fecha_carga' => now(),
                ]);

                // No usar el mateix horari per a més d'una cita
                $horariosDisponibles = $horariosDisponibles->reject(function ($h) use ($horario) {
                    return $h->id_horario === $horario->id_horario;
                });

                if ($horariosDisponibles->isEmpty()) {
                    break;
                }
            }
        }
    }

    private function trobarSlotLliure(int $idDoctor, string $fecha, Carbon $inici, Carbon $fi, int $duradaMinuts): ?Carbon
    {
        $citesExistents = Cita::where('id_doctor', $idDoctor)
            ->where('fecha', $fecha)
            ->whereIn('estado', ['reservada', 'pendiente_pago'])
            ->orderBy('hora_inicio')
            ->get(['hora_inicio', 'hora_fin']);

        $slot = $inici->copy();

        while ($slot->copy()->addMinutes($duradaMinuts)->lte($fi)) {
            $fiSlot = $slot->copy()->addMinutes($duradaMinuts);

            $solapa = $citesExistents->contains(function ($c) use ($slot, $fiSlot) {
                $cInici = Carbon::parse($c->hora_inicio);
                $cFi = Carbon::parse($c->hora_fin);
                return $slot->lt($cFi) && $fiSlot->gt($cInici);
            });

            if (!$solapa) {
                return $slot;
            }

            $slot->addMinutes(30);
        }

        return null;
    }
}
