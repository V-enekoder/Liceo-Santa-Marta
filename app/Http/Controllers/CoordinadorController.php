<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Representante;
use App\Models\Docente;
use Illuminate\Support\Facades\Hash;

class CoordinadorController extends Controller{
    function crearPeriodos(){
        //Gate::authorize('crear_periodos');
        return view('Paginas.Coordinadores.Crear_periodo_academico',);
    }
    function modificarNotas(){
        //Gate::authorize('modificar_notas');
        return view('Paginas.Coordinadores.modificacion_notas',);
    }
    function modificarRepresentantes(){
        //Gate::authorize('modificar_representante');
        return view('Paginas.Coordinadores.modificacion_representantes',);
    }
    function modificarEstudiantes(){
        //Gate::authorize('modificar_estudiante');
        return view('Paginas.Coordinadores.modificacion_estudiantes',);
    }
    function modificarDocentes(){
        //Gate::authorize('modificar_docente');
        return view('Paginas.Coordinadores.Profesores',);
    }
    function modificarMaterias(){
        //Gate::authorize('modificar_materias');
        return view('Paginas.Coordinadores.Materias',);
    }
    function crearCargaAcademica(){
        return view('Paginas.Coordinadores.Carga_academica',);
    }

    public function crear_usuario/*createUser*/(Request $request){
        $validatedData = $request->validate([
            'cedula' => 'required|integer|unique:users',
            'rol_id' => 'required|integer|exists:roles,id',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'direccion' => 'nullable|string|max:255',
            'activo' => 'boolean',
            'current_team_id' => 'nullable|integer|exists:teams,id',
            'profile_photo_path' => 'nullable|string|max:2048'
        ]);

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
            'current_team_id' => $validatedData['current_team_id'],
            'profile_photo_path' => $validatedData['profile_photo_path']
        ]);

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
    }

}
