<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class CoordinadorController extends Controller
{
    function crearPeriodos(){
        Gate::authorize('crear_periodos');
        return view('Paginas.Coordinadores.Crear_periodo_academico',);
    }
    function modificarNotas(){
        Gate::authorize('modificar_notas');
        return view('Paginas.Coordinadores.modificacion_notas',);
    }
    function modificarRepresentantes(){
        Gate::authorize('modificar_representante');
        return view('Paginas.Coordinadores.modificacion_representantes',);
    }
    function modificarEstudiantes(){
        Gate::authorize('modificar_estudiante');
        return view('Paginas.Coordinadores.modificacion_estudiantes',);
    }
    function modificarDocentes(){
        Gate::authorize('modificar_docente');
        return view('Paginas.Coordinadores.Profesores',);
    }
    function modificarMaterias(){
            Gate::authorize('modificar_materias');
        return view('Paginas.Coordinadores.Materias',);
    }
    function crearCargaAcademica(){
        return view('Paginas.Coordinadores.Carga_academica',);
    }

}
