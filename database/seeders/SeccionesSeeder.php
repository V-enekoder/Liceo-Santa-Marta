<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seccion;
use App\Models\GradoPeriodo;

class SeccionesSeeder extends Seeder
{
    public function run(): void
    {
        $grados = range(1, 5); // Array con los grados del 1 al 5
        $seccionesPorGrado = ['A', 'B', 'C']; // Nombres de las secciones

        foreach ($grados as $gradoId) {
            foreach ($seccionesPorGrado as $nombreSeccion) {
                Seccion::create([
                    'grado_periodo_id' => GradoPeriodo::where('grado_id', $gradoId)->where('periodo_id', 1)->first()->id,
                    'nombre' => $nombreSeccion,
                    'alumnos_inscritos' => 0,
                ]);
            }
        }
    }
}