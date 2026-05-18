<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Tratamiento;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssignarPrimeraVisitaSeeder extends Seeder
{
    public function run(): void
    {
        $primeraVisita = Tratamiento::where('nombre_tratamiento', 'Primera Visita')->first();

        if (!$primeraVisita) {
            $this->command->warn('Tratamiento "Primera Visita" no trobat. Executa TratamientoSeeder primer.');
            return;
        }

        $doctores = Doctor::all();
        $count = 0;

        foreach ($doctores as $doctor) {
            $té = DB::table('doctor_tratamiento')
                ->where('id_doctor', $doctor->id_doctor)
                ->where('id_tratamiento', $primeraVisita->id_tratamiento)
                ->exists();

            if (!$té) {
                DB::table('doctor_tratamiento')->insert([
                    'id_doctor' => $doctor->id_doctor,
                    'id_tratamiento' => $primeraVisita->id_tratamiento,
                ]);
                $count++;
            }
        }

        $this->command->info("Primera Visita assignada a {$count} doctors.");
    }
}
