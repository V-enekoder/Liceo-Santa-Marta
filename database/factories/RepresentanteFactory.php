<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Representante; 
use App\Models\User;
//Seguir investigando como utilizar las fabricas

class RepresentanteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */   protected $model = Representante::class;


    public function definition(): array
    {
        $user = User::factory()->create();

        return [
            'user_cedula' => $user->cedula,
        ];
    }
}
