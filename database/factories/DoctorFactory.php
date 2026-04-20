<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'nombre' => $this->faker->firstName(),
            'apellidos' => $this->faker->lastName(), 
            'email' => fake()->unique()->safeEmail(),
            'contrasenya' => Hash::make(fake()->password()),
            'especialidad' => $this->faker->randomElement([ 'Higienista', 'Ortodoncia', 'General', null]), 
            'fecha_dato' => $this->faker->date(), 
            'estado' => $this->faker->randomElement(['activo', 'vacaciones', 'baja']), 
        ];
    }
}
