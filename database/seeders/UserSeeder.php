<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Database\Seeders\RolesSeeder;

class UserSeeder extends Seeder
{

    public function run(): void
    {
//                  15 USUARIOS DEFINIDOS
        /*$users = [
            [
                'rol_id' => 2,
                'cedula' => '7815456',
                'primer_nombre' => 'Jose',
                'segundo_nombre'=> 'Gonzales',
                'primer_apellido' => 'Fernandez',
                'segundo_apellido' => 'Aponte',
                'email' => 'GonzaleFernandes123@gmail.com',
                'direccion' => 'Urbanización orinoco',
                'password' => bcrypt('Jose123'),
            ],
            [
                'rol_id' => 2,
                'cedula' => '9122585',
                'primer_nombre' => 'Jane',
                'segundo_nombre'=> 'Luisa',
                'primer_apellido' => 'Smith',
                'segundo_apellido' => 'Gonzales',
                'email' => 'janeSmith@gmail.com',
                'direccion' => 'Urbanización Caroni',
                'password' => bcrypt('Jane123'),
            ],
            [
                'rol_id' => 2,
                'cedula' => '15696873',
                'primer_nombre' => 'Maria',
                'segundo_nombre'=> 'Daniela',
                'primer_apellido' => 'Astudillo',
                'segundo_apellido' => 'Gomez',
                'email' => 'MariaDaniela@gmail.com',
                'direccion' => 'Sierra Parima',
                'password' => bcrypt('Maria123'),
            ],
            [
                'rol_id' => 2,
                'cedula' => '14585975',
                'primer_nombre' => 'Carolina',
                'segundo_nombre'=> 'Denisse',
                'primer_apellido' => 'Fernandez',
                'segundo_apellido' => 'Aponte',
                'email' => 'CarmeCarolina@gmail.com',
                'direccion' => 'Olivos',
                'password' => bcrypt('Car123'),
            ],
            [
                'rol_id' => 2,
                'cedula' => '16585985',
                'primer_nombre' => 'Lola',
                'segundo_nombre'=> 'Carolina',
                'primer_apellido' => 'Lamenento',
                'segundo_apellido' => 'Vargas',
                'email' => 'LamentoLamentoV@gmail.com',
                'direccion' => 'Castillito',
                'password' => bcrypt('Lamento123'),
            ],
            [
                'rol_id' => 2,
                'cedula' => '15879846',
                'primer_nombre' => 'Fernando',
                'segundo_nombre'=> 'Luis',
                'primer_apellido' => 'Colugna',
                'segundo_apellido' => 'Manrrique',
                'email' => 'FernandoCo@gmail.com',
                'direccion' => 'Altavista',
                'password' => bcrypt('Fernando123'),
            ],
            [ 
                'rol_id' => 3,
                'cedula' => '18456781',
                'primer_nombre' => 'Adelna',
                'segundo_nombre'=> 'Antonia',
                'primer_apellido' => 'Noriega',
                'segundo_apellido' => 'Aponte',
                'email' => 'AdelaN@gmail.com',
                'direccion' => 'Urbanización orinoco',
                'password' => bcrypt('Adela123'),
            ],
            [
                'rol_id' => 3,
                'cedula' => '15817562',
                'primer_nombre' => 'Juan',
                'segundo_nombre'=> 'Jeronimo',
                'primer_apellido' => 'Soler',
                'segundo_apellido' => 'Linares',
                'email' => 'JuanSolers@gmail.com',
                'direccion' => 'Villa Colombia',
                'password' => bcrypt('Juan123'),
            ],
            [
                'rol_id' => 3,
                'cedula' => '11549952',
                'primer_nombre' => 'Jadhira',
                'segundo_nombre'=> 'Carlota',
                'primer_apellido' => 'Castillo',
                'segundo_apellido' => 'Guillén',
                'email' => 'Carrillos@gmail.com',
                'direccion' => 'Villa Brasil',
                'password' => bcrypt('Carrillo123'),
            ],
            [
                'rol_id' => 3,
                'cedula' => '16828974',
                'primer_nombre' => 'Sergio',
                'segundo_nombre'=> 'Adrian',
                'primer_apellido' => 'Sendel',
                'segundo_apellido' => 'Ibañez',
                'email' => 'Sergio12@gmail.com',
                'direccion' => 'Villa Brasil',
                'password' => bcrypt('Sergio123'),
            ],
            [
                'rol_id' => 4,
                'cedula' => '16459375',
                'primer_nombre' => 'Lucero',
                'segundo_nombre'=> 'Hipolita',
                'primer_apellido' => 'Hogaza',
                'segundo_apellido' => 'Alborada',
                'email' => 'LuceritoA@gmail.com',
                'direccion' => 'Castillito',
                'password' => bcrypt('Lucero123'),
            ],
            [
                'rol_id' => 4,
                'cedula' => '8125695',
                'primer_nombre' => 'Arturo',
                'segundo_nombre'=> 'Roman',
                'primer_apellido' => 'Peniche',
                'segundo_apellido' => 'Giñen',
                'email' => 'ArturoP@gmail.com',
                'direccion' => 'Urbanización Caroni',
                'password' => bcrypt('Arturo123'),
            ],
            [
                'rol_id' => 4,
                'cedula' => '13645826',
                'primer_nombre' => 'Daniela',
                'segundo_nombre'=> 'Margarita',
                'primer_apellido' => 'Romo',
                'segundo_apellido' => 'Islas',
                'email' => 'DanielaR@gmail.com',
                'direccion' => 'Urbanización orinoco',
                'password' => bcrypt('Daniela123'),
            ],
            [
                'rol_id' => 4,
                'cedula' => '15267485',
                'primer_nombre' => 'Mauricio',
                'segundo_nombre'=> 'Carlos',
                'primer_apellido' => 'Islas',
                'segundo_apellido' => 'Rodriguez',
                'email' => 'MauricioA@gmail.com',
                'direccion' => 'Urbanización Caroni',
                'password' => bcrypt('Mauricio123'),
            ],
            [
                'rol_id' => 4,
                'cedula' => '18252648',
                'primer_nombre' => 'Silvia',
                'segundo_nombre'=> 'Alejandra',
                'primer_apellido' => 'Navarro',
                'segundo_apellido' => 'Coral',
                'email' => 'SilviaN@gmail.com',
                'direccion' => 'Urbanización Caroni',
                'password' => bcrypt('Silvia123'),
            ],
        ];
        // Inserta los registros utilizando el modelo User
        foreach ($users as $userData) {
            User::insert($userData);
        }*/
    }
}
