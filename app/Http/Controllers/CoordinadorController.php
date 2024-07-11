<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Calificacion;
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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CoordinadorController extends Controller{
    function crearPeriodos(){
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
    function crearCargaAcademica(){
        return view('Paginas.Coordinadores.Carga_academica',);
    }

    public function crear_usuario(Request $request){
        $validatedData = $request->validate([
            'cedula' => 'required|integer|unique:users',
            'rol_id' => 'required|integer|exists:roles,id',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'direccion' => 'nullable|string|max:255',
            'activo' => 'boolean',
            //'current_team_id' => 'nullable|integer|exists:teams,id',
            //'profile_photo_path' => 'nullable|string|max:2048'
        ]);

        // Crear usuario
        $user = User::create([
            'cedula' => $validatedData['cedula'],
            'rol_id' => $validatedData['rol_id'],
            'nombre' => $validatedData['nombre'],
            'apellido' => $validatedData['apellido'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'direccion' => $validatedData['direccion'],
            'activo' => $validatedData['activo'] ?? true,
            //'current_team_id' => $validatedData['current_team_id'],
            //'profile_photo_path' => $validatedData['profile_photo_path']
        ]);

        if ($user->rol_id == 3) {
            $docente = Docente::create([
                'user_id' => $user->id
        ]);
        }
        // Si el rol_id es 4, crear representante
        if ($user->rol_id == 4) {
            $representante = Representante::create([
                'user_id' => $user->id
            ]);
        }

        return response()->json(['user' => $user], 201);
    }

     public function crear_periodo_academico(Request $request){
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

        return response()->json(['periodo_academico' => $periodoAcademico], 201);
    }
public function crear_estudiante(Request $request)
    {
        // Validación de los datos de entrada
        $request->validate([
            'cedula' => 'required|integer|unique:estudiantes,cedula',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'ultimo_grado_aprobado' => 'required|integer'
        ]);

        // Crear el nuevo estudiante
        $estudiante = Estudiante::create([
            'cedula' => $request->cedula,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'ultimo_grado_aprobado' => $request->ultimo_grado_aprobado
        ]);

        return response()->json(['message' => 'Estudiante creado correctamente', 'estudiante' => $estudiante], 201);
    }
    public function crear_materia(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'grado_id' => 'required|exists:grados,id',
            'nombre' => 'required|string|max:255',
        ]);

        // Crear una nueva asignatura
        $materia = Materia::create([
            'grado_id' => $request->input('grado_id'),
            'nombre' => $request->input('nombre'),
        ]);

        // Retornar una respuesta exitosa
        return response()->json([
            'message' => 'Asignatura creada exitosamente',
            'materia' => $materia,
        ], 201);
    }

    public function crearSeccion(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'grado_id' => 'required|integer|exists:grados,id',
            'periodo_id' => 'required|integer|exists:periodos,id',
            'nombre' => 'required|string|max:255',
            'capacidad' => 'integer|min:1'
        ]);

        // Buscar el ID de grado_periodo correspondiente
        $gradoPeriodo = GradoPeriodo::where('grado_id', $request->grado_id)
                                    ->where('periodo_id', $request->periodo_id)
                                    ->firstOrFail();

        // Crear la nueva sección en la base de datos
        $seccion = Seccion::create([
            'grado_periodo_id' => $gradoPeriodo->id,
            'nombre' => $request->nombre,
            'alumnos_inscritos' => 0,
            'capacidad' => $request->capacidad ?? 40, // Asigna 40 si no se proporciona capacidad
        ]);

        return response()->json([
            'message' => 'Sección creada exitosamente',
            'seccion' => $seccion
        ], 201);
    }
    //Se asigna una materia al profesor
    public function asignarCargaAcademica(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'cedula' => 'required|string|max:20',
            'materia_id' => 'required|integer|exists:materias,id',
            'periodo_id' => 'required|integer|exists:periodos_academicos,id',
        ]);

        // Buscar al docente por su cédula
        $docente = Docente::where('cedula', $request->cedula)->firstOrFail();

        // Crear el registro en la tabla docente_materia
        $docenteMateria = DocenteMateria::create([
            'docente_id' => $docente->id,
            'materia_id' => $request->materia_id,
            'periodo_id' => $request->periodo_id,
        ]);

        return response()->json([
            'message' => 'Carga académica asignada correctamente',
            'docente_materia' => $docenteMateria
        ], 201);
    }
