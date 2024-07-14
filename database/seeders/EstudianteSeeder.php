<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\models\Estudiante;

class EstudianteSeeder extends Seeder
{
    public function run(): void
    {
        $estudiantes = [

            //Grado 1
            [
                'cedula' => '39505694',
                'primer_nombre' => 'Daniel',
                'segundo_nombre' => 'Luis',
                'primer_apellido' => 'Chitty',
                'segundo_apellido' => 'Varga',
                'fecha_nacimiento' => '2010-12-12',
                'ultimo_grado_aprobado' => '1',
            ],
            [
                'cedula' => '39606555',
                'primer_nombre' => 'Cristobal',
                'segundo_nombre' => 'Robert',
                'primer_apellido' => 'Mora',
                'segundo_apellido' => 'Sánchez',
                'fecha_nacimiento' => '2010-12-10',
                'ultimo_grado_aprobado' => '1',
            ],
            //Grado 2
            [
                'cedula' => '38505728',
                'primer_nombre' => 'Andres',
                'segundo_nombre' => 'Luis',
                'primer_apellido' => 'Perez',
                'segundo_apellido' => 'Suarez',
                'fecha_nacimiento' => '2009-05-10',
                'ultimo_grado_aprobado' => '2',
            ],
            [
                'cedula' => '38985156',
                'primer_nombre' => 'Martha',
                'segundo_nombre' => 'Sofia',
                'primer_apellido' => 'Balan',
                'segundo_apellido' => 'Vargas',
                'fecha_nacimiento' => '2009-7-05',
                'ultimo_grado_aprobado' => '2',
            ],
            //Grado 3
            [
                'cedula' => '38922530',
                'primer_nombre' => 'Lorena',
                'segundo_nombre' => 'Antonia',
                'primer_apellido' => 'Antuares',
                'segundo_apellido' => 'Reyes',
                'fecha_nacimiento' => '2008-10-10',
                'ultimo_grado_aprobado' => '3',
            ],
            [
                'cedula' => '38569752',
                'primer_nombre' => 'Carlos',
                'segundo_nombre' => 'Yerry',
                'primer_apellido' => 'Antuares',
                'segundo_apellido' => 'Silva',
                'fecha_nacimiento' => '2008-12-10',
                'ultimo_grado_aprobado' => '3',
            ],
            //Grado 4
            [
                'cedula' => '37922030',
                'primer_nombre' => 'Vanesa',
                'segundo_nombre' => 'Carolina',
                'primer_apellido' => 'Suarez',
                'segundo_apellido' => 'Vargas',
                'fecha_nacimiento' => '2009-02-10',
                'ultimo_grado_aprobado' => '4',
            ],
            [
                'cedula' => '37955436',
                'primer_nombre' => 'Camila',
                'segundo_nombre' => 'Maria',
                'primer_apellido' => 'Pereza',
                'segundo_apellido' => 'Quiroz',
                'fecha_nacimiento' => '2009-10-12',
                'ultimo_grado_aprobado' => '4',
            ],
            //Grado 5
            [
                'cedula' => '38101222',
                'primer_nombre' => 'James',
                'segundo_nombre' => 'Diego',
                'primer_apellido' => 'Vertelobet',
                'segundo_apellido' => 'Mata',
                'fecha_nacimiento' => '2010-11-12',
                'ultimo_grado_aprobado' => '5',
            ],
            [
                'cedula' => '37505262',
                'primer_nombre' => 'Martin',
                'segundo_nombre' => 'Juan',
                'primer_apellido' => 'San Andres',
                'segundo_apellido' => 'Palacios',
                'fecha_nacimiento' => '2010-11-10',
                'ultimo_grado_aprobado' => '5',
            ],
        ];

        foreach ($estudiantes as $estudianteData) {
            Estudiante::insert($estudianteData);
        }
    }
}
