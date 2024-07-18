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
    // public function mostrarDocentes() 
    // {
    // // Obtener todos los docentes junto con la información del usuario
    // $docentes = Docente::with('user.persona')->get();
    // return view('Paginas.Coordinadores.Profesores', ['docentes' => $docentes]);
    // }

    // public function updateDocente(Request $request, $id)
    // {
    //     $docente = Docente::find($id);

    //     $request->validate([
    //         'primer_nombre' => 'required|string|max:255',
    //         'primer_apellido' => 'required|string|max:255',
    //         'cedula' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //     ]);

    //     $docente->user->persona->primer_nombre = $request->input('primer_nombre');
    //     $docente->user->persona->primer_apellido = $request->input('primer_apellido');
    //     $docente->user->persona->cedula = $request->input('cedula');
    //     $docente->user->email = $request->input('email');
    //     $docente->user->persona->save();
    //     $docente->user->save();

    //     return response()->json(['message' => 'Docente actualizado correctamente', 'docente' => $docente]);
    // }
//-----------------------------------------------------------------------------------------------------------------------
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

        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error al realizar la operación: ' . $e->getMessage(),
            ], 400);
        }
    }

    public function obtenerReporteNotas(Request $request)
    {
        $request->validate([
            'seccion_id' => 'required|integer|exists:secciones,id',
            'periodo_id' => 'required|integer|exists:periodos_academicos,id',
            'materia_id' => 'required|integer|exists:materias,id',
        ]);

        try {
            // Buscar la sección
            $seccion = Seccion::findOrFail($request->seccion_id);

            // Buscar los estudiantes de la sección
            $estudiantesSeccion = EstudianteSeccion::where('seccion_id', $seccion->id)->get();

            if ($estudiantesSeccion->isEmpty()) {
                return response()->json([
                    'error' => 'No hay estudiantes en esta sección.'
                ], 404);
            }

            // Buscar las calificaciones de los estudiantes en la materia y periodo especificados
            $calificaciones = Calificacion::whereIn('estudiante_id', $estudiantesSeccion->pluck('estudiante_id'))
                ->where('docente_materia_id', function ($query) use ($request) {
                    $query->select('id')
                        ->from('docente_materia')
                        ->where('materia_id', $request->materia_id)
                        ->where('periodo_id', $request->periodo_id)
                        ->limit(1);
                })
                ->get();

            if ($calificaciones->isEmpty()) {
                return response()->json([
                    'error' => 'No hay calificaciones para los estudiantes en esta materia y periodo.'
                ], 404);
            }

            // Calcular estadísticas
            $totalEstudiantes = $calificaciones->count();
            $totalAprobados = $calificaciones->filter(function ($calificacion) {
                return $calificacion->promedio >= 10; // Asumiendo que la nota de aprobación es 10
            })->count();

            $totalReprobados = $totalEstudiantes - $totalAprobados;
            $porcentajeAprobados = ($totalAprobados / $totalEstudiantes) * 100;
            $porcentajeReprobados = ($totalReprobados / $totalEstudiantes) * 100;
            $promedioGeneral = $calificaciones->avg('promedio');

            // Retornar el reporte
            return response()->json([
                'total_estudiantes' => $totalEstudiantes,
                'total_aprobados' => $totalAprobados,
                'porcentaje_aprobados' => $porcentajeAprobados,
                'total_reprobados' => $totalReprobados,
                'porcentaje_reprobados' => $porcentajeReprobados,
                'promedio_general' => $promedioGeneral,
                'calificaciones' => $calificaciones,
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error al realizar la operación: ' . $e->getMessage(),
            ], 400);
        }       
    }

    public function formulario_carga_academica()
    {
        $per = Persona::where('categoria_id', 1)->get();

        // Filtrar las personas que tienen rol_id = 3 (docentes)
        $personas = $per->filter(function ($per) {
            return $per->user && $per->user->rol_id === 3;
        });
        $periodos = Periodo_Academico::all();

        return view('Paginas.Coordinadores.reporte_carga_academica', compact('personas', 'periodos'));
    }

    public function obtener_carga_academica(Request $request)
    {
        $request->validate([
            'persona_id' => 'required|integer|exists:personas,id',
            'periodo_id' => 'required|integer|exists:periodos_academicos,id',
        ]);

        try {
            $persona = Persona::findOrFail($request->persona_id);
            $usuario = $persona->user;
            $docente = $usuario->docente;
            // Buscar las materias asignadas al docente en el período especificado
            $materias = DocenteMateria::where('docente_id', $docente->id)
                ->where('periodo_id', $request->periodo_id)
                ->with('materia')
                ->get()
                ->pluck('materia');

            // Retornar la información de las materias
            return response()->json([
                'materias' => $materias,
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error al realizar la operación: ' . $e->getMessage(),
            ], 400);
        }
    }
    
}