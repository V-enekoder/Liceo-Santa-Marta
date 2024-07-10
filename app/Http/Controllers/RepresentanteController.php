<?php

namespace App\Http\Controllers;

use App\Models\Telefono;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RepresentanteController extends Controller{
    function indexBoletin(){
        //Gate::authorize('ver_boletin');
        return view('Paginas.Representantes.boletin_notas_actual',);
    }
    function indexTodoBoletin(){
        //Gate::authorize('ver_boletin');
        return view('Paginas.Representantes.notas_finales');
    }
    function verFicha(){
        //Gate::authorize('ver_ficha');
        return view('Paginas.Representantes.Ficha_estudiante');
    }

    public function agregar_telefono(Request $request){
        // Validación de los datos de entrada
        $request->validate([
            'cedula' => 'required|integer',
            'numero_telefonico' => 'required|string|max:255'
        ]);

        // Buscar al usuario por su número de cédula
        $user = User::where('cedula', $request->cedula)->first();

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        // Crear el registro de teléfono para el usuario encontrado
        $telefono = new Telefono([
            'numero_telefonico' => $request->numero_telefonico
        ]);

        // Asignar el usuario al teléfono
        $telefono->user()->associate($user);
        $telefono->save();

        return response()->json(['message' => 'Teléfono añadido correctamente'], 201);
    }

}
