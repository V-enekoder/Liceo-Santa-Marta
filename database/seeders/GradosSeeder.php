<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grado;
class GradosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $años = ['1', '2', '3', '4', '5'];

        foreach ($años as $año) {
            Grado::insert([
                'nombre' => $año
            ]);
        }
    }
}
