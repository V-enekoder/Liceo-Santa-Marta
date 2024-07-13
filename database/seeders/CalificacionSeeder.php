<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\models\Calificacion;
use Database\Seeders\DocenteMateriaSeeder;
use Database\Seeders\EstudianteSeeder;

class CalificacionSeeder extends Seeder
{
    public function run(): void
    {
        $calificaciones = [
            //Grado 1
            [
                'docente_materia_id' => 1, 
                'estudiante_id' => 1, 
                'lapso_1' => 50,
                'lapso_2' => 75,
                'lapso_3' => 100,
                'promedio' => 75,
            ],
            [
                'docente_materia_id' => 4, 
                'estudiante_id' => 1, 
                'lapso_1' => 90,
                'lapso_2' => 75,
                'lapso_3' => 95,
                'promedio' => 87,
            ],
            [
                'docente_materia_id' => 9, 
                'estudiante_id' => 1, 
                'lapso_1' => 90,
                'lapso_2' => 95,
                'lapso_3' => 95,
                'promedio' => 92,
            ],
            [
                'docente_materia_id' => 1, 
                'estudiante_id' => 2, 
                'lapso_1' => 50,
                'lapso_2' => 75,
                'lapso_3' => 100,
                'promedio' => 75,
            ],
            [
                'docente_materia_id' => 4, 
                'estudiante_id' => 2, 
                'lapso_1' => 90,
                'lapso_2' => 75,
                'lapso_3' => 95,
                'promedio' => 87,
            ],
            [
                'docente_materia_id' => 9, 
                'estudiante_id' => 2, 
                'lapso_1' => 55,
                'lapso_2' => 55,
                'lapso_3' => 55,
                'promedio' => 55,
            ],
            //Grado 2
            [
                'docente_materia_id' => 6, 
                'estudiante_id' => 3, 
                'lapso_1' => 90,
                'lapso_2' => 75,
                'lapso_3' => 95,
                'promedio' => 87,
            ],
            [
                'docente_materia_id' => 13, 
                'estudiante_id' => 3, 
                'lapso_1' => 50,
                'lapso_2' => 50,
                'lapso_3' => 80,
                'promedio' => 60,
            ],
            [
                'docente_materia_id' => 2, 
                'estudiante_id' => 3, 
                'lapso_1' => 90,
                'lapso_2' => 95,
                'lapso_3' => 95,
                'promedio' => 92,
            ],
            [
                'docente_materia_id' => 6, 
                'estudiante_id' => 4, 
                'lapso_1' => 50,
                'lapso_2' => 50,
                'lapso_3' => 80,
                'promedio' => 60,
            ],
            [
                'docente_materia_id' => 13, 
                'estudiante_id' => 4, 
                'lapso_1' => 90,
                'lapso_2' => 75,
                'lapso_3' => 95,
                'promedio' => 87,
            ],
            [
                'docente_materia_id' => 2, 
                'estudiante_id' => 4, 
                'lapso_1' => 20,
                'lapso_2' => 10,
                'lapso_3' => 100,
                'promedio' => 43,
            ],
            //Grado 3
            [
                'docente_materia_id' => 7, 
                'estudiante_id' => 5, 
                'lapso_1' => 90,
                'lapso_2' => 100,
                'lapso_3' => 95,
                'promedio' => 95,
            ],
            [
                'docente_materia_id' => 5, 
                'estudiante_id' => 5, 
                'lapso_1' => 90,
                'lapso_2' => 75,
                'lapso_3' => 95,
                'promedio' => 87,
            ],
            [
                'docente_materia_id' => 10, 
                'estudiante_id' => 5, 
                'lapso_1' => 20,
                'lapso_2' => 10,
                'lapso_3' => 100,
                'promedio' => 43,
            ],
            [
                'docente_materia_id' => 7, 
                'estudiante_id' => 6, 
                'lapso_1' => 75,
                'lapso_2' => 60,
                'lapso_3' => 30,
                'promedio' => 55,
            ],
            [
                'docente_materia_id' => 5, 
                'estudiante_id' => 6, 
                'lapso_1' => 90,
                'lapso_2' => 75,
                'lapso_3' => 95,
                'promedio' => 87,
            ],
            [
                'docente_materia_id' => 10, 
                'estudiante_id' => 6, 
                'lapso_1' => 90,
                'lapso_2' => 95,
                'lapso_3' => 95,
                'promedio' => 92,
            ],
            //Grado 4
            [
                'docente_materia_id' => 3, 
                'estudiante_id' => 7, 
                'lapso_1' => 90,
                'lapso_2' => 75,
                'lapso_3' => 95,
                'promedio' => 87,
            ],
            [
                'docente_materia_id' => 14, 
                'estudiante_id' => 7, 
                'lapso_1' => 90,
                'lapso_2' => 75,
                'lapso_3' => 95,
                'promedio' => 87,
            ],
            [
                'docente_materia_id' => 8, 
                'estudiante_id' => 7, 
                'lapso_1' => 75,
                'lapso_2' => 60,
                'lapso_3' => 30,
                'promedio' => 55,
            ],
            [
                'docente_materia_id' => 3, 
                'estudiante_id' => 8, 
                'lapso_1' => 90,
                'lapso_2' => 75,
                'lapso_3' => 95,
                'promedio' => 87,
            ],
            [
                'docente_materia_id' => 14, 
                'estudiante_id' => 8, 
                'lapso_1' => 90,
                'lapso_2' => 100,
                'lapso_3' => 95,
                'promedio' => 95,
            ],
            [
                'docente_materia_id' => 8, 
                'estudiante_id' => 8, 
                'lapso_1' => 90,
                'lapso_2' => 95,
                'lapso_3' => 95,
                'promedio' => 92,
            ],
             //Grado 5
             [
                'docente_materia_id' => 12, 
                'estudiante_id' => 9, 
                'lapso_1' => 10,
                'lapso_2' => 5,
                'lapso_3' => 1,
                'promedio' => 5,
            ],
            [
                'docente_materia_id' => 15, 
                'estudiante_id' => 9, 
                'lapso_1' => 90,
                'lapso_2' => 75,
                'lapso_3' => 95,
                'promedio' => 87,
            ],
            [
                'docente_materia_id' => 11, 
                'estudiante_id' => 9, 
                'lapso_1' => 50,
                'lapso_2' => 75,
                'lapso_3' => 100,
                'promedio' => 75,
            ],
            [
                'docente_materia_id' => 12, 
                'estudiante_id' => 10, 
                'lapso_1' => 90,
                'lapso_2' => 100,
                'lapso_3' => 95,
                'promedio' => 95,
            ],
            [
                'docente_materia_id' => 15, 
                'estudiante_id' => 10, 
                'lapso_1' => 90,
                'lapso_2' => 75,
                'lapso_3' => 95,
                'promedio' => 87,
            ],
            [
                'docente_materia_id' => 11, 
                'estudiante_id' => 10, 
                'lapso_1' => 75,
                'lapso_2' => 60,
                'lapso_3' => 30,
                'promedio' => 55,
            ],
            
        ];

        foreach ($calificaciones as $calificacion) {
            Calificacion::insert($calificacion);
        }
    }
}
