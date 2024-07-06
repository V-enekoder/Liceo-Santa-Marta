<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Se ejecuta con php artisan db:seed
        $this->call(RolesSeeder::class);
    }
}
