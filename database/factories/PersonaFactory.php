<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Persona;
use App\Models\Categoria;

class PersonaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Persona::class;

            /**
Crear una persona con un categoría_id específico
$persona = Persona::factory()->withCategoriaId(1)->create();

// Crear una persona con un categoría_id generado automáticamente
$persona = Persona::factory()->create();
         */
    public function definition()
    {
        return [
            'categoría_id' => function () {
                return Categoria::factory()->create()->id;
            },
            'cedula' => $this->faker->unique()->numberBetween(1000000, 99999999),
            'tipo' => $this->faker->numberBetween(1, 2),
            'primer_nombre' => $this->faker->firstName,
            'segundo_nombre' => $this->faker->firstName,
            'primer_apellido' => $this->faker->lastName,
            'segundo_apellido' => $this->faker->lastName,
            'direccion' => $this->faker->address,
            'fecha_nacimiento' => $this->faker->date,
            'activo' => $this->faker->boolean,
        ];
    }

    public function withCategoriaId($categoriaId)
    {
        return $this->state(function (array $attributes) use ($categoriaId) {
            return [
                'categoría_id' => $categoriaId,
            ];
        });
    }
}