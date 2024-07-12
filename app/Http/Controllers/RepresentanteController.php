<?php

namespace App\Http\Controllers;
use App\Models\Calificacion;
use App\Models\Estudiante;
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

public function agregarTelefono(Request $request)
{
    try {
        // Validación de los datos de entrada
        $request->validate([
            'cedula' => 'required|integer',
            'numero_telefonico' => 'required|string|max:255'
        ]);

        // Buscar al usuario por su número de cédula
        $user = User::where('cedula', $request->cedula)->firstOrFail();

        // Crear el registro de teléfono para el usuario encontrado
        $telefono = new Telefono([
            'numero_telefonico' => $request->numero_telefonico
        ]);

        // Asignar el usuario al teléfono
        $telefono->user()->associate($user);
        $telefono->save();

        return response()->json(['message' => 'Teléfono añadido correctamente'], 201);

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => 'Usuario no encontrado'], 404);

    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al agregar teléfono: ' . $e->getMessage()], 400);
    }
}


    public function obtenerCalificacionesEstudiante(Request $request)
    {
        $request->validate([
            'cedula_estudiante' => 'required|integer',
        ]);

        try {
            // Buscar al estudiante por su cédula
            $estudiante = Estudiante::where('cedula', $request->cedula_estudiante)->firstOrFail();

            // Buscar todas las calificaciones del estudiante
            $calificaciones = Calificacion::where('estudiante_id', $estudiante->id)
                ->with('docenteMateria')
                ->get();

            // Retornar la información de las calificaciones
            return response()->json([
                'calificaciones' => $calificaciones,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al realizar la operación: ' . $e->getMessage(),
            ], 400);
        }
    }



}
