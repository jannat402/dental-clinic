<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first() ?? User::factory()->create([
            'name' => 'Default',
            'email' => 'default@user.com',
            'password' => bcrypt('password'),
        ]);

        Cliente::create([
            'nombre' => 'Test',
            'apellidos' => 'Cliente',
            'email' => 'test@client.com',
            'telefono' => '666111222',
            'contrasenya' => Hash::make('client123'),
            'metodo_autenticacion' => 'email',
            'user_id' => $user->id,
            'fecha_dato' => now(),
            'fecha_carga' => now(),
        ]);

        Cliente::factory(30)->create([
            'user_id' => $user->id,
        ]);
    }
}

