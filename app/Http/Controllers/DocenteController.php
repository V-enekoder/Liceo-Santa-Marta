<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class DocenteController extends Controller
{
    function cargarNotas(){
        Gate::authorize('cargar_notas');
        return view('Paginas.Docentes.carga_notas',);
    }
    function verSecciones(){
        Gate::authorize('ver_secciones');
        return view('Paginas.Docentes.gestion_secciones',);
    }
    function verCargaAcademica(){
        Gate::authorize('ver_carga_academica');
        return view('Paginas.Docentes.reporte_carga_academica',);
    }



}
