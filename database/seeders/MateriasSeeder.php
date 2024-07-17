<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Materia;

class MateriasSeeder extends Seeder
{
    public function run(): void
    {
        $materias = [
        //Grado 1
        [
            'grado_id' => 1, 
            'nombre' => 'Orientación',
        ],
        [
            'grado_id' => 1, 
            'nombre' => 'Historia Venezolana',
        ],
        [
            'grado_id' => 1, 
            'nombre' => 'Matemáticas',
        ],
        //Grado 2
        [
            'grado_id' => 2, 
            'nombre' => 'Literatura',
        ],
        [
            'grado_id' => 2, 
            'nombre' => 'Ciencias Naturales',
        ],
        [
            'grado_id' => 2, 
            'nombre' => 'Educación Física',
        ],
        //Grado 3
        [
            'grado_id' => 3, 
            'nombre' => 'Inglés I',
        ],
        [
            'grado_id' => 3, 
            'nombre' => 'Historia Universal',
        ],
        [
            'grado_id' => 3, 
            'nombre' => 'Matemáticas II',
        ],
        //Grado 4
        [
            'grado_id' => 4, 
            'nombre' => 'Física I',
        ],
        [
            'grado_id' => 4, 
            'nombre' => 'Química I',
        ],
        [
            'grado_id' => 4, 
            'nombre' => 'Inglés II',
        ],
        //Grado 5
        [
            'grado_id' => 5, 
            'nombre' => 'Física II',
        ],
        [
            'grado_id' => 5, 
            'nombre' => 'Química II',
        ],
        [
            'grado_id' => 5, 
            'nombre' => 'Dibujo Técnico',
        ],
        ];
        foreach ($materias as $materia) {
            Materia::insert($materia);
        }

    }
}
