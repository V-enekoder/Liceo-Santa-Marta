<?php

namespace Database\Factories;

use App\Models\Docente;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocenteFactory extends Factory
{
    protected $model = Docente::class;

    public function definition()
    {
        return [
            'user_id' => function () {
                return User::factory()->withRolId(3)->create()->id;
            },
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