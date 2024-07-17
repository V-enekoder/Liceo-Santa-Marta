<?php

namespace Database\Factories;

use App\Models\Representante;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RepresentanteFactory extends Factory
{
    protected $model = Representante::class;

    public function definition()
    {
        return [
            'user_id' => function () {
                return User::factory()->withRolId(4)->create()->id;
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
