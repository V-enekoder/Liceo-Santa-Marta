<?php

use App\Http\Controllers\CoordinadorController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\RepresentanteController;
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

    Route::get('/dashboard/periodos',[CoordinadorController::class, 'crearPeriodos'])->name('sidebar.periodos');
    Route::get('/dashboard/notas',[CoordinadorController::class, 'modificarNotas'])->name('sidebar.notas');
    Route::get('/dashboard/registroRepresentantes',[CoordinadorController::class, 'modificarRepresentantes'])->name('sidebar.modirepresentantes');
    Route::get('/dashboard/registroEstudiantes',[CoordinadorController::class, 'modificarEstudiantes'])->name('sidebar.modiestudiantes');
    Route::get('/dashboard/registroDocentes',[CoordinadorController::class, 'modificarDocentes'])->name('sidebar.modidocentes');
    Route::get('/dashboard/materias',[CoordinadorController::class, 'modificarMaterias'])->name('sidebar.materias');

    Route::get('/dashboard/CargaNotas',[DocenteController::class, 'cargarNotas'])->name('sidebar.CargaNotas');
    Route::get('/dashboard/DataSecciones',[DocenteController::class, 'verSecciones'])->name('sidebar.VerSecciones');
    Route::get('/dashboard/DataCargaAcademica',[DocenteController::class, 'verCargaAcademica'])->name('sidebar.VerCargaAcademica');

    Route::get('/dashboard/VerBoletin',[RepresentanteController::class, 'indexBoletin'])->name('boletin.index');
    Route::get('/dashboard/VerTodoBoletin',[RepresentanteController::class, 'indexTodoBoletin'])->name('boletin.indexTodo');
    Route::get('/dashboard/VerFicha',[RepresentanteController::class, 'verFicha'])->name('Ficha.index');
    


});
