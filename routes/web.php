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

//rutas de vistas para los coordinadores, aun falta añadir la de secciones y creo que otra pero aun no se ha añadido


// Ruta para mostrar el formulario de creación de periodo académico
Route::get('/dashboard/periodos', [CoordinadorController::class, 'ver_periodos'])
            ->name('sidebar.periodos');
//Ruta para crear periodo y sus vinculaciones
Route::post('/dashboard/periodos', [CoordinadorController::class, 'crear_periodo_academico'])
            ->name('crear_periodo_academico');

Route::get('/dashboard/crear-estudiante', [EstudianteController::class, 'mostrar_plantilla']);
Route::post('/dashboard/crear-estudiante', [EstudianteController::class, 'crear_estudiante']);

Route::get('/dashboard/crear-usuario', [CoordinadorController::class, 'mostrar_formulario_crear_usuario']);
Route::post('/dashboard/crear-usuario', [CoordinadorController::class, 'crear_usuario']);

Route::get('/dashboard/crear_usuario', [AdministradorController::class, 'mostrar_formulario_crear_usuario']);
Route::post('/dashboard/crear_usuario', [AdministradorController::class, 'crear_usuario']);

//Rutas para gestionar coordinadores

Route::get('/dashboard/crear-seccion', [CoordinadorController::class, 'mostrarFormularioCrearSeccion'])->name('sidebar.crearseccion');
Route::post('/dashboard/crear-seccion', [CoordinadorController::class, 'crearSeccion']);
Route::get('/dashboard/dataNotas', [CoordinadorController::class, 'modificarNotas'])->name('sidebar.notas');
Route::get('/dashboard/dataRepresentantes', [CoordinadorController::class, 'modificarRepresentantes'])->name('sidebar.modirepresentantes');
Route::get('/dashboard/dataEstudiantes', [CoordinadorController::class, 'modificarEstudiantes'])->name('sidebar.modiestudiantes');
Route::get('/dashboard/dataDocentes', [CoordinadorController::class, 'modificarDocentes'])->name('sidebar.modidocentes');


//rutas para la edición y creación de materias (coordinador)
Route::get('/dashboard/dataMaterias', [MateriaController::class, 'mostrarMaterias'])->name('sidebar.materias');
Route::post('/dashboard/dataMaterias', [MateriaController::class, 'crear_materia'])->name('sidebar.crearMateria');
<<<<<<< HEAD
=======
<<<<<<< HEAD
//nuevas rutas
>>>>>>> 49079d1613083e295c239f531613a09ac24d8881
Route::put('/dashboard/dataMaterias/{id}', [MateriaController::class, 'editar_materia'])->name('sidebar.editarMateria');
Route::delete('/dashboard/dataMaterias/{id}', [MateriaController::class, 'eliminar_materia'])->name('sidebar.eliminarMateria');
=======
Route::put('/dashboard/dataMaterias/{id}', [MateriaController::class, 'editar_materia'])->name('sidebar.editarMateria');
Route::delete('/dashboard/dataMaterias/{id}', [MateriaController::class, 'eliminar_materia'])->name('sidebar.eliminarMateria');


>>>>>>> migue2




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



//ruta de vistas para los docentes
Route::get('/dashboard/CargaNotas', [DocenteController::class, 'cargarNotas'])->name('sidebar.CargaNotas');
Route::get('/dashboard/DataSecciones', [DocenteController::class, 'verSecciones'])->name('sidebar.VerSecciones');
Route::get('/dashboard/DataCargaAcademica', [DocenteController::class, 'verCargaAcademica'])->name('sidebar.VerCargaAcademica');

Route::get('/dashboard/cambiar-contrasena', [DocenteController::class, 'showCambiarContrasenaForm'])
    ->name('sidebar.mostrar_cambiar_clave');
Route::post('/dashboard/cambiar-contrasena', [DocenteController::class, 'cambiarContrasenaDocente'])
    ->name('cambiar_clave');




//Ruta de vistas para los representantes 
Route::get('/dashboard/VerBoletin', [RepresentanteController::class, 'indexBoletin'])->name('boletin.index');
Route::get('/dashboard/VerTodoBoletin', [RepresentanteController::class, 'indexTodoBoletin'])->name('boletin.indexTodo');
Route::get('/dashboard/VerFicha', [RepresentanteController::class, 'verFicha'])->name('Ficha.index');





//Route::post('/usuarios', [CoordinadorController::class, 'crear_usuario']);
//Route::post('/periodos-academicos', [CoordinadorController::class, 'crear_periodo_academico']);
//Route::post('/coordinador/Crear_periodo_academico', [CoordinadorController::class, 'crear_periodo_academico'])
//    ->name('coordinador.crear.periodo.academico');
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