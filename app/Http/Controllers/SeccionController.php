<?php

namespace App\Http\Controllers;
use App\Models\Grado;
use App\Models\Periodo_Academico;
use App\Models\GradoPeriodo;
use App\Models\Seccion;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\EstudianteSeccion;
use Exception;
use App\Models\Calificacion;
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

public function obtenerDatosSecciones()
{
    $grados = Grado::all();
    $periodos = Periodo_Academico::all();
    $materias = Materia::all();
    
    $seccionesPorGradoYPeriodo = Seccion::with(['grado', 'periodoAcademico'])->get()->groupBy(['grado_id', 'periodo_academico_id']);

    return view('Paginas.mostrar_reporte_notas', [
        'grados' => $grados,
        'periodos' => $periodos,
        'materias' => $materias,
        'seccionesPorGradoYPeriodo' => $seccionesPorGradoYPeriodo,
    ]);
}

public function obtenerReporteNotas(Request $request)
{
    $validated = $request->validate([
        'seccion_id' => 'required|exists:secciones,id',
        'periodo_academico' => 'required|exists:periodos_academicos,id',
        'materia_id' => 'required|exists:materias,id',
    ]);

    $seccionId = $validated['seccion_id'];
    $periodoAcademico = $validated['periodo_academico'];
    $materiaId = $validated['materia_id'];

    // Obtener las calificaciones de los estudiantes de la sección, periodo académico y materia especificados
    $calificaciones = Calificacion::whereHas('docenteMateria', function ($query) use ($periodoAcademico, $materiaId) {
            $query->where('periodo_id', $periodoAcademico)
                ->where('materia_id', $materiaId);
        })
        ->whereHas('estudiante.secciones', function ($query) use ($seccionId) {
            $query->where('seccion_id', $seccionId);
        })
        ->get();


    $totalEstudiantes = $calificaciones->count();
    $aprobados = $calificaciones->where('promedio', '>=', 10)->count();
    $reprobados = $totalEstudiantes - $aprobados;
    $promedioGeneral = $totalEstudiantes > 0 ? $calificaciones->avg('promedio') : 0;
    $porcentajeAprobados = $totalEstudiantes > 0 ? ($aprobados / $totalEstudiantes) * 100 : 0;

    return view('Paginas.mostrar_reporte_notas', [
        'totalEstudiantes' => $totalEstudiantes,
        'aprobados' => $aprobados,
        'reprobados' => $reprobados,
        'porcentajeAprobados' => $porcentajeAprobados,
        'promedioGeneral' => $promedioGeneral,
    ]);
}



}
