<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Doctor;

use Faker\Factory as Faker;
class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        DB::table('doctor')->insert([
                [
                    'nombre' => 'Laura',
                    'apellidos' => 'Lopez',
                    'email' => 'laura@example.com',
                    'especialidad' =>'Higienista',
                    'contrasenya' => Hash::make('1234'),
                    'estado' => 'activo',
                    'fecha_dato' =>now(),
                    'fecha_carga' =>now()
                ],
                [
                    'nombre' => 'Carlos',
                    'apellidos' => 'Ruiz Garcia',
                    'email' => 'carlos@example.com',
                    'especialidad' =>'Higienista',
                    'especialidad' =>'Dentista General',
                    'estado' => 'vacaciones',
                    'fecha_dato' =>now(),
                    'fecha_carga' =>now()
                ],
                [
                    'nombre' => 'Cristobal',
                    'apellidos' => 'Ramon de los Santos',
                    'email' => 'cristobal@example.com',
                    'especialidad' =>'Higienista',
                    'especialidad' =>'Dentista general',
                    'estado' => 'activo',
                    'fecha_dato' =>'2025-05-27',
                    'fecha_carga' =>now()
                ],
                [
                    'nombre' => 'Rita',
                    'apellidos' => 'Segovia Catala',
                    'email' => 'rita@example.com',
                    'especialidad' =>'Higienista',
                    'especialidad' =>'Ortodoncia',
                    'estado' => 'baja',
                    'fecha_dato' =>'2026-02-23',
                    'fecha_carga' =>now()
                ]

        ]);
        /*
        for ($i = 0; $i < 20; $i++) 
            { 
                DB::table('doctor')->insert([ 
                    'nombre' => $faker->firstName(), 
                    'apellidos' => $faker->lastName() . ' ' . $faker->lastName(), 
                    'especialidad' => $faker->randomElement([ 'Higienista', 'Ortodoncia', 'General', null ]), 
                    'fecha_dato' => $faker->optional()->date(), 
                    'estado' => $faker->randomElement(['activo', 'vacaciones', 'baja']), 
                    'fecha_carga' => now(), 
                ]);
             }
                */
             Doctor::factory(2)->create();
    }
}
