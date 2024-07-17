<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CoordinadorPeriodo;

class CoordinadorPeriodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Coordinadores del 1 al 6
        for ($coordinadorId = 1; $coordinadorId <= 6; $coordinadorId++) {
            CoordinadorPeriodo::create([
                'coordinador_id' => $coordinadorId,
                'periodo_id' => 1,
            ]);
        }
    }
}
