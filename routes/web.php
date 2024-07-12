<?php

use App\Http\Controllers\CoordinadorController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\RepresentanteController;
use App\Models\coordinador;
use App\Models\Representante;
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
});

/*Route::get('/victor','app\Http\Controllers\TelefonosController@index' /*function () {
return "+ ¿Shakira shakira? \n -lolelolelole...";
});*/

//rutas de vistas para los coordinadores, aun falta añadir la de secciones y creo que otra pero aun no se ha añadido
Route::get('/dashboard/periodos', [coordinadorController::class, 'crearPeriodos'])->name('sidebar.periodos');
Route::get('/dashboard/dataNotas', [coordinadorController::class, 'modificarNotas'])->name('sidebar.notas');
Route::get('/dashboard/dataRepresentantes', [coordinadorController::class, 'modificarRepresentantes'])->name('sidebar.modirepresentantes');
Route::get('/dashboard/dataEstudiantes', [coordinadorController::class, 'modificarEstudiantes'])->name('sidebar.modiestudiantes');
Route::get('/dashboard/dataDocentes', [coordinadorController::class, 'modificarDocentes'])->name('sidebar.modidocentes');
Route::get('/dashboard/dataMaterias', [coordinadorController::class, 'modificarMaterias'])->name('sidebar.materias');
Route::get('/dashboard/CargaAcademica', [coordinadorController::class, 'crearCargaAcademica'])->name('sidebar.cargaAcademica');

//ruta de vistas para los docentes
Route::get('/dashboard/CargaNotas', [DocenteController::class, 'cargarNotas'])->name('sidebar.CargaNotas');
Route::get('/dashboard/DataSecciones', [DocenteController::class, 'verSecciones'])->name('sidebar.VerSecciones');
Route::get('/dashboard/DataCargaAcademica', [DocenteController::class, 'verCargaAcademica'])->name('sidebar.VerCargaAcademica');

//Ruta de vistas para los representantes 
Route::get('/dashboard/VerBoletin', [RepresentanteController::class, 'indexBoletin'])->name('boletin.index');
Route::get('/dashboard/VerTodoBoletin', [RepresentanteController::class, 'indexTodoBoletin'])->name('boletin.indexTodo');
Route::get('/dashboard/VerFicha', [RepresentanteController::class, 'verFicha'])->name('Ficha.index');

//Route::post('/usuarios', [CoordinadorController::class, 'crear_usuario']);
//Route::post('/periodos-academicos', [CoordinadorController::class, 'crear_periodo_academico']);
Route::post('/coordinador/crear_periodo_academico', [CoordinadorController::class, 'crear_periodo_academico'])->name('coordinador.crear_periodo_academico');
//Route::post('/coordinador/telefono-por-cedula', [RepresentanteController::class, 'agregar_telefono']);
//Route::post('/coordinador/crear-estudiante', [CoordinadorController::class, 'crear_estudiante']);
//Route::post('/materia', [CoordinadorController::class, 'crear_materia']);
//Route::post('/crear-seccion', [CoordinadorController::class, 'crearSeccion']);
//Route::post('/asignar_carga', [CoordinadorController::class, 'asignarCargaAcademica'])
//Route::post('/modifica_nota', [CoordinadorController::class, 'modificar_nota'])
//Route::post('/mostrar_docente', [CoordinadorController::class, 'mostrarDocentePorCedula'])
//Route::post('/mostrar_estudiante', [CoordinadorController::class, 'mostrarEstudiantePorCedula'])
//Route::get('/coordinador/representante/{cedula}', [CoordinadorController::class, 'mostrarRepresentantePorCedula']);
//Route::post('/coordinador/vincular', [CoordinadorController::class, 'vincularEstudianteRepresentante']);
//Route::post('/coordinador/eliminar-representante', [CoordinadorController::class, 'eliminarRepresentante']);
//Route::post('/coordinador/ficha_estudiante', [CoordinadorController::class, 'mostrarFichaEstudiante']);