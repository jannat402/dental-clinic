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
        //$faker = Faker::create();
        //
        /*
            DB::table('doctor')->insert([
                [
                    'nombre' => 'Laura',
                    'apellidos' => 'Lopez',
                    'email' => 'laura@example.com',
                    'especialidad' =>'Higienista',
                    'email'=>'ifasiofs@jnokfads.es',
                    'contrasenya' =>'sdfauojhojfasd',
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
                    'email'=>'nfhdn@jnokfads.es',
                    'contrasenya' =>'sdfauojhojfasd',
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
                    'email'=>'ifasiofs@adf.es',
                    'contrasenya' =>'adsffadfd',
                    'estado' => 'activo',
                    'fecha_dato' =>'2025-05-27',
                    'fecha_carga' =>now()
                ],
                [
                    'nombre' => 'Rita',
                    'apellidos' => 'Segovia Catala',
                    'email'=>'ifasifhdgsofs@adf.es',
                    'contrasenya' =>'adsfffdgadfd',
                    'especialidad' =>'Ortodoncia',
                    'estado' => 'baja',
                    'fecha_dato' =>'2026-02-23',
                    'fecha_carga' =>now()
                ]

        ]);
        */
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
             Doctor::factory(8)->create();
    }
}
