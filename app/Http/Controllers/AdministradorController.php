<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Docente;
use App\Models\Representante;
use App\Models\Coordinador;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    function crear_coordinador(){
        //Gate::authorize('crear_coordinador');
        //return view('Paginas.Administradores.crear_coordinador',);
    }

public function crear_usuario(Request $request)
{
    $validatedData = $request->validate([
        'cedula' => 'required|integer|unique:users',
        'rol_id' => 'required|integer|exists:roles,id',
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'direccion' => 'nullable|string|max:255',
        'activo' => 'boolean',
        //'current_team_id' => 'nullable|integer|exists:teams,id',
        //'profile_photo_path' => 'nullable|string|max:2048'
    ]);

    try {
        // Crear usuario
        $user = User::create([
            'cedula' => $validatedData['cedula'],
            'rol_id' => $validatedData['rol_id'],
            'nombre' => $validatedData['nombre'],
            'apellido' => $validatedData['apellido'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'direccion' => $validatedData['direccion'],
            'activo' => $validatedData['activo'] ?? true,
            //'current_team_id' => $validatedData['current_team_id'],
            //'profile_photo_path' => $validatedData['profile_photo_path']
        ]);
        
        if ($user->rol_id == 2) {
            $coordinador = Coordinador::create([
                'user_id' => $user->id,
                'fecha_ingreso' => now(),
                'fecha_retiro' => null
            ]);
        }


        // Si el rol_id es 3, crear docente
        if ($user->rol_id == 3) {
            $docente = Docente::create([
                'user_id' => $user->id
            ]);
        }

        // Si el rol_id es 4, crear representante
        if ($user->rol_id == 4) {
            $representante = Representante::create([
                'user_id' => $user->id
            ]);
        }

        

        return response()->json(['user' => $user], 201);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al crear el usuario: ' . $e->getMessage()], 400);
    }
}


}
