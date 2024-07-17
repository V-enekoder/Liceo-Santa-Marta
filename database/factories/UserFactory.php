<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Persona;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'persona_id' => function () {
                return Persona::factory()->withCategoriaId(1)->create()->id;
            },
            'rol_id' => 4, // Valor por defecto
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('12341234'), // Contraseña por defecto
            'remember_token' => Str::random(10),
        ];
    }


    public function withRolId($rolId)
    {
        return $this->state(function (array $attributes) use ($rolId) {
            return [
                'rol_id' => $rolId,
            ];
        });
    }

    public function withPersonaId($personaId)
    {
        return $this->state(function (array $attributes) use ($personaId) {
            return [
                'persona_id' => $personaId,
            ];
        });
    }
}