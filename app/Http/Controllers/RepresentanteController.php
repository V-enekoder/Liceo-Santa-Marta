<?php

namespace App\Http\Controllers;
use App\Models\Calificacion;
use App\Models\Estudiante;
use App\Models\EstudianteRepresentante;
use App\Models\Periodo_Academico;
use App\Models\Representante;
use App\Models\Telefono;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RepresentanteController extends Controller{
    function mostrar_boletin(){
        //Gate::authorize('ver_boletin');
        $user = Auth::user();
        $representante = Representante::where('user_id', $user->id)->first();
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

    public function formulario_agregar_telefono()
    {
        $user = Auth::user();
        return view('Paginas.Representantes.agregar_telefono', compact('user'));
    }

    public function obtener_boletín_actual(Request $request)
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
    public function eliminarRepresentante(Request $request)
    {
        $request->validate([
            'cedula_representante' => 'required|integer',
            'cedula_estudiante' => 'required|integer',
            'periodo_id' => 'required|integer|exists:periodos_academicos,id',
        ]);

        try {
            // Buscar el representante por su cédula
            $user = User::where('cedula', $request->cedula_representante)
                ->where('rol_id', 4)
                ->firstOrFail();
            $representante = Representante::where('user_id', $user->id)->firstOrFail();

            // Buscar el estudiante por su cédula
            $estudiante = Estudiante::where('cedula', $request->cedula_estudiante)->firstOrFail();

            // Buscar el registro en la tabla intermedia
            $registro = EstudianteRepresentante::where('estudiante_id', $estudiante->id)
                                                ->where('representante_id', $representante->id)
                                                ->where('periodo_id', $request->periodo_id)
                                                ->first();

            if (!$registro) {
                return response()->json([
                    'error' => 'No se encontró el registro para el estudiante, representante y período proporcionados.'
                ], 404);
            }

            // Verificar si el estudiante tiene otros representantes en el mismo período
            $otrosRepresentantes = EstudianteRepresentante::where('estudiante_id', $estudiante->id)
                ->where('periodo_id', $request->periodo_id)
                ->where('representante_id', '!=', $representante->id)
                ->count();
            
            /**
             * TODO Comprobar los efectos de la eliminación en cascada
             */
            if ($otrosRepresentantes > 0) {
                // Eliminar el registro
                $registro->delete();
                $representante->delete();
                $user->delete();

                return response()->json([
                    'message' => 'El representante ha sido eliminado exitosamente del período académico para este estudiante.'
                ], 200);
            } else {
                return response()->json([
                    'error' => 'No se puede eliminar al representante porque el estudiante no tiene otros representantes en este período.'
                ], 400);
            }

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al realizar la operación: ' . $e->getMessage(),
            ], 400);
        }
    }
    
    public function mostrarRepresentantePorCedula($cedula)
    {
        try {
            // Buscar al representante por su cédula y rol de representante (rol_id = 4)
            $representante = User::where('cedula', $cedula)
                                ->where('rol_id', 4)
                                ->firstOrFail();

            // Retornar los datos del representante en formato JSON
            return response()->json([
                'representante' => $representante
            ], 200);
        } catch (\Exception $e) {
            // Manejar el error si no se encuentra el representante
            return response()->json([
                'error' => 'No se encontró al representante con la cédula proporcionada.'
            ], 404);
        }
    }

    public function formulario_vincular()
    {
        // Obtener todos los períodos académicos
        $periodos = Periodo_Academico::all();

        // Retornar la vista con los períodos académicos
        return view('Paginas.Coordinadores.vincular_representante', compact('periodos'));
    }
    public function vincular_estudiante_representante(Request $request)
    {
        $request->validate([
            'cedula_representante' => 'required|integer',
            'cedula_estudiante' => 'required|integer',
            'periodo_id' => 'required|integer|exists:periodos_academicos,id',
        ]);

        try {
            // Buscar el representante por su cédula
            $user = User::where('cedula', $request->cedula_representante)
                ->where('rol_id', 4)
                ->firstOrFail();
            $representante = Representante::where('user_id', $user->id)->firstOrFail();

            // Buscar el estudiante por su cédula
            $estudiante = Estudiante::where('cedula', $request->cedula_estudiante)->firstOrFail();

            // Vincular al estudiante y representante en el período académico
            $estudianteRepresentante = EstudianteRepresentante::create([
                'estudiante_id' => $estudiante->id,
                'representante_id' => $representante->id,
                'periodo_id' => $request->periodo_id,
            ]);

            return response()->json([
                'message' => 'Estudiante y representante vinculados exitosamente.',
                'data' => $estudianteRepresentante,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al vincular el estudiante y representante: ' . $e->getMessage(),
            ], 400);
        }
    }
}
