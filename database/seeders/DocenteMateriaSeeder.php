<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\models\DocenteMateria;
use Database\Seeders\DocenteSeeder;
use Database\Seeders\MateriaSeeder;
use Database\Seeders\Periodo_AcademicoSeeder;

class DocenteMateriaSeeder extends Seeder
{
    public function run(): void
    {
        //Profesor 1 : id 6
        $docenteMateriaData = [
            'docente_id' => 6,
            'materia_id' => 1,
            'periodo_id' => 1,
        ];
        $docenteMateriaData = [
            'docente_id' => 6,
            'materia_id' => 6,
            'periodo_id' => 1,
        ];
        $docenteMateriaData = [
            'docente_id' => 6,
            'materia_id' => 10,
            'periodo_id' => 1,
        ];

        //Profesor 2 : id 7
        $docenteMateriaData = [
            'docente_id' => 7,
            'materia_id' => 2,
            'periodo_id' => 1,
        ];
        $docenteMateriaData = [
            'docente_id' => 7,
            'materia_id' => 8,
            'periodo_id' => 1,
        ];
        $docenteMateriaData = [
            'docente_id' => 7,
            'materia_id' => 4,
            'periodo_id' => 1,
        ];
        $docenteMateriaData = [
            'docente_id' => 7,
            'materia_id' => 7,
            'periodo_id' => 1,
        ];
        $docenteMateriaData = [
            'docente_id' => 7,
            'materia_id' => 12,
            'periodo_id' => 1,
        ];

        //Profesor 3 : id 8
        $docenteMateriaData = [
            'docente_id' => 8,
            'materia_id' => 3,
            'periodo_id' => 1,
        ];
        $docenteMateriaData = [
            'docente_id' => 8,
            'materia_id' => 9,
            'periodo_id' => 1,
        ];
        $docenteMateriaData = [
            'docente_id' => 8,
            'materia_id' => 15,
            'periodo_id' => 1,
        ];
        $docenteMateriaData = [
            'docente_id' => 8,
            'materia_id' => 13,
            'periodo_id' => 1,
        ];

        //Profesor 4 : id 9
        $docenteMateriaData = [
            'docente_id' => 9,
            'materia_id' => 5,
            'periodo_id' => 1,
        ];
        $docenteMateriaData = [
            'docente_id' => 9,
            'materia_id' => 11,
            'periodo_id' => 1,
        ];
        $docenteMateriaData = [
            'docente_id' => 9,
            'materia_id' => 14,
            'periodo_id' => 1,
        ];

        //Insertar
        foreach ($docenteMateriaData as $docenteData) {
            DocenteMateria::insert($docenteData);
        }
    }

}