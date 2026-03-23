<?php

namespace Database\Factories;

use App\Models\Cita;
use App\Models\Cliente;
use App\Models\Doctor;
use App\Models\Horario;
use App\Models\Tratamiento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cita>
 */
class CitaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $doctor = Doctor::inRandomOrder()->first();
        $cliente = Cliente::inRandomOrder()->first();
        $tratamiento = Tratamiento::inRandomOrder()->first();
        do{
            $fecha = $this->faker->dateTimeBetween('now', '+20 days')->format('Y-m-d');
            $horaInicio = $this->faker->dateTimeBetween("$fecha 08:00", "$fecha 22:00");
            $duracion = Tratamiento::where('id_tratamiento', $tratamiento->id_tratamiento)->value('duracion_minutos');
            $horaFin = (clone $horaInicio)->modify('+' . $duracion . ' minutes');
        }while($this->sePuedeReservar($fecha, $horaInicio,$horaFin));


        return [
            'id_cliente' =>$cliente,
            'id_doctor' => $doctor,
            'id_tratamiento' =>$tratamiento,
            'id_admin'=>null,
            'hora_inicio'=> $horaInicio,
            'fecha' =>$fecha,
            'hora_fin' => $horaFin,
            'estado' => 'reservada',
            'tipo_Reserva'=>'presencial',
            'fecha_dato' => $this->faker->optional()->date(), 
            'fecha_carga' => now(),

            /**
             * 
        'id_cliente',
        'id_doctor',
        'id_tratamiento',
        'id_admin',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'estado',
        'tipo_reserva',
        'fecha_dato',
        'fecha_carga'
             */
        ];
    }
    private function sePuedeReservar($fecha, $horaInicio,$horaFin): bool{
        //Comprobar que no hay otra cita con el mismo doctor, en la misma fecha y la misma hora de inicio y la misma hora final
        //miramos si hay alguna cita el mismo dia, que termine despues del inicio de la cita, y termine antes de acabar la nuestra
        $hayOtraCita = Cita::where('fecha', $fecha)
            ->where('hora_inicio', '<', $horaFin->format('H:i:s'))
            ->where('hora_fin', '>', $horaInicio->format('H:i:s'))
            ->exists();
        
        //Comprobar que para la fecha, hora inicio y hora fin, en horario sale como disponible y existe esa fecha
        //Comprobamos primero que haya la fecha
        $hayHorario = Horario::where('fecha', $fecha)->exists();
        
        $citaEstaEnHorario = Horario::where('fecha', $fecha)
            ->where('hora_inicio', '<=', $horaInicio->format('H:i:s'))
            ->where('hora_fin', '>=', $horaFin->format('H:i:s'))
            ->exists();
        
        $diaDisponible = Horario::where('fecha', $fecha)->value('disponible');
        
        $sePuedeReservar = $hayOtraCita && $hayHorario && $diaDisponible && $citaEstaEnHorario;
        return $sePuedeReservar;
    }
}
