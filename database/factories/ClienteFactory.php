<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
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
            'apellidos' => $this->faker->lastName().$this->faker->lastName(),
            'telefono' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'metodo_autenticacion' =>$this->faker->randomElement(['telefono','email']),
            'fecha_dato' => $this->faker->date()
        ];
    }
}
