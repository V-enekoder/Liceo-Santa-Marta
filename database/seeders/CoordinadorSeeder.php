<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\models\Coordinador;
use Database\Seeders\UserSeeder;

class CoordinadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $user = \App\Models\User::factory()->withRole(2)->create(); // Asigna rol_id 2
            \app\Models\Coordinador::factory()->withUser($user->id)->create();
            }


    /*    $userIds = User::pluck('id')->toArray();
        $coordinadores = [
            [
                'user_id' => $userIds[1],
                'fecha_ingreso' => '2021-01-01',
                'fecha_retiro' => null,
            ],
            [
                'user_id' => $userIds[2],
                'fecha_ingreso' => '2022-02-02',
                'fecha_retiro' => '2023-03-03',
            ],
            [
                'user_id' => $userIds[3],
                'fecha_ingreso' => '2022-02-02',
                'fecha_retiro' => '2024-10-03',
            ],
            [
                'user_id' => $userIds[4],
                'fecha_ingreso' => '2021-01-10',
                'fecha_retiro' => null,
            ],
            [
                'user_id' => $userIds[5],
                'fecha_ingreso' => '2020-02-01',
                'fecha_retiro' => '2025-04-02',
            ],
            [
                'user_id' => $userIds[6],
                'fecha_ingreso' => '2020-02-01',
                'fecha_retiro' => '2025-04-02',
            ],
        ];

        //Insertar 
        foreach ($coordinadores as $coordinadorData) {
            Coordinador::insert($coordinadorData);
        }*/
    }
}
