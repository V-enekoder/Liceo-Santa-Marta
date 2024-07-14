<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\User;
use app\Models\Calificacion;
use app\Models\Coordinador;
use app\Models\DocenteMateria;
use app\Models\Docente;
use app\Models\EstudianteRepresentante;
use app\Models\Estudiante;
use app\Models\GradoPeriodo;
use App\Models\Grado;
use app\Models\Materia;
use app\Models\Periodo_Academico;
use app\Models\Representante;
use app\Models\Seccion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\UserFactory;
use Database\Factories\CoordinadorFactory;


class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        //*Se ejecuta con 
        //*php artisan db:seed
        $this->call(RolesSeeder::class);
    }
}
