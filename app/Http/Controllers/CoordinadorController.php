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
use App\Models\Persona;
use Exception;


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