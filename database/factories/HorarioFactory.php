<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Horario>
 */
class HorarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generar hora de inicio aleatoria 
        $horaInicio = $this->faker->time('H:i', '09:00'); 
        // hasta las 17:00 
        // Hora fin siempre mayor que inicio 
        //$horaFin = date('H:i', strtotime($horaInicio . ' + ' . rand(1, 3) . ' hours')); 
        $doctor = Doctor::inRandomOrder()->first() ?? Doctor::factory()->create();
        $horaFin = date('H:i', time('H:i','14:00'));
        $fecha = $this->faker->dateTimeBetween('now', '+60 days')->format('Y-m-d');
        $tipoHorario = $doctor->id_doctor % 3;
        if ($tipoHorario === 0) { 
            // Doctor madrugador 
            $horaInicio = $this->faker->dateTimeBetween("$fecha 08:00", "$fecha 12:00"); 
        } elseif ($tipoHorario === 1) { 
            // Doctor estándar 
            $horaInicio = $this->faker->dateTimeBetween("$fecha 09:00", "$fecha 13:00"); 
        } else { 
            // Doctor que entra tarde 
            $horaInicio = $this->faker->dateTimeBetween("$fecha 10:00", "$fecha 16:00"); 
        }
        $horaFin = (clone $horaInicio)->modify('+' . rand(1, 3) . ' hours');

        return [ 
            'id_doctor' => Doctor::inRandomOrder()->first()->id_doctor ?? Doctor::factory(), 
            'fecha' => $fecha, 
            'hora_inicio' => $horaInicio, 
            'hora_fin' => $horaFin, 
            'disponible' => $this->faker->boolean(80), 
        // 80% disponible 
            'motivo_bloqueo' => $this->faker->optional()->sentence(), 
            'fecha_dato' => $this->faker->optional()->date(), 
            'fecha_carga' => now(), ];
    }
}
