<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Representante;
use App\Models\Telefono;

class TelefonosController extends Controller
{
    public function index(){
        $telefonos = Telefono::all();
        return view('telefonos', compact('telefonos'));
    }
}
