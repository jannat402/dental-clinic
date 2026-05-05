<?php

namespace Database\Seeders;

use App\Models\Cita;
use App\Models\Cliente;
use App\Models\Doctor;
use App\Models\Tratamiento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //Cita::factory()->count(200)->create();
        for ($i = 0; $i < 100; $i++){
        $doctor = Doctor::inRandomOrder()->first();
        $cliente = Cliente::inRandomOrder()->first();
        $tratamiento = Tratamiento::inRandomOrder()->first();
        do{
            $fecha = fake()->dateTimeBetween('now', '+2 days')->format('Y-m-d');
            $horaInicio = fake()->dateTimeBetween("$fecha 08:00", "$fecha 22:00");
            $duracion = Tratamiento::where('id_tratamiento', $tratamiento->id_tratamiento)->value('duracion_minutos');
            $horaFin = (clone $horaInicio)->modify('+' . $duracion . ' minutes');
        
        }while(!$this->sePuedeReservar($fecha, $horaInicio,$horaFin,$doctor));


        Cita::create ([
            'id_cliente' =>$cliente->id_cliente,
            'id_doctor' => $doctor->id_doctor,
            'id_tratamiento' =>$tratamiento->id_tratamiento,
            'id_admin'=>null,
            'hora_inicio'=> $horaInicio,
            'fecha' =>$fecha,
            'hora_fin' => $horaFin,
            'estado' => 'reservada',
            'tipo_Reserva'=>'presencial',
            'fecha_dato' => now(), 
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
        ]);
        }
    }
    private function sePuedeReservar($fecha, $horaInicio,$horaFin,$doctor): bool{
        //Comprobar que no hay otra cita con el mismo doctor, en la misma fecha y la misma hora de inicio y la misma hora final
        //miramos si hay alguna cita el mismo dia, que termine despues del inicio de la cita, y termine antes de acabar la nuestra
        $hora_inicio_formateada2=$horaInicio->format('H:i:s');
        $hora_fin_formateada2 = $horaFin->format('H:i:s');
        $query2 = Cita::where('fecha', $fecha)
        
                ->where('id_doctor', '=', $doctor->id)
                ->where(function($q) use ($hora_inicio_formateada2) {
                    $q->where('hora_inicio', '<', $hora_inicio_formateada2)
                    ->where('hora_fin', '>', $hora_inicio_formateada2);
                })
                ->orWhere(function($q) use ($hora_fin_formateada2) {
                    $q->where('hora_inicio', '<', $hora_fin_formateada2)
                    ->where('hora_fin', '>', $hora_fin_formateada2);
                });
            
    // 🔍 IMPRIMIR la consulta SQL completa

    
    // 🔍 IMPRIMIR los bindings (valores que reemplazan los ?)

    
    $hayOtraCita = $query2->exists();


        //Comprobar que para la fecha, hora inicio y hora fin, en horario sale como disponible y existe esa fecha
        //Comprobamos primero que haya la fecha
        /*
        $hayHorario = Horario::where('fecha', $fecha)->exists();
        
        $citaEstaEnHorario = Horario::where('fecha', $fecha)
            ->where('id_doctor', '=', $doctor->id)
            ->where('hora_inicio', '<=', $horaInicio->format('H:i:s'))
            ->where('hora_fin', '>=', $horaFin->format('H:i:s'))
            ->exists();
        
        $diaDisponible = Horario::where('fecha', $fecha)->where('id_doctor',$doctor->id)->value('disponible');
        */
        $sePuedeReservar = !$hayOtraCita /*&& $hayHorario && $diaDisponible && $citaEstaEnHorario*/;

        return $sePuedeReservar;
    }






    }

