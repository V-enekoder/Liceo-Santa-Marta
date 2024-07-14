<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cedula' => $this->faker->unique()->numberBetween(10000000, 99999999),
            'rol_id' => 4,  // valor por defecto
            'primer_nombre' => $this->faker->firstName,
            'segundo_nombre' => $this->faker->optional()->firstName,
            'primer_apellido' => $this->faker->lastName,
            'segundo_apellido' => $this->faker->optional()->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // o puedes usar Hash::make('password')
            'direccion' => $this->faker->address,
            'activo' => true,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the user should have a specific role.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withRole($roleId)
    {
        return $this->state(function (array $attributes) use ($roleId) {
            return [
                'rol_id' => $roleId,
            ];
        });
    }
}
