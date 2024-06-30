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

    function indexTelefonos(){
        $telefonos= Telefono::all();
        return view('Paginas.Representantes.telefonos',compact('telefonos'));
    }
    
=======
>>>>>>> cdb9dafc39b4551d0a6b704eac2399c0f9067d55
}
