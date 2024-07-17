<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Persona;
use App\Models\User;
use App\Models\Administrador;

class AdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear la persona con los datos especificados
        $persona = Persona::factory()->create([
            'categoría_id' => 1,
            'cedula' => 0, // Suponiendo que cedula es única
            'tipo' => 1, // Puedes ajustar este valor según sea necesario
            'primer_nombre' => 'admin',
            'segundo_nombre' => null,
            'primer_apellido' => null,
            'segundo_apellido' => null,
            'direccion' => null,
            'fecha_nacimiento' => null,
            'activo' => true,
        ]);

        // Crear el usuario asociado a esa persona y asignarle el rol de administrador (rol_id = 1)
        $user = User::factory()->create([
            'persona_id' => $persona->id,
            'rol_id' => 1, // rol_id para administrador
            'email' => 'admin@admin.com', // Email del administrador
            'password' => bcrypt('12345678'), // Contraseña del administrador
        ]);

        // Crear el registro en la tabla 'administradores'
        Administrador::factory()->create([
            'user_id' => $user->id,
        ]);
    }
}
