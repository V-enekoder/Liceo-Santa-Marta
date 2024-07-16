<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\DocenteMateria;
use App\Models\Estudiante;
use App\Models\Grado;
use App\Models\GradoPeriodo;
use App\Models\Representante;
use App\Models\EstudianteRepresentante;
use App\Models\EstudianteSeccion;
use App\Models\Periodo_Academico;
use App\Models\Seccion;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function mostrar_plantilla()
    {
        return view('Paginas.Coordinadores.crear_estudiante');
    }
    public function crear_estudiante(Request $request)
    {
        // Validación de los datos de entrada
        $request->validate([
            'cedula' => 'required|integer|unique:estudiantes,cedula',
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'ultimo_grado_aprobado' => 'required|integer'
        ]);

        // Crear el nuevo estudiante
        $estudiante = Estudiante::create([
            'cedula' => $request->cedula,
            'primer_nombre' => $request->primer_nombre,
            'segundo_nombre' => $request->segundo_nombre,
            'primer_apellido' => $request->primer_apellido,
            'segundo_apellido' => $request->segundo_apellido,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'ultimo_grado_aprobado' => $request->ultimo_grado_aprobado
        ]);

        return response()->json(['message' => 'Estudiante creado correctamente', 'estudiante' => $estudiante], 201);
    }

    public function mostrarFichaEstudiante(Request $request)
    {
        $request->validate([
            'cedula_estudiante' => 'required|integer',
            'periodo_id' => 'required|integer|exists:periodos_academicos,id',
        ]);

        try {
            // Buscar al estudiante por su cédula
            $estudiante = Estudiante::where('cedula', $request->cedula_estudiante)->firstOrFail();

            // Buscar los representantes del estudiante en el período especificado
            $representantes = EstudianteRepresentante::where('estudiante_id', $estudiante->id)
                ->where('periodo_id', $request->periodo_id)
                ->with(['representante.user.telefonos'])
                ->get()
                ->map(function ($registro) {
                    return [
                        'representante' => $registro->representante->user,
                        'telefonos' => $registro->representante->user->telefonos->pluck('numero_telefonico'),
                    ];
                });

            // Retornar la información del estudiante y sus representantes
            return response()->json([
                'estudiante' => $estudiante,
                'representantes' => $representantes,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al realizar la operación: ' . $e->getMessage(),
            ], 400);
        }
    }

