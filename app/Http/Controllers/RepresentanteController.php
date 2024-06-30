<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepresentanteController extends Controller
{
    function indexBoletin(){
        return view('Paginas.Representantes.boletin_notas_actual',);
    }
    function indexTodoBoletin(){
        return view('Paginas.Representantes.notas_finales');
    }
    function verFicha(){
        return view('Paginas.Representantes.Ficha_estudiante');
    }

    function indexTelefonos(){
        return view('Paginas.Representantes.telefonos');
    }
}
