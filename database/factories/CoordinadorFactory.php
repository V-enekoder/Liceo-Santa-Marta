<?php

namespace Database\Factories;

use App\Models\Coordinador;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoordinadorFactory extends Factory
{
    protected $model = Coordinador::class;

    public function definition()
    {
        return [
            'user_id' => function () {
                return User::factory()->withRolId(2)->create()->id;
            },
            'fecha_ingreso' => $this->faker->date,
            'fecha_retiro' => null,
        ];
    }

    public function withUserId($userId)
    {
        return $this->state(function (array $attributes) use ($userId) {
            return [
                'user_id' => $userId,
            ];
        });
    }
}


