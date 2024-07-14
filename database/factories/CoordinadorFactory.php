<?php

namespace Database\Factories;

use App\Models\Coordinador;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoordinadorFactory extends Factory
{
    protected $model = Coordinador::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),  // Crea un nuevo usuario si no se proporciona uno
            'fecha_ingreso' => $this->faker->date(),
            'fecha_retiro' => $this->faker->optional()->date(),
        ];
    }
}

