<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // Define los usuarios predeterminados
        $users = [
            [
                'cedula' => 1001,
                'rol_id' => 1,
                'nombre' => 'Juan',
                'apellido' => 'Perez',
                'email' => 'a@a.com',
                'email_verified_at' => now(),
                'clave' => 'contraseña',
                'direccion' => 'Calle Falsa 123',
                'activo' => true,
                'remember_token' => Str::random(10),
                'current_team_id' => null,
                'profile_photo_path' => null,
            ],
            [
                'cedula' => 1002,
                'rol_id' => 2,
                'nombre' => 'Maria',
                'apellido' => 'Lopez',
                'email' => 'b@b.com',
                'email_verified_at' => now(),
                'clave' => Hash::make('password123'),
                'direccion' => 'Avenida Siempre Viva 456',
                'activo' => true,
                'remember_token' => Str::random(10),
                'current_team_id' => null,
                'profile_photo_path' => null,
            ],
            [
                'cedula' => 1003,
                'rol_id' => 3,
                'nombre' => 'Carlos',
                'apellido' => 'Martinez',
                'email' => 'c@c.com',
                'email_verified_at' => now(),
                'clave' => Hash::make('password123'),
                'direccion' => 'Boulevard Los Pinos 789',
                'activo' => true,
                'remember_token' => Str::random(10),
                'current_team_id' => null,
                'profile_photo_path' => null,
            ],
        ];

        // Inserta los registros utilizando el modelo User
        User::insert($users);
    }
}
