<?php

namespace App\Http\Controllers;

use App\Models\Telefono;
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
<<<<<<< HEAD
=======

>>>>>>> 0be567e2c67ea4c44e5a9fc107b712588ae2f385
    function indexTelefonos(){
        $telefonos= Telefono::all();
        return view('Paginas.Representantes.telefonos_representantes',compact('telefonos'));
    }
    
}
