<?php

namespace App\Http\Controllers;
use App\Models\Grado;
use App\Models\Periodo_Academico;
use App\Models\GradoPeriodo;
use App\Models\Seccion;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\EstudianteSeccion;
use Exception;
use App\Models\Calificacion;
use App\Models\Materia;
use App\Models\DocenteMateria;
class SeccionController extends Controller
{
    public function mostrarFormularioCrearSeccion()
    {
        // Obtener todos los grados disponibles
        $grados = Grado::all();

        return view('Paginas.Coordinadores.crear_seccion', compact('grados'));
    }

    public function crearSeccion(Request $request)
    {
        try {
            // Validar los datos recibidos
            $validatedData = $request->validate([
                'grado_id' => 'required|integer|exists:grados,id',
                'capacidad' => 'integer|min:1'
            ]);

            // Buscar el período académico actual
            $periodoActual = Periodo_Academico::where('actual', true)->firstOrFail();

            // Buscar el ID de grado_periodo correspondiente al grado y período actual
            $gradoPeriodo = GradoPeriodo::where('grado_id', $validatedData['grado_id'])
                                        ->where('periodo_id', $periodoActual->id)
                                        ->firstOrFail();

            // Contar las secciones existentes para este grado_periodo
            $numeroSecciones = Seccion::where('grado_periodo_id', $gradoPeriodo->id)->count();

            // Calcular el nombre de la nueva sección en base a la cantidad de secciones existentes
            $nuevoNombre = chr(ord('A') + $numeroSecciones); // Empieza en 'A' y suma el número de secciones

            // Crear la nueva sección en la base de datos
            $seccion = Seccion::create([
                'grado_periodo_id' => $gradoPeriodo->id,
                'nombre' => $nuevoNombre,
                'alumnos_inscritos' => 0,
                'capacidad' => $validatedData['capacidad'] ?? 40, // Asigna 40 si no se proporciona capacidad
            ]);

            return response()->json([
                'message' => 'Sección creada exitosamente',
                'seccion' => $seccion
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ocurrió un error al crear la sección',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
        public function formulario_secciones_disponibles()
    {
        $grados = Grado::all();
        $periodos = Periodo_Academico::all();

        return view('Paginas.Coordinadores.formulario_secciones_disponibles', [
            'grados' => $grados,
            'periodos' => $periodos,
        ]);
    }

    public function obtener_secciones_disponibles(Request $request)
    {
        $grado_id = $request->input('grado_id');
        $periodo_id = $request->input('periodo_id');

        $gradoPeriodo = GradoPeriodo::where('grado_id', $grado_id)
            ->where('periodo_id', $periodo_id)
            ->first();

        if ($gradoPeriodo)
            $secciones = $gradoPeriodo->secciones;
        else 
            $secciones = collect();
        
        $grado = Grado::find($grado_id);
        $materias = $grado->materias;
        return view('Paginas.Coordinadores.secciones_disponibles_reporte', [
            'secciones' => $secciones,
            'materias' => $materias// Suponiendo que tienes un modelo Materia
        ]);
    }


    public function obtener_reporte_notas(Request $request)
    {
        $seccion_id = $request->input('seccion_id');
        $materia_id = $request->input('materia_id');

        // Obtener el grado_periodo_id desde la sección
        $seccion = Seccion::find($seccion_id);

        if ($seccion) {
            // Obtener el periodo_id desde grado_periodo
            $gradoPeriodo = $seccion->grado_periodo;
            $periodo_id = $gradoPeriodo->periodo_id;

            // Obtener el docente_materia_id
            $docenteMateria = DocenteMateria::where('materia_id', $materia_id)
                                            ->where('periodo_id', $periodo_id)
                                            ->first();

            if ($docenteMateria)
                $calificaciones = Calificacion::where('docente_materia_id', $docenteMateria->id)->get();
            else 
                $calificaciones = collect();
        } else
            $calificaciones = collect();

            $totalEstudiantes = $calificaciones->count();
            $totalAprobados = $calificaciones->filter(function ($calificacion) {
                return $calificacion->promedio >= 10; // Asumiendo que la nota de aprobación es 10
            })->count();

            $totalReprobados = $totalEstudiantes - $totalAprobados;
            $porcentajeAprobados = ($totalAprobados / $totalEstudiantes) * 100;
            $porcentajeReprobados = ($totalReprobados / $totalEstudiantes) * 100;
            $promedioGeneral = $calificaciones->avg('promedio');


        return view('Paginas.Coordinadores.reporte_notas', [
            'calificaciones' => $calificaciones,
            'totalEstudiantes' => $totalEstudiantes,
            'totalAprobados' => $totalAprobados,
            'totalReprobados' => $totalReprobados,
            'porcentajeAprobados' => $porcentajeAprobados,
            'porcentajeReprobados' => $porcentajeReprobados,
            'promedioGeneral' => $promedioGeneral,
        ]);
    }

    
/*
    public function obtener_reporte_notas(Request $request)
    {
        $request->validate([
            'seccion_id' => 'required|integer|exists:secciones,id',
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
    }*/
}
