<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Calificacion;
use App\Models\Coordinador;
use App\Models\CoordinadorPeriodo;
use App\Models\User;
use App\Models\Representante;
use App\Models\Docente;
use App\Models\Periodo_Academico;
use App\Models\Estudiante;
use App\Models\Seccion;
use App\Models\GradoPeriodo;
use App\Models\Materia;
use App\Models\DocenteMateria;
use App\Models\EstudianteMateria;
use App\Models\EstudianteRepresentante;
use App\Models\EstudianteSeccion;
use App\Models\Grado;
use App\Models\Rol;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;



class CoordinadorController extends Controller{

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
//-----------------------------------------------------------------------------------------------------------------------
    public function modificarDocentes(){
        return view('Paginas.Coordinadores.Profesores',);
    }
//-------------------------------------------------------------------------------------------------------
    function modificarMaterias(){
        //Gate::authorize('modificar_materias');
        return view('Paginas.Coordinadores.Materias',);
        
    }
    
/**
 * TODO comprobar funcionamiento
 */

    public function mostrar_carga_academica(Request $request)
    {
        $request->validate([
            'cedula_docente' => 'required|integer',
            'periodo_id' => 'required|integer|exists:periodos_academicos,id',
        ]);

        try {
            // Buscar al docente por su cédula
            $user = User::where('cedula', $request->cedula_docente)->firstOrFail();
            $docente = Docente::where('user_id', $user->id)->firstOrFail();

            // Buscar las materias asignadas al docente en el período especificado
            $materiasAsignadas = Materia::whereHas('docentes', function ($query) use ($docente, $request) {
                $query->where('docente_id', $docente->id)
                ->where('periodo_id', $request->periodo_id);
                })
                ->with('docentes')
                ->get();

            // Retornar la información del docente y las materias asignadas
            return response()->json([
                'docente' => $docente,
                'materias' => $materiasAsignadas,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al realizar la operación: ' . $e->getMessage(),
            ], 400);
        }
    }

    public function obtenerSeccionesDisponibles(Request $request)
    {
        $request->validate([
            'grado_id' => 'required|integer|exists:grados,id',
            'periodo_id' => 'required|integer|exists:periodos_academicos,id',
        ]);

        try {
            // Buscar el grado y periodo en la tabla grado_periodo
            $gradoPeriodo = GradoPeriodo::where('grado_id', $request->grado_id)
                ->where('periodo_id', $request->periodo_id)
                ->firstOrFail();

            // Buscar las secciones asociadas a ese grado y periodo
            $secciones = Seccion::where('grado_periodo_id', $gradoPeriodo->id)->get();

            // Retornar las secciones disponibles
            return response()->json([
                'secciones' => $secciones,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al realizar la operación: ' . $e->getMessage(),
            ], 400);
        }
    }

    public function crearCalificaciones(Request $request)
    {
        $request->validate([
            'seccion_id' => 'required|integer|exists:secciones,id',
            'cedula_estudiante' => 'required|integer|exists:estudiantes,cedula',
        ]);

        try {
            // Buscar al estudiante por su cédula
            $estudiante = Estudiante::where('cedula', $request->cedula_estudiante)->firstOrFail();

            // Buscar la sección por su ID
            $seccion = Seccion::findOrFail($request->seccion_id);

            // Buscar el grado y el periodo en la tabla grado_periodo
            $gradoPeriodo = GradoPeriodo::findOrFail($seccion->grado_periodo_id);
            $gradoId = $gradoPeriodo->grado_id;
            $periodoId = $gradoPeriodo->periodo_id;

            // Buscar todas las materias correspondientes a ese grado
            $materias = Materia::where('grado_id', $gradoId)->get();

            // Para cada materia, buscar el docente correspondiente en el periodo actual
            foreach ($materias as $materia) {
                $docenteMateria = DocenteMateria::where('materia_id', $materia->id)
                                ->where('periodo_id', $periodoId)
                                ->first();

                if ($docenteMateria) {
                    // Crear la calificación del estudiante para esa materia
                    Calificacion::create([
                        'docente_materia_id' => $docenteMateria->id,
                        'estudiante_id' => $estudiante->id,
                        'lapso_1' => 0,
                        'lapso_2' => 0,
                        'lapso_3' => 0,
                        'promedio' => 0,
                    ]);
                }
            }

            return response()->json([
                'message' => 'Calificaciones creadas exitosamente.',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al realizar la operación: ' . $e->getMessage(),
            ], 400);
        }
    }
    
}