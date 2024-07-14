<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Docente;
use App\Models\DocenteMateria;
use App\Models\Grado;
use App\Models\Materia;
use App\Models\Periodo_Academico;
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

    public function showCambiarContrasenaForm()
    {
        return view('Paginas.Docentes.cambiar_contrasena_docente');
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

    public function mostrarFormularioAsignarCarga()
    {
        // Obtener todas las materias disponibles
        $materias = Materia::all();

        // Obtener todos los periodos académicos disponibles
        $periodosAcademicos = Periodo_Academico::all();

        // Obtener los usuarios cuyo rol_id es 3 (docentes)
        $docentes = User::where('rol_id', 3)->get();

        // Obtener los grados con sus materias
        $grados = Grado::with('materias')->get();

        return view('Paginas.Coordinadores.Carga_academica', compact('materias', 'periodosAcademicos', 'docentes', 'grados'));
    }


    public function asignarCargaAcademica(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'docente_id' => 'required|integer|exists:users,id',
            'materias' => 'required|array',
            'materias.*' => 'integer|exists:materias,id',
            'periodo_id' => 'required|integer|exists:periodos_academicos,id',
        ]);

        try {
            // Buscar al docente por su user_id en la tabla users
            $docente = Docente::where('user_id', $request->docente_id)->first();

            // Verificar si se encontró un docente
            if (!$docente) {
                throw new \Exception('No se encontró un docente asociado al usuario.', 404);
            }

            // Asignar las materias al docente en el periodo académico actual
            foreach ($request->materias as $materiaId) {
                // Verificar si ya existe la asignación docente-materia en el periodo actual
                $existeAsignacion = $docente->materias()
                    ->where('materia_id', $materiaId)
                    ->where('periodo_id', $request->periodo_id)
                    ->exists();

                if (!$existeAsignacion) {
                    // Crear el registro en la tabla docente_materia
                    $docente->materias()->attach($materiaId, ['periodo_id' => $request->periodo_id]);
                }
            }

            return redirect()->route('sidebar.formulario_carga_academica')
                ->with('success', 'Carga académica asignada correctamente al docente');

        } catch (\Exception $e) {
            return redirect()->route('sidebar.formulario_carga_academica')
                ->with('error', 'Error al asignar la carga académica: ' . $e->getMessage());
        }
    }

}
