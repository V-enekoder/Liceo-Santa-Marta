<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Coordinador;
use App\Models\Docente;
use App\Models\Representante;
use App\Models\Estudiante;
class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        //*Se ejecuta con 
        //*php artisan db:seed

        $this->call(CategoriasSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(GradosSeeder::class);
        $this->call(MateriasSeeder::class);
        $this->call(AdministradorSeeder::class);
        Coordinador::factory()->count(6)->create();
        Docente::factory()->count(10)->create();
        Representante::factory()->count(15)->create();
        Estudiante::factory()->count(60)->create();
        $this->call(Periodo_AcademicoSeeder::class);
        $this->call(CoordinadorPeriodoSeeder::class);
        $this->call(EstudianteRepresentanteSeeder::class);
        $this->call(GradoPeriodoSeeder::class);
        $this->call(SeccionesSeeder::class);

    }
}
