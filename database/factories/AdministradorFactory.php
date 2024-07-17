<?php

namespace Database\Factories;

use App\Models\Administrador;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdministradorFactory extends Factory
{
    protected $model = Administrador::class;

    public function definition()
    {
        return [
            'user_id' => function () {
                return User::factory()->create()->id;
            },
        ];
    }
}
