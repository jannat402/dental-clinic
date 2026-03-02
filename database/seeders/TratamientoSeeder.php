<?php

namespace Database\Seeders;

use App\Models\Tratamiento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TratamientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            Tratamiento::insert([ [ 'nombre_tratamiento' => 'Limpieza dental', 
                    'duracion_minutos' => 30, 
                    'precio' => 45.00, 
                    'fecha_dato' => '2024-01-10', 
                    'fecha_carga' => now(), 
                    'descripcion' => 'Limpieza básica para eliminar placa y sarro.' 
                ], 
                [ 
                    'nombre_tratamiento' => 'Ortodoncia revisión', 
                    'duracion_minutos' => 20, 
                    'precio' => 30.00, 
                    'fecha_dato' => '2024-02-01', 
                    'fecha_carga' => now(), 'descripcion' => 
                    'Revisión mensual del tratamiento de ortodoncia.' 
                ], 
                [ 
                    'nombre_tratamiento' => 'Empaste dental', 
                    'duracion_minutos' => 45, 
                    'precio' => 60.00, 
                    'fecha_dato' => '2024-03-15', 
                    'fecha_carga' => now(), 
                    'descripcion' => 'Empaste para caries pequeñas o medianas.' 
                ],
                [ 
                    'nombre_tratamiento' => 'Blanqueamiento dental', 
                    'duracion_minutos' => 60, 
                    'precio' => 120.00, 
                    'fecha_dato' => null, 
                    'fecha_carga' => now(), 
                    'descripcion' => 'Tratamiento estético para aclarar el tono dental.' 
                ], 
                [ 
                    'nombre_tratamiento' => 'Estudio Ortodoncia', 
                    'duracion_minutos' => 60, 
                    'precio' => 120.00, 
                    'fecha_dato' => '2024-03-15', 
                    'fecha_carga' => now(), 
                    'descripcion' => 'Pruebas y estudio con un ortodonstista para comprobar la viabilidad de ortodoncia' 
                ], 
                [ 
                    'nombre_tratamiento' => 'Primera Visita', 
                    'duracion_minutos' => 15, 
                    'precio' => 45.00, 
                    'fecha_dato' => '2024-03-15', 
                    'fecha_carga' => now(), 
                    'descripcion' => 'Visita para revision o para conocer que necesidad se tiene' 
                ], 
         ]);
    }
}
