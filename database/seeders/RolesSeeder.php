<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class RolesSeeder extends Seeder
{
    //Se ejecuta con php artisan db:seed --class=RolesSeeder
    public function run(){
        // Define los roles predeterminados
        $roles = [
            ['nombre'=> 'Administrador'],
            ['nombre' => 'Coordinador'],
            ['nombre' => 'Docente'],
            ['nombre' => 'Representante'],
        ];
        
        Rol::insert($roles);
    }
}
