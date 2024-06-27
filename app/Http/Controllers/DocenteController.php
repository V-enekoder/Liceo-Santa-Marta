<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocenteController extends Controller
{
    function cargarNotas(){

        return view('Paginas.Docentes.carga_notas',);
    }
    function verSecciones(){

        return view('Paginas.Docentes.gestion_secciones',);
    }
    function verCargaAcademica(){

        return view('Paginas.Docentes.reporte_carga_academica',);
    }



}
