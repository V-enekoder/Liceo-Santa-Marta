<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\models\Periodo_Academico;

class Periodo_AcademicoSeeder extends Seeder
{
    public function run(): void
    {
        $periodo = [
            'nombre' => 'Periodo Academico 2023-2024',
            'año_inicio' => 2023,
            'año_fin' => 2024,
            'actual' => true,
        ];

        Periodo_Academico::insert($periodo);
    }
}
