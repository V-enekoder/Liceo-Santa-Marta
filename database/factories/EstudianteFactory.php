<?php

namespace Database\Factories;

use App\Models\Estudiante;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Persona;

class EstudianteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Estudiante::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'persona_id' => function () {
                return Persona::factory()->create(['categoria_id' => 2])->id;
            },
            'ultimo_grado_aprobado' => $this->faker->numberBetween(0, 5),
            'inscrito' => 0
        ];
    }
}

