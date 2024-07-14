<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\models\EstudianteRepresentante;
use Database\Seeders\EstudianteSeeder;
use Database\Seeders\RepresentanteSeeder;
use Database\Seeders\Periodo_AcademicoSeeder;

class EstudianteRepresentanteSeeder extends Seeder
{
    public function run(): void
    {
        //estudianteid, representanteid, periodoid
        $this->CrearRegistroEstudianteRepresentante(1, 4, 1);
    }
    
    private function CrearRegistroEstudianteRepresentantes(int $startId, int $endId, int $periodoId): void
    {
        $totalEstudiantes = 2;
        $idEstudiante = 1;
    
         for ($i = $startId; $i <= $endId; $i++) {
            for ($j = 1; $j <= $totalEstudiantes; $j++) {
                $EstudianteRepresentanteData = [
                    'estudiante_id' => $idEstudiante,
                    'representante_id' => $i,
                    'periodo_id' => $periodoId,
                ];
                EstudianteRepresentante::insert($EstudianteRepresentanteData);
                $idEstudiante++;
            }
        }
    }
}
    