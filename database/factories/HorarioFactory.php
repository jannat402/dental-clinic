<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Horario;
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
    protected static $combinacionesUsadas = [];


    public function definition(): array
    {
    // Combinar existentes de BD con los usados en esta ejecución
        $combinacionesProhibidas = array_merge(
            Horario::all(['id_doctor', 'fecha'])
                ->map(fn($item) => $item->id_doctor . '-' . $item->fecha)
                ->toArray(),
            static::$combinacionesUsadas
        );
        do{
            $doctor = Doctor::inRandomOrder()->first() ?? Doctor::factory()->create();
            $fecha = $this->faker->dateTimeBetween('now', '+20 days')->format('Y-m-d');
            $combinacion = $doctor->id_doctor . '-' . $fecha;

        }while(in_array($combinacion, $combinacionesProhibidas) );
        static::$combinacionesUsadas[] = $combinacion;
        // Generar hora de inicio aleatoria 
        $horaInicio = $this->faker->time('H:i', '09:00'); 
        // hasta las 17:00 
        // Hora fin siempre mayor que inicio 
        //$horaFin = date('H:i', strtotime($horaInicio . ' + ' . rand(1, 3) . ' hours'));
        //$horaFin = date('H:i', time('H:i','14:00'));
        $tipoHorario = $doctor->id_doctor % 3;
        if ($tipoHorario === 0) { 
            // Doctor madrugador 
            $horaInicio = $this->faker->dateTimeBetween("$fecha 08:00", "$fecha 08:00"); 
        } elseif ($tipoHorario === 1) { 
            // Doctor estándar 
            $horaInicio = $this->faker->dateTimeBetween("$fecha 09:00", "$fecha 09:00"); 
        } else { 
            // Doctor que entra tarde 
            $horaInicio = $this->faker->dateTimeBetween("$fecha 10:00", "$fecha 10:00"); 
        }
        $horaFin = (clone $horaInicio)->modify('+' . rand(1, 3) . ' hours');

        return [ 
            'id_doctor' => $doctor,
            'fecha' => $fecha, 
            'hora_inicio' => $horaInicio, 
            'hora_fin' => $horaFin, 
            'disponible' => $this->faker->boolean(80), 
        // 80% disponible 
            'motivo_bloqueo' => $this->faker->optional()->sentence(), 
            'fecha_dato' => $this->faker->optional()->date(), 
            'fecha_carga' => now(), ];
            //Commit tonto
            //Commit tonto 2
    }




        public static function resetCombinaciones()
    {
        static::$combinacionesUsadas = [];
    }
}
