<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\models\Periodo_Academico;

class Periodo_AcademicoSeeder extends Seeder
{
    public function run(): void
    {
        $periodo = [
            'Nombre' => 'Periodo Academico 2023-2024',
            'año_inicio' => 2023,
            'año_fin' => 2024,
        ];

        PeriodoAcademico::insert($periodo);
    }
}
