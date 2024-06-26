<?php

use App\Models\coordinador;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $users = User::all();
        return view('dashboard', compact('users'));
    })->name('dashboard');

<<<<<<< HEAD
Route::get('/victor', function () {
    return "+ ¿Shakira shakira? \n -lolelolelole...";
});

Route::get('/prueba', function () {
    $coordinador = new Coordinador();
    
    $coordinador->Cedula = 12345;
    $coordinador->Nombre = 'Victor';
    $coordinador->Apellido = 'Astudillo';
    $coordinador->Telefono = '123';
    $coordinador->Direccion = 'villa asia';
    $coordinador->Usuario = '';
    $coordinador->Clave = '123';
    $coordinador->Fecha_ingreso = '2023-06-25';
    $coordinador->Fecha_retiro = null;

    $coordinador->save();
    return $coordinador;
    //return "Hola desde la prueba";
});
=======
});
>>>>>>> cd8d9f7094d15e193c43b8850f3f1284ba574494
