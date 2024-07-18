<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\CoordinadorController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\RepresentanteController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\SeccionController;
use App\Http\Controllers\TelefonoController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\Materia;
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
        $user = Auth::user();
        return view('dashboard', compact('user'));
    })->name('dashboard');
});

//Rutas para Administradores

//Rutas para Coorinadores
Route::get('/dashboard/periodos', [PeriodoController::class, 'ver_periodos'])
    ->name('sidebar.periodos');
Route::post('/dashboard/periodos', [PeriodoController::class, 'crear_periodo_academico'])
    ->name('crear_periodo_academico');

Route::get('/dashboard/crear_persona', [PersonaController::class, 'mostrar_formulario_crear_usuario'])
    ->name('sidebar.crearpersona');
Route::post('/dashboard/crear_persona', [PersonaController::class, 'crear']);

Route::get('/dashboard/crear-seccion', [SeccionController::class, 'mostrarFormularioCrearSeccion'])
    ->name('sidebar.crearseccion');
Route::post('/dashboard/crear-seccion', [SeccionController::class, 'crearSeccion']);

Route::get('/dashboard/dataNotas', [CoordinadorController::class, 'modificarNotas'])->name('sidebar.notas');
Route::get('/dashboard/dataRepresentantes', [CoordinadorController::class, 'modificarRepresentantes'])->name('sidebar.modirepresentantes');
Route::get('/dashboard/dataEstudiantes', [CoordinadorController::class, 'modificarEstudiantes'])->name('sidebar.modiestudiantes');



//Rutas para la edicion de docentes (coordinador)
Route::get('/dashboard/dataDocentes', [DocenteController::class, 'mostrarDocentes'])->name('sidebar.modidocentes');
Route::put('/dashboard/dataDocentes/{id}', [DocenteController::class, 'updateDocente'])->name('sidebar.updateDocente');


//rutas para la edición y creación de materias (coordinador)
Route::get('/dashboard/dataMaterias', [MateriaController::class, 'mostrarMaterias'])->name('sidebar.materias');
Route::post('/dashboard/dataMaterias', [MateriaController::class, 'crear_materia'])->name('sidebar.crearMateria');
Route::put('/dashboard/dataMaterias/{id}', [MateriaController::class, 'editar_materia'])->name('sidebar.editarMateria');
Route::delete('/dashboard/dataMaterias/{id}', [MateriaController::class, 'eliminar_materia'])->name('sidebar.eliminarMateria');





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

Route::get('/dashboard/buscar-estudiante', [EstudianteController::class, 'formulario_buscar'])
    ->name('sidebar.buscar_estudiante');

Route::get('/dashboard/buscar-estudiante', [EstudianteController::class, 'buscar_estudiante'])
    ->name('buscar_estudiante');

Route::get('/dashboard/modificar_calificacion', [CalificacionController::class, 'mostrar_datos_calificacion'])
    ->name('sidebar.modificar_calificacion');
Route::post('/dashboard/modificar_calificacion', [CalificacionController::class, 'actualizar_calificacion'])
    ->name('modificar_calificacion');

Route::get('/dashboard/docentes', [DocenteController::class, 'mostrarTodosLosDocentes'])
    ->name('docentes.index');
Route::get('/dashboard/docentes/buscar', [DocenteController::class, 'mostrarTodosLosDocentes'])
    ->name('docentes.buscar');

Route::get('/dashboard/dataNotas', [CoordinadorController::class, 'modificarNotas'])->name('sidebar.notas');
Route::get('/dashboard/dataRepresentantes', [CoordinadorController::class, 'modificarRepresentantes'])->name('sidebar.modirepresentantes');
Route::get('/dashboard/dataEstudiantes', [CoordinadorController::class, 'modificarEstudiantes'])->name('sidebar.modiestudiantes');



Route::get('/dashboard/dataMaterias', [MateriaController::class, 'mostrarMaterias'])
    ->name('sidebar.materias');
Route::post('/dashboard/dataMaterias', [MateriaController::class, 'crear_materia'])
    ->name('sidebar.crearMateria');

Route::put('/dashboard/dataMaterias/{id}', [MateriaController::class, 'editar_materia'])
    ->name('sidebar.editarMateria');
Route::delete('/dashboard/dataMaterias/{id}', [MateriaController::class, 'eliminar_materia'])
    ->name('sidebar.eliminarMateria');

Route::get('/dashboard/vincular_representante',[RepresentanteController::class,'formulario_vincular'])
    ->name('sidebar.vincular_representante');
Route::post('/dashboard/vincular_representante',[RepresentanteController::class,'vincular_estudiante_representante'])
    ->name('vincular_representante');
Route::get('/dashboard/reporte-notas', [SeccionController::class, 'obtenerReporteNotas'])
    ->name('reporte-notas');


Route::get('/dashboard/reporte_carga_academica', [CoordinadorController::class, 'formulario_carga_academica'])  
    ->name('sidebar.reporte_carga_academica');
Route::post('/dashboard/reporte_carga_academica', [CoordinadorController::class, 'obtener_carga_academica'])
    ->name('carga_academica.obtener');


//Rutas para Docentes
Route::get('/dashboard/CargaNotas', [DocenteController::class, 'cargarNotas'])->name('sidebar.CargaNotas');
Route::get('/dashboard/DataSecciones', [DocenteController::class, 'verSecciones'])->name('sidebar.VerSecciones');
Route::get('/dashboard/DataCargaAcademica', [DocenteController::class, 'verCargaAcademica'])->name('sidebar.VerCargaAcademica');

Route::get('/dashboard/cambiar-contrasena', [DocenteController::class, 'showCambiarContrasenaForm'])
    ->name('sidebar.mostrar_cambiar_clave');
Route::post('/dashboard/cambiar-contrasena', [DocenteController::class, 'cambiarContrasenaDocente'])
    ->name('cambiar_clave');

//Rutas para Representantes

Route::get('/dashboard/VerBoletin', [RepresentanteController::class, 'mostrar_boletin'])->name('sidebar.mostrar_boletin');
Route::get('/dashboard/VerTodoBoletin', [RepresentanteController::class, 'indexTodoBoletin'])->name('boletin.indexTodo');
Route::get('/dashboard/VerFicha', [RepresentanteController::class, 'verFicha'])->name('Ficha.index');

Route::get('/dashboard/agregar_telefono', [TelefonoController::class, 'formulario_agregar_telefono'])
    ->name('sidebar.agregar_telefono');
Route::post('/dashboard/agregar_telefono', [TelefonoController::class, 'agregarTelefono']);

Route::get('/verficha/{cedula}',[EstudianteController::class, 'verFicha']);
