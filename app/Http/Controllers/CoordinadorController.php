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
    function ver_periodos(){
        //Gate::authorize('crear_periodos');
        return view('Paginas.Coordinadores.Crear_periodo_academico',);
    }

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
    function modificarDocentes(){
        //Gate::authorize('modificar_docente');
        return view('Paginas.Coordinadores.Profesores',);
    }

    function modificarMaterias(){
        //Gate::authorize('modificar_materias');
        return view('Paginas.Coordinadores.Materias',);
        
    }

    public function mostrar_formulario_crear_usuario()
    {
        // Filtrar roles con id 3 y 4
        $roles = Rol::whereIn('id', [3, 4])->get();
        return view('Paginas.Coordinadores.crear_usuario', compact('roles'));
    }

    public function crear_usuario(Request $request)
    {
        $validatedData = $request->validate([
            'cedula' => 'required|integer|unique:users',
            'rol_id' => 'required|integer|exists:roles,id',
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            'password' => 'nullable|string|min:8|confirmed',
            'direccion' => 'nullable|string|max:255',
            'activo' => 'boolean',
        ]);

        // Crear usuario
        $user = User::create([
            'cedula' => $validatedData['cedula'],
            'rol_id' => $validatedData['rol_id'],
            'primer_nombre' => $validatedData['primer_nombre'],
            'segundo_nombre' => $validatedData['segundo_nombre'],
            'primer_apellido' => $validatedData['primer_apellido'],
            'segundo_apellido' => $validatedData['segundo_apellido'],
            'email' => $validatedData['email'],
            'password' => isset($validatedData['password']) ? Hash::make($validatedData['password']) : null,
            'direccion' => $validatedData['direccion'],
            'activo' => true,
        ]);

        if ($user->rol_id == 3) {
            Docente::create([
                'user_id' => $user->id
            ]);
        }

        if ($user->rol_id == 4) {
            Representante::create([
                'user_id' => $user->id
            ]);
        }

        return response()->json(['user' => $user], 201);
    }


    public function crear_periodo_academico(Request $request)
    {
        // Obtener el último periodo académico creado
        $ultimoPeriodo = Periodo_Academico::orderBy('año_fin', 'desc')->first();

        if ($ultimoPeriodo) {
            $año_inicio = $ultimoPeriodo->año_fin;
            $año_fin = $año_inicio + 1;
        } else {
            // Si no hay ningún periodo académico, establecer valores por defecto
            $año_inicio = now()->year;
            $año_fin = $año_inicio + 1;
        }

        $nombre = "{$año_inicio}-{$año_fin}";

        // Crear el nuevo periodo académico
        $periodoAcademico = Periodo_Academico::create([
            'nombre' => $nombre,
            'año_inicio' => $año_inicio,
            'año_fin' => $año_fin
        ]);

        if ($periodoAcademico) {
            // Llamar a la función para vincular grados
            $this->vincular_grados($periodoAcademico);

            // Llamar a la función para vincular coordinadores
            $this->vincular_coordinadores($periodoAcademico);
            //Vincular docentes y vincular representantes
                // Llamar a la función para crear secciones por grado
            $this->crearSeccionesPorGrados($periodoAcademico);
            
            return redirect()->back()->with('success', 'Periodo académico creado exitosamente.');
        } else
            return redirect()->back()->with('error', 'Hubo un problema al crear el periodo académico.');
    }
    
    private function vincular_grados($periodoAcademico)
    {
        // Obtener todos los grados existentes
        $grados = Grado::all();

        // Vincular cada grado al periodo académico creado
        foreach ($grados as $grado) {
            GradoPeriodo::create([
                'grado_id' => $grado->id,
                'periodo_id' => $periodoAcademico->id
            ]);
        }
    }

    private function vincular_coordinadores($periodoAcademico)
    {
        // Obtener todos los coordinadores cuya fecha de retiro es NULL
        $coordinadores = Coordinador::whereNull('fecha_retiro')->get();

        // Vincular cada coordinador al periodo académico creado
        foreach ($coordinadores as $coordinador) {
            CoordinadorPeriodo::create([
                'coordinador_id' => $coordinador->id,
                'periodo_id' => $periodoAcademico->id
            ]);
        }
    }
    
    private function crearSeccionesPorGrados(Periodo_Academico $periodoAcademico)
    {
        // Obtener todos los grados
        $grados = Grado::all();

        // Letras de las secciones
        $letras = ['A', 'B', 'C'];

        foreach ($grados as $grado) {
            foreach ($letras as $letra) {
                Seccion::create([
                    'grado_periodo_id' => $this->obtenerGradoPeriodoId($grado->id, $periodoAcademico->id),
                    'nombre' => $letra,
                    'alumnos_inscritos' => 0,
                    'capacidad' => 40 // Puedes ajustar según tus necesidades
                ]);
            }
        }
    }

    private function obtenerGradoPeriodoId($gradoId, $periodoId)
    {
        return GradoPeriodo::where('grado_id', $gradoId)
            ->where('periodo_id', $periodoId)
            ->value('id');
    }

    public function mostrarFormularioCrearSeccion(Request $request)
    {
        $grados = Grado::all();
        $periodos = Periodo_Academico::all();
        $nombre = 'A'; // Valor predeterminado en caso de que no se hayan seleccionado grado y periodo

        if ($request->has(['grado_id', 'periodo_id'])) {
            $gradoPeriodo = GradoPeriodo::where('grado_id', $request->grado_id)
                                        ->where('periodo_id', $request->periodo_id)
                                        ->first();

            if ($gradoPeriodo) {
                $ultimaSeccion = Seccion::where('grado_periodo_id', $gradoPeriodo->id)->orderBy('id', 'desc')->first();

                if ($ultimaSeccion) {
                    $ultimoNombre = $ultimaSeccion->nombre;
                    $nombre = chr(ord($ultimoNombre) + 1);
                }
            }
        }

        return view('Paginas.Coordinadores.crear_seccion', compact('grados', 'periodos', 'nombre'));
    }
    public function crearSeccion(Request $request)
    {
        try {
            // Validar los datos recibidos
            $validatedData = $request->validate([
                'grado_id' => 'required|integer|exists:grados,id',
                'periodo_id' => 'required|integer|exists:periodos_academicos,id',
                'capacidad' => 'integer|min:1'
            ]);

            // Buscar el ID de grado_periodo correspondiente
            $gradoPeriodo = GradoPeriodo::where('grado_id', $validatedData['grado_id'])
                                        ->where('periodo_id', $validatedData['periodo_id'])
                                        ->firstOrFail();

            // Obtener la última sección creada para este grado_periodo
            $ultimaSeccion = Seccion::where('grado_periodo_id', $gradoPeriodo->id)->orderBy('id', 'desc')->first();

            // Asignar la siguiente letra en orden alfabético
            if ($ultimaSeccion) {
                $ultimoNombre = $ultimaSeccion->nombre;
                $nuevoNombre = chr(ord($ultimoNombre) + 1);
            } else {
                $nuevoNombre = 'A';
            }

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
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Errores de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Grado o periodo no encontrado'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ocurrió un error al crear la sección',
                'error' => $e->getMessage()
            ], 500);
        }
    }


