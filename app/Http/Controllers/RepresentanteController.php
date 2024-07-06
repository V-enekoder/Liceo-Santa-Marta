<?php

namespace App\Http\Controllers;

use App\Models\Telefono;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class RepresentanteController extends Controller
{
    function indexBoletin(){
        Gate::authorize('ver_boletin');
        return view('Paginas.Representantes.boletin_notas_actual',);
    }
    function indexTodoBoletin(){
        Gate::authorize('ver_boletin');
        return view('Paginas.Representantes.notas_finales');
    }
    function verFicha(){
        Gate::authorize('ver_ficha');
        return view('Paginas.Representantes.Ficha_estudiante');
    }
}
