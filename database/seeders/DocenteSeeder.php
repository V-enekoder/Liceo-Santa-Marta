<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\Models\Docente;
use app\Models\User;
use database\seeders\UserSeeder;

class DocenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();
        $docentes = [];
    
        for ($i = 7; $i <= 10; $i++) {
            $docentes[] = ['user_id' => $userIds[$i]];
        }
    
        // Insertar
        Docente::insert($docentes);
    }
}
