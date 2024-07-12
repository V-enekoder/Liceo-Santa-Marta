<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Docente;
use App\Models\DocenteMateria;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DocenteController extends Controller
{
    function cargarNotas(){
        //Gate::authorize('cargar_notas');
        return view('Paginas.Docentes.carga_notas',);
    }
    function verSecciones(){
        //Gate::authorize('ver_secciones');
        return view('Paginas.Docentes.gestion_secciones',);
    }
    function verCargaAcademica(){
        //Gate::authorize('ver_carga_academica');
        return view('Paginas.Docentes.reporte_carga_academica',);
    }

    public function obtenerMateriasPorDocenteYPeriodo(Request $request)
    {
        $request->validate([
            'docente_id' => 'required|integer|exists:docentes,id',
            'periodo_id' => 'required|integer|exists:periodos_academicos,id',
        ]);

        try {
            // Buscar las materias asignadas al docente en el período especificado
            $materias = DocenteMateria::where('docente_id', $request->docente_id)
                ->where('periodo_id', $request->periodo_id)
                ->with('materia')
                ->get()
                ->pluck('materia');

            // Retornar la información de las materias
            return response()->json([
                'materias' => $materias,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al realizar la operación: ' . $e->getMessage(),
            ], 400);
        }
    }


    public function cambiarContrasenaDocente(Request $request)
    {
        $request->validate([
            'docente_id' => 'required|integer|exists:docentes,id',
            'nueva_contrasena' => 'required|string|min:8|confirmed',
        ]);

        try {
            // Buscar el docente por su ID
            $docente = Docente::findOrFail($request->docente_id);

            // Buscar el usuario asociado al docente
            $usuario = User::findOrFail($docente->user_id);

            // Cambiar la contraseña del usuario
            $usuario->password = Hash::make($request->nueva_contrasena);

            // Guardar los cambios
            $usuario->save();

            return response()->json([
                'message' => 'Contraseña actualizada exitosamente.',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al realizar la operación: ' . $e->getMessage(),
            ], 400);
        }
    }


}
