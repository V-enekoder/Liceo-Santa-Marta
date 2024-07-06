<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoordinadorController extends Controller
{
    function crearPeriodos(){

        return view('Paginas.Coordinadores.Crear_periodo_academico',);
    }
    function modificarNotas(){

        return view('Paginas.Coordinadores.modificacion_notas',);
    }
    function modificarRepresentantes(){

        return view('Paginas.Coordinadores.modificacion_representantes',);
    }
    function modificarEstudiantes(){

        return view('Paginas.Coordinadores.modificacion_estudiantes',);
    }
    function modificarDocentes(){

        return view('Paginas.Coordinadores.Profesores',);
    }
    function modificarMaterias(){

        return view('Paginas.Coordinadores.Materias',);
    }
    function crearCargaAcademica(){
        return view('Paginas.Coordinadores.Carga_academica',);
    }

}
