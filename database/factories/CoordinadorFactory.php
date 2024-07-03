<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coordinador>
 */
class CoordinadorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fecha_ingreso' => $this->faker->date(),
            'fecha_retiro' => null, // Establece la fecha de retiro como null
            'user_cedula' => function () {
                return \App\Models\User::factory()->create()->cedula; // Crea un usuario y obtén su cédula
            },
        ];
    }
}
