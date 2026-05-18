<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use App\Models\Doctor;
use App\Models\Tratamiento;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        $doctores = Doctor::factory(4)->create();
        $tratamientos = Tratamiento::all();

        if ($tratamientos->isEmpty()) {
            $this->call(TratamientoSeeder::class);
            $tratamientos = Tratamiento::all();
        }

        // Tots els doctors tenen "Primera Visita"
        $primeraVisita = Tratamiento::where('nombre_tratamiento', 'Primera Visita')->first();

        foreach ($doctores as $doctor) {
            if ($primeraVisita) {
                try {
                    DB::table('doctor_tratamiento')->insert([
                        'id_doctor' => $doctor->id_doctor,
                        'id_tratamiento' => $primeraVisita->id_tratamiento,
                    ]);
                } catch (\Exception $e) {
                    // Already assigned, skip
                }
            }

            // Assignar tractaments aleatoris addicionals
            $tractamentsAssignats = $tratamientos->random(min(3, $tratamientos->count()));
            foreach ($tractamentsAssignats as $t) {
                if ($t->id_tratamiento === ($primeraVisita->id_tratamiento ?? null)) {
                    continue;
                }
                try {
                    DB::table('doctor_tratamiento')->insert([
                        'id_doctor' => $doctor->id_doctor,
                        'id_tratamiento' => $t->id_tratamiento,
                    ]);
                } catch (\Exception $e) {
                    // Unique constraint, skip
                }
            }
        }
    }
}
