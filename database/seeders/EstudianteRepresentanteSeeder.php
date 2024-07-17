<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EstudianteRepresentante;

class EstudianteRepresentanteSeeder extends Seeder
{
    public function run(): void
    {
        $this->vincular(1, 15, 1, 2, 1, 60);
    }

    private function vincular(
        int $startRepresentanteId,
        int $endRepresentanteId,
        int $periodoId,
        int $estudiantesPorRepresentante,
        int $startEstudianteId,
        int $endEstudianteId
    ): void {
        $estudianteId = $startEstudianteId;

        for ($i = $startRepresentanteId; $i <= $endRepresentanteId; $i++) {
            for ($j = 1; $j <= $estudiantesPorRepresentante; $j++) {
                $EstudianteRepresentanteData = [
                    'estudiante_id' => $estudianteId,
                    'representante_id' => $i,
                    'periodo_id' => $periodoId,
                ];
                EstudianteRepresentante::create($EstudianteRepresentanteData);
                $estudianteId++;
            }
        }
    }
}

    