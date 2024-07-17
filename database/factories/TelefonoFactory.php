<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Telefono;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Telefono>
 */
class TelefonoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Telefono::class;

    public function definition()
    {
        return [
            'user_id' => function () {
                return User::factory()->create()->id; // Crea un usuario y usa su cédula
            },
            'numero_telefonico' => $this->faker->phoneNumber,
        ];
    }
}
