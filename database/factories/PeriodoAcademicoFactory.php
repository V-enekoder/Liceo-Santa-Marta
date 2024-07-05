<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Periodo_Academico;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory
 */
class PeriodoAcademicoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Periodo_Academico::class;

    public function definition(): array
    {
        $añoInicio = $this->faker->unique()->numberBetween(2000, 2030);
        $añoFin = $añoInicio + 1;
        $nombre = "{$añoInicio} - {$añoFin}";

        return [
            'nombre' => $nombre,
            'año_inicio' => $añoInicio,
            'año_fin' => $añoFin,
        ];
    }
}
