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
use App\Models\Persona;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
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
        return view('Paginas.Coordinadores.secciones_disponibles', compact('grados'));
    }

    public function obtenerSecciones(Request $request)
    {
        $grado_id = $request->grado_id;
        $periodoActual = Periodo_Academico::where('actual', true)->first();

        // Obtener el grado_periodo utilizando el periodo académico actual
        $grado_periodo = GradoPeriodo::where('grado_id', $grado_id)
            ->where('periodo_id', $periodoActual->id)
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
            'cedula_estudiante' => 'required|integer|exists:personas,cedula',
        ]);

        try {
            // Buscar a la persona por la cédula proporcionada
            $persona = Persona::where('cedula', $request->cedula_estudiante)->firstOrFail();

            // Verificar si la persona tiene asociado un estudiante
            if (!$persona->estudiante) {
                return back()->with('error', 'La persona con la cédula proporcionada no tiene un perfil de estudiante asociado.');
            }

            // Obtener al estudiante asociado a la persona
            $estudiante = $persona->estudiante;

            // Obtener la sección seleccionada
            $seccion = Seccion::findOrFail($request->seccion_id);

            // Verificar la capacidad de la sección
            if ($seccion->alumnos_inscritos >= $seccion->capacidad) {
                return back()->with('error', 'La sección ha alcanzado su capacidad máxima.');
            }

            // Obtener el último grado aprobado del estudiante
            $ultimoGradoAprobado = $estudiante->ultimo_grado_aprobado;

            // Obtener el año del grado de la sección
            $gradoPeriodo = GradoPeriodo::find($seccion->grado_periodo_id);
            $grado = $gradoPeriodo->grado;
            $periodo = $gradoPeriodo->periodo;
            $añoGrado = $grado->nombre;

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

            // Incrementar el contador de alumnos inscritos en la sección
            $seccion->increment('alumnos_inscritos');

            // Crear las calificaciones correspondientes al estudiante
            $this->crearCalificaciones($estudiante, $grado, $periodo);

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

    public function formulario_buscar()
    {
        return view('Paginas.Coordinadores.buscar_estudiante');
    }

    public function buscar_estudiante($cedula)
    {
        try {
            $persona = Persona::where('cedula', $cedula)->firstOrFail();

            // Verificar si la persona tiene asociado un estudiante
            if (!$persona->estudiante) {
                return back()->with('error', 'La persona con la cédula proporcionada no tiene un perfil de estudiante asociado.');
            }

            // Obtener al estudiante asociado a la persona
            $estudiante = $persona->estudiante;
            return view('Paginas.Coordinadores.buscar_estudiante', compact('estudiante'));
        } catch (\Exception $e) {
            // Manejar el error si no se encuentra al estudiante
            return response()->json([
                'error' => 'No se encontró al estudiante con la cédula proporcionada.'
            ], 404);
        }
    }

    public function verFicha($cedula){
        
        $estudiante = Estudiante::whereHas('persona', function ($query) use ($cedula) {
           $query->where('cedula', $cedula);
         })->with('persona')->first();
        return response()->json($estudiante);
    }
}
