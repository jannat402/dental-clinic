<?php

namespace Database\Seeders;

use App\Models\Cita;
use App\Models\Cliente;
use App\Models\Doctor;
use App\Models\Tratamiento;
use Illuminate\Database\Seeder;

class CitaSeeder extends Seeder
{
    public function run(): void
    {
        // ✔️ Generamos 200 citas
        for ($i = 0; $i < 200; $i++) {

            $doctor = Doctor::inRandomOrder()->first();
            $cliente = Cliente::inRandomOrder()->first();
            $tratamiento = Tratamiento::inRandomOrder()->first();

            // ✔️ GENERACIÓN DE FECHA Y HORAS
            do {
                $fecha = fake()->dateTimeBetween('now', '+2 days')->format('Y-m-d');

                $horaInicio = fake()->dateTimeBetween("$fecha 08:00", "$fecha 22:00");
                $duracion = $tratamiento->duracion_minutos;
                $horaFin = (clone $horaInicio)->modify("+$duracion minutes");

            // ❌ ANTES: usabas una función que NO detectaba todos los solapamientos
            // ✔️ AHORA: usamos la fórmula universal correcta
            } while (!$this->sePuedeReservar($fecha, $horaInicio, $horaFin, $doctor));

            // ❌ ANTES: estabas guardando objetos enteros
            // ✔️ AHORA: guardamos solo IDs
            Cita::create([
                'id_cliente'      => $cliente->id_cliente,
                'id_doctor'       => $doctor->id_doctor,
                'id_tratamiento'  => $tratamiento->id_tratamiento,
                'id_admin'        => null,

                // ✔️ Guardamos horas como strings válidos
                'fecha'           => $fecha,
                'hora_inicio'     => $horaInicio->format('H:i:s'),
                'hora_fin'        => $horaFin->format('H:i:s'),

                'estado'          => 'reservada',
                'tipo_reserva'    => 'presencial',
                'fecha_dato'      => now(),
                'fecha_carga'     => now(),
            ]);
        }
    }

    private function sePuedeReservar($fecha, $horaInicio, $horaFin, $doctor): bool
    {
        // ❌ ANTES: comparación incorrecta y orWhere sin agrupar
        // ✔️ AHORA: fórmula universal de solapamiento
        //
        // Dos intervalos se solapan si:
        // inicio_existente < fin_nueva  AND  fin_existente > inicio_nueva

        $haySolape = Cita::where('id_doctor', $doctor->id_doctor)
            ->where('fecha', $fecha)
            ->where(function ($q) use ($horaInicio, $horaFin) {
                $q->where('hora_inicio', '<', $horaFin->format('H:i:s'))
                  ->where('hora_fin', '>', $horaInicio->format('H:i:s'));
            })
            ->exists();

        return !$haySolape;
    }
}
