<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\models\Seccion;
use Database\Seeders\GradoPeriodoSeeder;


class SeccionSeeder extends Seeder
{
    public function run(): void
    {
        $secciones = [
            //Grado 1
            [
                'grado_periodo_id' => 1, 
                'nombre' => 'Sección A',
                'alumnos_inscritos' => 1,
                'capacidad' => 30,
            ],
            [
                'grado_periodo_id' => 1, 
                'nombre' => 'Sección B',
                'alumnos_inscritos' => 1,
                'capacidad' => 30,
            ],
            [
                'grado_periodo_id' => 1, 
                'nombre' => 'Sección C',
                'alumnos_inscritos' => 0,
                'capacidad' => 30,
            ],
            //Grado 2
            [
                'grado_periodo_id' => 2, 
                'nombre' => 'Sección A',
                'alumnos_inscritos' => 1,
                'capacidad' => 30,
            ],
            [
                'grado_periodo_id' => 2, 
                'nombre' => 'Sección B',
                'alumnos_inscritos' => 1,
                'capacidad' => 30,
            ],
            [
                'grado_periodo_id' => 2, 
                'nombre' => 'Sección C',
                'alumnos_inscritos' => 0,
                'capacidad' => 30,
            ],
            //Grado 3
            [
                'grado_periodo_id' => 3, 
                'nombre' => 'Sección A',
                'alumnos_inscritos' => 1,
                'capacidad' => 30,
            ],
            [
                'grado_periodo_id' => 3, 
                'nombre' => 'Sección B',
                'alumnos_inscritos' => 1,
                'capacidad' => 30,
            ],
            [
                'grado_periodo_id' => 3, 
                'nombre' => 'Sección C',
                'alumnos_inscritos' => 0,
                'capacidad' => 30,
            ],
            //Grado 4
            [
                'grado_periodo_id' => 4, 
                'nombre' => 'Sección A',
                'alumnos_inscritos' => 1,
                'capacidad' => 30,
            ],
            [
                'grado_periodo_id' => 4, 
                'nombre' => 'Sección B',
                'alumnos_inscritos' => 1,
                'capacidad' => 30,
            ],
            [
                'grado_periodo_id' => 4, 
                'nombre' => 'Sección C',
                'alumnos_inscritos' => 0,
                'capacidad' => 30,
            ],
            //Grado 5
            [
                'grado_periodo_id' => 5, 
                'nombre' => 'Sección A',
                'alumnos_inscritos' => 1,
                'capacidad' => 30,
            ],
            [
                'grado_periodo_id' => 5, 
                'nombre' => 'Sección B',
                'alumnos_inscritos' => 1,
                'capacidad' => 30,
            ],
            [
                'grado_periodo_id' => 5, 
                'nombre' => 'Sección C',
                'alumnos_inscritos' => 0,
                'capacidad' => 30,
            ],
        ];

        foreach ($secciones as $seccion) {
            Seccion::insert($seccion);
        }
    }
}
