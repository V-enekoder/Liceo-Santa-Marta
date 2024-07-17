<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GradoPeriodo;

class GradoPeriodoSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            GradoPeriodo::create([
                'grado_id' => $i,
                'periodo_id' => 1,
            ]);
        }
    }
}