//se asignan varias

    public function asignarCargaAcademica1(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'cedula' => 'required|string|size:10', // Asumiendo cédula venezolana
            'materias' => 'required|array',
            'materias.*' => 'integer|exists:materias,id',
            'periodo_id' => 'required|integer|exists:periodos_academicos,id',
        ]);

        // Buscar el docente por su número de cédula
        $docente = Docente::where('cedula', $request->cedula)->firstOrFail();

        // Asignar las materias al docente en el periodo académico actual
        foreach ($request->materias as $materiaId) {
            // Verificar si ya existe la asignación docente-materia en el periodo actual
            $existeAsignacion = $docente->materias()
                ->where('materia_id', $materiaId)
                ->where('periodo_id', $request->periodo_id)
                ->exists();

            if (!$existeAsignacion) {
                // Crear el registro en la tabla docente_materia
                $docente->materias()->attach($materiaId, ['periodo_id' => $request->periodo_id]);
            }
        }

        return response()->json([
            'message' => 'Carga académica asignada correctamente al docente',
            'docente' => $docente->load('materias') // Opcional: Cargar las materias asignadas al docente
        ], 201);
    }

    public function modificar_nota(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'cedula' => 'required|string|size:10', // Asumiendo cédula venezolana
            'materia_id' => 'required|integer|exists:materias,id',
            'periodo_id' => 'required|integer|exists:periodos_academicos,id',
            'lapso' => 'required|integer|between:1,3', // Lapsos válidos del 1 al 3
            'nota' => 'required|integer|min:1|max:20', // Suponiendo un rango de notas de 0 a 20
        ]);

        try {
            // Buscar al estudiante por su cédula
            $estudiante = User::where('cedula', $request->cedula)->firstOrFail();

            // Buscar o crear la relación estudiante_materia para el periodo y materia especificados
            $estudianteMateria = EstudianteMateria::firstOrCreate([
                'estudiante_id' => $estudiante->id,
                'materia_id' => $request->materia_id,
                'periodo_id' => $request->periodo_id,
            ]);

            // Buscar la calificación correspondiente al estudiante_materia y periodo
            $calificacion = Calificacion::where('estudiante_materia_id', $estudianteMateria->id)
                ->where('lapso_' . $request->lapso, '!=', null)
                ->first();

            // Si no existe la calificación, crear un nuevo registro
            if (!$calificacion) {
                $calificacion = new Calificacion();
                $calificacion->estudiante_materia_id = $estudianteMateria->id;
            }

            // Modificar la nota del lapso especificado
            $calificacion->{'lapso_' . $request->lapso} = $request->nota;

            // Calcular y actualizar el promedio
            $calificacion->promedio = ($calificacion->lapso_1 + $calificacion->lapso_2 + $calificacion->lapso_3) / 3;

            // Guardar el registro de calificación
            $calificacion->save();

            return response()->json([
                'message' => 'Nota modificada exitosamente',
                'calificacion' => $calificacion
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al modificar la nota: ' . $e->getMessage()
            ], 500);
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

    public function inscribirEstudianteEnSeccion(Request $request)
    {
        $request->validate([
            'seccion_id' => 'required|integer|exists:secciones,id',
            'cedula_estudiante' => 'required|integer|exists:estudiantes,cedula',
        ]);

        try {
            // Buscar la sección por su ID
            $seccion = Seccion::findOrFail($request->seccion_id);

            // Verificar si el número de inscritos es menor a la capacidad
            if ($seccion->alumnos_inscritos >= $seccion->capacidad) {
                return response()->json([
                    'error' => 'La sección ha alcanzado su capacidad máxima.',
                ], 400);
            }

            // Buscar al estudiante por su cédula
            $estudiante = Estudiante::where('cedula', $request->cedula_estudiante)->firstOrFail();

            // Verificar si el estudiante ya está inscrito en la sección
            $existeInscripcion = DB::table('estudiante_seccion')
                ->where('estudiante_id', $estudiante->id)
                ->where('seccion_id', $seccion->id)
                ->exists();

            if ($existeInscripcion) {
                return response()->json([
                    'error' => 'El estudiante ya está inscrito en esta sección.',
                ], 400);
            }

            // Inscribir al estudiante en la sección
            DB::table('estudiante_seccion')->insert([
                'estudiante_id' => $estudiante->id,
                'seccion_id' => $seccion->id,
            ]);

            // Incrementar el número de alumnos inscritos en la sección
            $seccion->increment('alumnos_inscritos');

            return response()->json([
                'message' => 'El estudiante ha sido inscrito exitosamente en la sección.',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al realizar la operación: ' . $e->getMessage(),
            ], 400);
        }
    }

/**
Version con transaccion
public function inscribirEstudianteEnSeccion(Request $request)
{
    $request->validate([
        'seccion_id' => 'required|integer|exists:secciones,id',
        'cedula_estudiante' => 'required|integer|exists:estudiantes,cedula',
    ]);

    try {
        // Buscar la sección por su ID
        $seccion = Seccion::findOrFail($request->seccion_id);

        // Verificar si el número de inscritos es menor a la capacidad
        if ($seccion->alumnos_inscritos >= $seccion->capacidad) {
            return response()->json([
                'error' => 'La sección ha alcanzado su capacidad máxima.',
            ], 400);
        }

        // Buscar al estudiante por su cédula
        $estudiante = Estudiante::where('cedula', $request->cedula_estudiante)->firstOrFail();

        // Verificar si el estudiante ya está inscrito en la sección
        $existeInscripcion = DB::table('estudiante_seccion')
            ->where('estudiante_id', $estudiante->id)
            ->where('seccion_id', $seccion->id)
            ->exists();

        if ($existeInscripcion) {
            return response()->json([
                'error' => 'El estudiante ya está inscrito en esta sección.',
            ], 400);
        }

        // Iniciar una transacción para asegurar la atomicidad de las operaciones
        DB::transaction(function () use ($estudiante, $seccion) {
            // Inscribir al estudiante en la sección
            DB::table('estudiante_seccion')->insert([
                'estudiante_id' => $estudiante->id,
                'seccion_id' => $seccion->id,
            ]);

            // Incrementar el número de alumnos inscritos en la sección
            $seccion->increment('alumnos_inscritos');
        });

        return response()->json([
            'message' => 'El estudiante ha sido inscrito exitosamente en la sección.',
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Error al realizar la operación: ' . $e->getMessage(),
        ], 400);
    }
}  
 */


}