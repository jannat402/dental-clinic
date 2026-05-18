<?php

namespace Database\Seeders;

use App\Models\Horario;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class HorarioSeeder extends Seeder
{
    public function run(): void
    {
        $doctores = Doctor::all();

        if ($doctores->isEmpty()) {
            $doctores = Doctor::factory(4)->create();
        }

        $avui = Carbon::today();
        $horariosPerDoctor = [
            ['hora_inicio' => '09:00', 'hora_fin' => '17:00'],
            ['hora_inicio' => '08:00', 'hora_fin' => '16:00'],
            ['hora_inicio' => '10:00', 'hora_fin' => '18:00'],
            ['hora_inicio' => '09:00', 'hora_fin' => '15:00'],
        ];

        // Dies especials: vacances (dia 3), tancament (dia 12)
        $fechaVac = $avui->copy()->addDays(3);
        $fechaTancament = $avui->copy()->addDays(12);

        foreach ($doctores as $index => $doctor) {
            $franja = $horariosPerDoctor[$index % count($horariosPerDoctor)];

            for ($dia = 1; $dia <= 14; $dia++) {
                $fecha = $avui->copy()->addDays($dia);

                if ($fecha->isWeekend()) {
                    continue;
                }

                $disponible = true;
                $motiu = null;
                $tipus = null;

                // Dia de vacances per a aquest doctor
                if ($fecha->eq($fechaVac)) {
                    $disponible = false;
                    $motiu = 'Vacaciones';
                    $tipus = 'vacaciones';
                }

                // Tancament del centre (tots els doctors)
                if ($fecha->eq($fechaTancament)) {
                    $disponible = false;
                    $motiu = 'Tancament del centre';
                    $tipus = 'tancament';
                }

                Horario::create([
                    'id_doctor' => $doctor->id_doctor,
                    'fecha' => $fecha->toDateString(),
                    'hora_inicio' => $franja['hora_inicio'] . ':00',
                    'hora_fin' => $franja['hora_fin'] . ':00',
                    'disponible' => $disponible,
                    'motivo_bloqueo' => $motiu,
                    'tipus_bloqueig' => $tipus,
                    'fecha_dato' => now(),
                    'fecha_carga' => now(),
                ]);
            }
        }
    }
}