// app/Http/Controllers/TuControlador.php

    public function mostrarFormularioInscripcion()
    {
        $grados = Grado::all();
        $periodos = Periodo_Academico::all();
        return view('Paginas.Coordinadores.secciones_disponibles', compact('grados', 'periodos'));
    }

    public function obtenerSecciones(Request $request)
    {
        $grado_id = $request->grado_id;
        $periodo_id = $request->periodo_id;

        // Buscar el grado_periodo correspondiente
        $grado_periodo = GradoPeriodo::where('grado_id', $grado_id)
            ->where('periodo_id', $periodo_id)
            ->first();

        // Obtener las secciones correspondientes si existe el grado_periodo
        $secciones = $grado_periodo ? Seccion::where('grado_periodo_id', $grado_periodo->id)->get() : [];

        // Retornar la vista con los datos necesarios
        return view('Paginas.Coordinadores.inscribir_estudiante', [
            'secciones' => $secciones
        ]);
    }

    public function inscribirEstudianteEnSeccion(Request $request)
    {
        $request->validate([
            'seccion_id' => 'required|integer|exists:secciones,id',
            'cedula_estudiante' => 'required|integer|exists:estudiantes,cedula',
        ]);

        try {
            $seccion = Seccion::findOrFail($request->seccion_id);

            if ($seccion->alumnos_inscritos >= $seccion->capacidad) {
                return back()->with('error', 'La sección ha alcanzado su capacidad máxima.');
            }

            $estudiante = Estudiante::where('cedula', $request->cedula_estudiante)->firstOrFail();

            // Obtener el último grado aprobado del estudiante
            $ultimoGradoAprobado = $estudiante->ultimo_grado_aprobado;

            // Obtener el año del grado de la sección
            $gradoPeriodo = GradoPeriodo::find($seccion->grado_periodo_id);
            $grado = $gradoPeriodo->grado;
            $periodo = $gradoPeriodo->periodo;
            $añoGrado = $grado->año;

            // Verificar si el estudiante puede inscribirse en esta sección
            if ($ultimoGradoAprobado != ($añoGrado - 1)) {
                return back()->with('error', 'El estudiante no puede inscribirse en esta sección porque no ha aprobado el grado anterior.');
            }

            // Verificar si el estudiante ya está inscrito en otra sección del mismo grado y periodo
            $seccionesDelGradoYPeriodo = Seccion::where('grado_periodo_id', $seccion->grado_periodo_id)->get();
            foreach ($seccionesDelGradoYPeriodo as $sec) {
                $estaInscrito = DB::table('estudiante_seccion')
                    ->where('estudiante_id', $estudiante->id)
                    ->where('seccion_id', $sec->id)
                    ->exists();

                if ($estaInscrito) {
                    return back()->with('error', 'El estudiante ya está inscrito en otra sección de este mismo grado y periodo.');
                }
            }

            // Realizar la inscripción del estudiante
            DB::table('estudiante_seccion')->insert([
                'estudiante_id' => $estudiante->id,
                'seccion_id' => $seccion->id,
            ]);
            $seccion->increment('alumnos_inscritos');

                    // Paso 1: Obtener las materias del grado y periodo
        $this->crearCalificaciones($estudiante, $grado, $periodo);
/*            $materias = $grado->materias;

            foreach ($materias as $materia) {
                // Paso 2: Obtener los registros de docente_materia
                $docenteMateria = DocenteMateria::where('materia_id', $materia->id)
                    ->where('periodo_id', $periodo->id)
                    ->first();

                if ($docenteMateria) {
                    Calificacion::create([
                        'docente_materia_id' => $docenteMateria->id,
                        'estudiante_id' => $estudiante->id,
                    ]);
                }
            }*/

            return back()->with('message', 'El estudiante ha sido inscrito exitosamente en la sección.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al realizar la operación: ' . $e->getMessage());
        }
    }

    private function crearCalificaciones(Estudiante $estudiante, Grado $grado, Periodo_Academico $periodo)
    {
        $materias = $grado->materias;

        foreach ($materias as $materia) {
            // Obtener los registros de docente_materia
            $docenteMateria = DocenteMateria::where('materia_id', $materia->id)
                ->where('periodo_id', $periodo->id)
                ->first();

            if ($docenteMateria) {
                Calificacion::create([
                    'docente_materia_id' => $docenteMateria->id,
                    'estudiante_id' => $estudiante->id,
                ]);
            }
        }
    }


    /*public function mostrarInscripcion()
    {
        // Obtener el primer registro de estudiante_seccion sin ordenar
        $estudianteSeccion = EstudianteSeccion::first();

        return view('Paginas.Coordinadores.calificaciones', compact('estudianteSeccion'));
    }

    public function crearCalificaciones(Request $request)
    {
        try {
            // Obtener datos del request
            $estudianteId = $request->estudiante_id;
            $seccionId = $request->seccion_id;

            // Obtener el grado y periodo de la sección
            $seccion = Seccion::findOrFail($seccionId);
            $gradoPeriodo = GradoPeriodo::find($seccion->grado_periodo_id);
            $grado = $gradoPeriodo->grado;
            $periodo = $gradoPeriodo->periodo;

            // Obtener las materias del grado
            $materias = $grado->materias;

            foreach ($materias as $materia) {
                // Obtener los registros de docente_materia
                $docenteMateria = DocenteMateria::where('materia_id', $materia->id)
                    ->where('periodo_id', $periodo->id)
                    ->first();

                if ($docenteMateria) {
                    Calificacion::create([
                        'docente_materia_id' => $docenteMateria->id,
                        'estudiante_id' => $estudianteId,
                    ]);
                }
            }

            return back()->with('message', 'Calificaciones creadas exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al crear las calificaciones: ' . $e->getMessage());
        }
    }*/
}
