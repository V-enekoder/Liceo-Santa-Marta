<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\Docente;
use App\Models\Estudiante;
use App\Models\Grado;
use App\Models\Materia;
use App\Models\Periodo_Academico;
use Illuminate\Http\Request;

class CalificacionController extends Controller
{

    function modificarNotas(){
        //Gate::authorize('modificar_notas');
        return view('Paginas.Coordinadores.modificacion_notas',);
    }

    public function mostrar_datos_calificacion(){
        $periodos = Periodo_Academico::all();
        $materias = Materia::all();
        $estudiantes = Estudiante::all();

        return view('Paginas.Coordinadores.modificar_calificacion', compact('periodos', 'materias', 'estudiantes'));
    }

public function actualizar_calificacion(Request $request)
{
    $request->validate([
        'periodo_id' => 'required|integer|exists:periodos_academicos,id',
        'materia_id' => 'required|integer|exists:materias,id',
        'cedula_estudiante' => 'required|integer|exists:estudiantes,cedula',
        'lapso_1' => 'nullable|integer|min:1|max:20',
        'lapso_2' => 'nullable|integer|min:1|max:20',
        'lapso_3' => 'nullable|integer|min:1|max:20',
    ]);

    try {
        // Buscar al estudiante por cédula
        $estudiante = Estudiante::where('cedula', $request->cedula_estudiante)->firstOrFail();

        // Buscar la calificación del estudiante en la materia y periodo específicos
        $calificacion = Calificacion::where('estudiante_id', $estudiante->id)
            ->whereHas('docente_materia', function ($query) use ($request) {
                $query->where([
                    ['materia_id', '=', $request->materia_id],
                    ['periodo_id', '=', $request->periodo_id]
                ]);
            })
            ->firstOrFail();

        // Actualizar los lapsos si están presentes en el request
        if ($request->has('lapso_1')) {
            $calificacion->lapso_1 = $request->lapso_1;
        }
        if ($request->has('lapso_2')) {
            $calificacion->lapso_2 = $request->lapso_2;
        }
        if ($request->has('lapso_3')) {
            $calificacion->lapso_3 = $request->lapso_3;
        }

        // Calcular el promedio (asumiendo que todos los lapsos tienen calificaciones)
        $calificacion->promedio = (
            ($calificacion->lapso_1 ?? 0) + 
            ($calificacion->lapso_2 ?? 0) + 
            ($calificacion->lapso_3 ?? 0)
            ) / 3;

        // Guardar los cambios
        $calificacion->save();

        return response()->json([
            'message' => 'Calificación actualizada exitosamente.',
            'calificacion' => $calificacion,
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Error al realizar la operación: ' . $e->getMessage(),
        ], 400);
    }
}

}
