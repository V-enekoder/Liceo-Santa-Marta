<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\CoordinadorController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\RepresentanteController;
use App\Http\Controllers\MateriaController;
use App\Models\coordinador;
use App\Models\Docente;
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

//Rutas para Administradores

Route::get('/dashboard/crear_usuario', [AdministradorController::class, 'mostrar_formulario_crear_usuario']);
Route::post('/dashboard/crear_usuario', [AdministradorController::class, 'crear_usuario']);
//Rutas para Coorinadores
Route::get('/dashboard/periodos', [CoordinadorController::class, 'ver_periodos'])
    ->name('sidebar.periodos');
Route::post('/dashboard/periodos', [CoordinadorController::class, 'crear_periodo_academico'])
    ->name('crear_periodo_academico');

Route::get('/dashboard/crear-estudiante', [EstudianteController::class, 'mostrar_plantilla']);
Route::post('/dashboard/crear-estudiante', [EstudianteController::class, 'crear_estudiante']);

Route::get('/dashboard/crear-usuario', [CoordinadorController::class, 'mostrar_formulario_crear_usuario']);
Route::post('/dashboard/crear-usuario', [CoordinadorController::class, 'crear_usuario']);

Route::get('/dashboard/crear-seccion', [CoordinadorController::class, 'mostrarFormularioCrearSeccion'])
    ->name('sidebar.crearseccion');
Route::post('/dashboard/crear-seccion', [CoordinadorController::class, 'crearSeccion']);

Route::get('/dashboard/asignar-carga', [DocenteController::class, 'mostrarFormularioAsignarCarga'])
    ->name('sidebar.formulario_carga_academica');
Route::post('/dashboard/asignar-carga', [DocenteController::class, 'asignarCargaAcademica'])
    ->name('asignar_carga_academica');

Route::get('/dashboard/inscribir-estudiante', [EstudianteController::class, 'mostrarFormularioInscripcion'])
    ->name('sidebar.inscribir');
Route::post('/dashboard/inscribir-estudiante', [EstudianteController::class, 'obtenerSecciones'])
    ->name('obtener_secciones');
Route::post('/dashboard/inscribir_estudiante', [EstudianteController::class, 'inscribirEstudianteEnSeccion'])
    ->name('inscribir_estudiante');

Route::get('/dashboard/modificar_calificacion', [CalificacionController::class, 'mostrar_datos_calificacion'])
    ->name('sidebar.modificar_calificacion');
Route::post('/dashboard/modificar_calificacion', [CalificacionController::class, 'actualizar_calificacion'])
    ->name('modificar_calificacion');

Route::get('/dashboard/dataNotas', [CoordinadorController::class, 'modificarNotas'])->name('sidebar.notas');
Route::get('/dashboard/dataRepresentantes', [CoordinadorController::class, 'modificarRepresentantes'])->name('sidebar.modirepresentantes');
Route::get('/dashboard/dataEstudiantes', [CoordinadorController::class, 'modificarEstudiantes'])->name('sidebar.modiestudiantes');
Route::get('/dashboard/dataDocentes', [CoordinadorController::class, 'modificarDocentes'])->name('sidebar.modidocentes');


Route::get('/dashboard/dataMaterias', [MateriaController::class, 'mostrarMaterias'])->name('sidebar.materias');
Route::post('/dashboard/dataMaterias', [MateriaController::class, 'crear_materia'])->name('sidebar.crearMateria');

Route::put('/dashboard/dataMaterias/{id}', [MateriaController::class, 'editar_materia'])->name('sidebar.editarMateria');
Route::delete('/dashboard/dataMaterias/{id}', [MateriaController::class, 'eliminar_materia'])->name('sidebar.eliminarMateria');

//Rutas para Docentes
Route::get('/dashboard/CargaNotas', [DocenteController::class, 'cargarNotas'])->name('sidebar.CargaNotas');
Route::get('/dashboard/DataSecciones', [DocenteController::class, 'verSecciones'])->name('sidebar.VerSecciones');
Route::get('/dashboard/DataCargaAcademica', [DocenteController::class, 'verCargaAcademica'])->name('sidebar.VerCargaAcademica');

Route::get('/dashboard/cambiar-contrasena', [DocenteController::class, 'showCambiarContrasenaForm'])
    ->name('sidebar.mostrar_cambiar_clave');
Route::post('/dashboard/cambiar-contrasena', [DocenteController::class, 'cambiarContrasenaDocente'])
    ->name('cambiar_clave');

//Rutas para Representantes

Route::get('/dashboard/VerBoletin', [RepresentanteController::class, 'indexBoletin'])->name('boletin.index');
Route::get('/dashboard/VerTodoBoletin', [RepresentanteController::class, 'indexTodoBoletin'])->name('boletin.indexTodo');
Route::get('/dashboard/VerFicha', [RepresentanteController::class, 'verFicha'])->name('Ficha.index');