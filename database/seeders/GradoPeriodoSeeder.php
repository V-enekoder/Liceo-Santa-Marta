<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\models\GradoPeriodo;
use Database\Seeders\GradoSeeder;
use Database\Seeders\Periodo_AcademicoSeeder;

class GradoPeriodoSeeder extends Seeder
{

    public function run(): void
    {
        $gradoPeriodos = [
            [
                'grado_id' => 1, 
                'periodo_id' => 1, 
            ],
            [
                'grado_id' => 2, 
                'periodo_id' => 1, 
            ],
            [
                'grado_id' => 3, 
                'periodo_id' => 1, 
            ],
            [
                'grado_id' => 4, 
                'periodo_id' => 1, 
            ],
            [
                'grado_id' => 5, 
                'periodo_id' => 1, 
            ],
        ];

        foreach ($gradoPeriodos as $gradoPeriodo) {
            GradoPeriodo::insert($gradoPeriodo);
        }
    }
}
