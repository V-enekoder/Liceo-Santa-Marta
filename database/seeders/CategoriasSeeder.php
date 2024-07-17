<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(){
        // Define los roles predeterminados
        $roles = [
            ['nombre'=> 'Usuario'],
            ['nombre' => 'Estudiante'],
        ];
        
        Categoria::insert($roles);
    }
}
