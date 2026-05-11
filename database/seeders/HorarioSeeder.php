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
        // Crear horarios amb tipus_bloqueig per a doctors existents
        $doctores = Doctor::all();

        if ($doctores->isEmpty()) {
            Doctor::factory(3)->create();
            $doctores = Doctor::all();
        }

        // Horari disponible per cada doctor (avui + 1 dia)
        $avui = Carbon::today();
        foreach ($doctores as $doctor) {
            Horario::create([
                'id_doctor' => $doctor->id_doctor,
                'fecha' => $avui->copy()->addDay()->toDateString(),
                'hora_inicio' => '09:00:00',
                'hora_fin' => '17:00:00',
                'disponible' => true,
                'motivo_bloqueo' => null,
                'tipus_bloqueig' => null,
                'fecha_dato' => now(),
                'fecha_carga' => now(),
            ]);

            // Bloqueig per vacances d'aquí 5 dies
            Horario::create([
                'id_doctor' => $doctor->id_doctor,
                'fecha' => $avui->copy()->addDays(5)->toDateString(),
                'hora_inicio' => '08:00:00',
                'hora_fin' => '20:00:00',
                'disponible' => false,
                'motivo_bloqueo' => 'Doctor de vacances',
                'tipus_bloqueig' => 'vacaciones',
                'fecha_dato' => now(),
                'fecha_carga' => now(),
            ]);
        }

        // Bloqueig per tancament del centre d'aquí 10 dies
        Horario::create([
            'id_doctor' => $doctores->first()->id_doctor,
            'fecha' => $avui->copy()->addDays(10)->toDateString(),
            'hora_inicio' => '09:00:00',
            'hora_fin' => '15:00:00',
            'disponible' => false,
            'motivo_bloqueo' => 'Tancament per inventari',
            'tipus_bloqueig' => 'tancament',
            'fecha_dato' => now(),
            'fecha_carga' => now(),
        ]);

        // Bloqueig per manteniment d'aquí 3 dies
        Horario::create([
            'id_doctor' => $doctores->last()->id_doctor,
            'fecha' => $avui->copy()->addDays(3)->toDateString(),
            'hora_inicio' => '10:00:00',
            'hora_fin' => '12:00:00',
            'disponible' => false,
            'motivo_bloqueo' => null,
            'tipus_bloqueig' => 'mantenimiento',
            'fecha_dato' => now(),
            'fecha_carga' => now(),
        ]);

        // 20 horaris aleatoris addicionals via factory
        Horario::factory(20)->create();
    }
}