/**
 * Summary of obtenerCalificacion
 * *Esta funcion sirve para primero encontrar la nota y 
 * *luego modificarla en la siguiente
 */
public function obtenerCalificacion(Request $request)
{
    $request->validate([
        'cedula_docente' => 'required|integer',
        'periodo_id' => 'required|integer|exists:periodos_academicos,id',
        'materia_id' => 'required|integer|exists:materias,id',
        'cedula_estudiante' => 'required|integer',
    ]);

    try {
        // Buscar al docente por su cédula
        $userDocente = User::where('cedula', $request->cedula_docente)->firstOrFail();
        $docente = Docente::where('user_id', $userDocente->id)->firstOrFail();

        // Buscar al estudiante por su cédula
        $estudiante = Estudiante::where('cedula', $request->cedula_estudiante)->firstOrFail();

        // Buscar el registro docente_materia
        $docenteMateria = DocenteMateria::where('docente_id', $docente->id)
                                        ->where('materia_id', $request->materia_id)
                                        ->where('periodo_id', $request->periodo_id)
                                        ->firstOrFail();

        // Buscar la calificación del estudiante en la materia y periodo especificados
        $calificacion = Calificacion::where('docente_materia_id', $docenteMateria->id)
                                    ->where('estudiante_id', $estudiante->id)
                                    ->firstOrFail();

        // Retornar la calificación
        return response()->json([
            'calificacion' => $calificacion,
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Error al realizar la operación: ' . $e->getMessage(),
        ], 400);
    }
}


    public function modificarCalificacion(Request $request)
    {
        $request->validate([
            'calificacion_id' => 'required|integer|exists:calificaciones,id',
            'lapso_1' => 'nullable|integer|min:1|max:20',
            'lapso_2' => 'nullable|integer|min:1|max:20',
            'lapso_3' => 'nullable|integer|min:1|max:20',
        ]);

        try {
            // Buscar la calificación por su ID
            $calificacion = Calificacion::findOrFail($request->calificacion_id);

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

            // Calcular el promedio (asumiendo un promedio simple)
            $calificacion->promedio = ($calificacion->lapso_1 + $calificacion->lapso_2 + $calificacion->lapso_3) / 3;

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

    public function mostrarDocentePorCedula($cedula)
    {
        try {
            // Buscar al docente por su cédula y rol de docente (rol_id = 3)
            $docente = User::where('cedula', $cedula)
                            ->where('rol_id', 3)
                            ->with('docente') // Cargar la relación con el modelo Docente si está definida
                            ->firstOrFail();

            // Retornar los datos del docente en formato JSON
            return response()->json([
                'docente' => $docente
            ], 200);
        } catch (\Exception $e) {
            // Manejar el error si no se encuentra el docente
            return response()->json([
                'error' => 'No se encontró al docente con la cédula proporcionada.'
            ], 404);
        }
    }

    public function mostrarEstudiantePorCedula($cedula)
    {
        try {
            // Buscar al estudiante por su cédula
            $estudiante = Estudiante::where('cedula', $cedula)->firstOrFail();
            // Retornar los datos del estudiante en formato JSON
            return response()->json([
                'estudiante' => $estudiante
            ], 200);
        } catch (\Exception $e) {
            // Manejar el error si no se encuentra al estudiante
            return response()->json([
                'error' => 'No se encontró al estudiante con la cédula proporcionada.'
            ], 404);
        }
    }
    /**
     * TODO implementar tambien con telefonos
     * Summary of mostrarRepresentantePorCedula
     * @param mixed $cedula
     * @return mixed|\Illuminate\Http\JsonResponse
     */
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

    public function vincularEstudianteRepresentante(Request $request)
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

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al realizar la operación: ' . $e->getMessage(),
            ], 400);
        }       
    }
}