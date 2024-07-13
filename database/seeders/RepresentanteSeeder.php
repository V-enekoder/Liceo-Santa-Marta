<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\models\Representante;
use Database\Seeders\UserSeeder;

class RepresentanteSeeder extends Seeder
{
    public function run(): void
    {

        $userIds = User::pluck('id')->toArray();
        $representantes = [];
    
        for ($i = 11; $i <= 15; $i++) {
            $representantes[] = ['user_id' => $userIds[$i]];
        }
    
        // Insertar
        Representante::insert($representantes);

    }
}
