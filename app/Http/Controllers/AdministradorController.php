<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Docente;
use App\Models\Representante;
use App\Models\Rol;
use App\Models\Coordinador;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    public function mostrar_formulario_crear_usuario()
    {
        // Filtrar roles con id 3 y 4
        $roles = Rol::whereIn('id', [2,3, 4])->get();
        return view('Paginas.Coordinadores.crear_usuario', compact('roles'));
    }

    public function crear_usuario(Request $request)
    {
        $validatedData = $request->validate([
            'cedula' => 'required|integer|unique:users',
            'rol_id' => 'required|integer|exists:roles,id',
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            'password' => 'nullable|string|min:8|confirmed',
            'direccion' => 'nullable|string|max:255',
            'activo' => 'boolean',
        ]);

        // Crear usuario
        $user = User::create([
            'cedula' => $validatedData['cedula'],
            'rol_id' => $validatedData['rol_id'],
            'primer_nombre' => $validatedData['primer_nombre'],
            'segundo_nombre' => $validatedData['segundo_nombre'],
            'primer_apellido' => $validatedData['primer_apellido'],
            'segundo_apellido' => $validatedData['segundo_apellido'],
            'email' => $validatedData['email'],
            'password' => isset($validatedData['password']) ? Hash::make($validatedData['password']) : null,
            'direccion' => $validatedData['direccion'],
            'activo' => true,
        ]);

        if($user->rol_id == 2){
            Coordinador::create([
                'user_id' => $user->id,
                'fecha_ingreso' => now() // Fecha actual como fecha de ingreso
            ]);
        }

        if ($user->rol_id == 3) {
            Docente::create([
                'user_id' => $user->id
            ]);
        }

        if ($user->rol_id == 4) {
            Representante::create([
                'user_id' => $user->id
            ]);
        }

        return response()->json(['user' => $user], 201);
    }
        //Gestionar usuarios
}
