<?php

namespace App\Http\Controllers;
use App\Models\Calificacion;
use App\Models\Docente;
use App\Models\Estudiante;
use App\Models\EstudianteRepresentante;
use App\Models\Periodo_Academico;
use App\Models\Representante;
use App\Models\Telefono;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Persona;
use Illuminate\Support\Facades\Auth;
use App\Models\DocenteMateria;
use Illuminate\Support\Facades\Gate;
use App\Models\Grado;
class RepresentanteController extends Controller{
    function mostrar_boletin(){
        //Gate::authorize('ver_boletin');
        $user = Auth::user();
        $representante = Representante::where('user_id', $user->id)->first();

        return view('Paginas.Representantes.boletin_notas_actual',);
    }

    function indexTodoBoletin(){
        //Gate::authorize('ver_boletin');
        return view('Paginas.Representantes.notas_finales');
    }
    function verFicha(){
        //Gate::authorize('ver_ficha');
        return view('Paginas.Representantes.Ficha_estudiante');
    }

    public function formulario_agregar_telefono()
    {
        
        return view('Paginas.Representantes.agregar_telefono', compact('user'));
    }

    public function formulario_mostrar_boletines(){
        $grados = Grado::all();
        return view('Paginas.Representantes.seleccionar_boletin', compact('grados'));
    }
    
    public function buscar_boletin(Request $request) {
        $request->validate([
            'cedula_estudiante' => 'required|integer|exists:personas,cedula',
            'grado_id' => 'required|exists:grados,id',
        ]);

        try {
            $periodo = Periodo_Academico::where('actual', true)->firstOrFail();
            $representante = Representante::where('user_id', Auth::id())->firstOrFail();

            // Buscar el estudiante por su cédula
            $persona_estudiante = Persona::where('cedula', $request->cedula_estudiante)->firstOrFail();
            $estudiante = $persona_estudiante->estudiante;

            // Verificar que el estudiante está relacionado con el representante en el período actual
            $relacion = $representante->estudiantes()
                ->where('estudiante_id', $estudiante->id)
                ->wherePivot('periodo_id', $periodo->id)
                ->exists();

            if (!$relacion) {
                return redirect()->back()->withErrors(['cedula_estudiante' => 'El estudiante no está relacionado con el representante en el período actual.']);
            }

            // Obtener el grado y sus materias
            $grado = Grado::findOrFail($request->grado_id);
            $materias = $grado->materias;

            // Array para almacenar las calificaciones por materia
            $calificaciones = [];

            foreach ($materias as $materia) {
                // Buscar el docente_materia_id para esta materia, grado y periodo
                $docenteMateria = DocenteMateria::where('materia_id', $materia->id)
                    ->where('periodo_id', $periodo->id)
                    ->firstOrFail();

                // Buscar las calificaciones del estudiante para esta materia y periodo
                $calificacion = Calificacion::where('estudiante_id', $estudiante->id)
                    ->where('docente_materia_id', $docenteMateria->id)
                    ->first();

                // Guardar las calificaciones en el array por materia
                $calificaciones[$materia->nombre] = $calificacion;
            }

            return view('Paginas.Representantes.mostrar_boletin', compact('estudiante', 'calificaciones','grado'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error al buscar el boletín: ' . $e->getMessage()]);
        }
}

    public function formulario_mostrar_finales(){
        $grados = Grado::all();
        return view('Paginas.Representantes.seleccionar_finales', compact('grados'));
    }

public function buscar_finales(Request $request) {
        $request->validate([
            'cedula_estudiante' => 'required|integer|exists:personas,cedula',
            'grado_id' => 'required|exists:grados,id',
        ]);

        try {
            $periodo = Periodo_Academico::where('actual', true)->firstOrFail();
            $representante = Representante::where('user_id', Auth::id())->firstOrFail();

            // Buscar el estudiante por su cédula
            $persona_estudiante = Persona::where('cedula', $request->cedula_estudiante)->firstOrFail();
            $estudiante = $persona_estudiante->estudiante;

            // Verificar que el estudiante está relacionado con el representante en el período actual
            $relacion = $representante->estudiantes()
                ->where('estudiante_id', $estudiante->id)
                ->wherePivot('periodo_id', $periodo->id)
                ->exists();

            if (!$relacion) {
                return redirect()->back()->withErrors(['cedula_estudiante' => 'El estudiante no está relacionado con el representante en el período actual.']);
            }

            // Obtener el grado y sus materias
            $grado = Grado::findOrFail($request->grado_id);
            $materias = $grado->materias;

            // Array para almacenar las calificaciones por materia
            $calificaciones = [];

            foreach ($materias as $materia) {
                // Buscar el docente_materia_id para esta materia, grado y periodo
                $docenteMateria = DocenteMateria::where('materia_id', $materia->id)
                    ->where('periodo_id', $periodo->id)
                    ->firstOrFail();

                // Buscar las calificaciones del estudiante para esta materia y periodo
                $calificacion = Calificacion::where('estudiante_id', $estudiante->id)
                    ->where('docente_materia_id', $docenteMateria->id)
                    ->first();

                // Guardar las calificaciones en el array por materia
                $calificaciones[$materia->nombre] = $calificacion;
            }

            return view('Paginas.Representantes.mostrar_finales', compact('estudiante', 'calificaciones','grado'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error al buscar el boletín: ' . $e->getMessage()]);
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

    public function formulario_vincular()
    {
        // Obtener todos los períodos académicos
        $periodos = Periodo_Academico::where('actual', true)->get();

        // Retornar la vista con los períodos académicos
        return view('Paginas.Coordinadores.vincular_representante', compact('periodos'));
    }
public function vincular_estudiante_representante(Request $request)
{
    $request->validate([
        'cedula_representante' => 'required|integer|exists:personas,cedula',
        'cedula_estudiante' => 'required|integer|exists:personas,cedula',
    ]);

    try {
        // Obtener el periodo académico actual
        $periodo = Periodo_Academico::where('actual', true)->firstOrFail();

        // Buscar el representante por su cédula
        $persona_representante = Persona::where('cedula', $request->cedula_representante)->firstOrFail();
        $representante = $persona_representante->user->representante;

        // Buscar el estudiante por su cédula
        $persona_estudiante = Persona::where('cedula', $request->cedula_estudiante)->firstOrFail();
        $estudiante = $persona_estudiante->estudiante;

        // Verificar si el representante y el estudiante existen
        if (!$representante || !$estudiante) {
            return response()->json([
                'error' => 'No se encontró un representante o estudiante asociado a las cédulas proporcionadas.'
            ], 400);
        }

        // Verificar si la relación ya existe
        $relacionExistente = EstudianteRepresentante::where('estudiante_id', $estudiante->id)
            ->where('representante_id', $representante->id)
            ->where('periodo_id', $periodo->id)
            ->first();

        if ($relacionExistente) {
            return response()->json([
                'error' => 'La relación entre el estudiante y el representante ya existe en este período académico.'
            ], 400);
        }

        // Contar cuántos representantes tiene el estudiante en el mismo período
        $contadorRepresentantes = EstudianteRepresentante::where('estudiante_id', $estudiante->id)
            ->where('periodo_id', $periodo->id)
            ->count();

        if ($contadorRepresentantes == 3) {
            return response()->json([
                'error' => 'El estudiante ya tiene 3  representantes en este período académico.'
            ], 400);
        }

        // Vincular al estudiante y representante en el período académico
        $estudianteRepresentante = EstudianteRepresentante::create([
            'estudiante_id' => $estudiante->id,
            'representante_id' => $representante->id,
            'periodo_id' => $periodo->id,
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


//CRUD representantes-----------------------------------------------------------------------------------------------------------------
    public function mostrarRepresentantes()
{
    // Obtener todos los representantes junto con la información del usuario
    $representantes = Representante::with('user.persona')->paginate(10);
    return view('Paginas.Coordinadores.modificacion_representantes', ['representantes' => $representantes]);
    
}

public function actualizarRepresentante(Request $request, $id)
{
    $representante = Representante::find($id);

    $request->validate([
        'primer_nombre' => 'required|string|max:255',
        'primer_apellido' => 'required|string|max:255',
        'cedula' => 'required|string|max:255',
        'email' => 'required|email|max:255',
    ]);

    $representante->user->persona->primer_nombre = $request->input('primer_nombre');
    $representante->user->persona->primer_apellido = $request->input('primer_apellido');
    $representante->user->persona->cedula = $request->input('cedula');
    $representante->user->email = $request->input('email');
    $representante->user->persona->save();
    $representante->user->save();

    return response()->json(['message' => 'Representante actualizado correctamente', 'representante' => $representante]);
}

public function agregarRepresentante(Request $request)
{
    $request->validate([
        'primer_nombre' => 'required|string|max:255',
        'primer_apellido' => 'required|string|max:255',
        'cedula' => 'required|string|max:255|unique:personas',
        'direccion' => 'required|string|max:255',
    ]);

    // Crear un nuevo usuario y persona
    $user = new User();
    $user->email = $request->input('email');
    $user->password = bcrypt('defaultpassword'); // Aquí deberías tener un proceso seguro para establecer la contraseña
    $user->save();

    $persona = new Persona();
    $persona->primer_nombre = $request->input('primer_nombre');
    $persona->primer_apellido = $request->input('primer_apellido');
    $persona->cedula = $request->input('cedula');
    $persona->direccion = $request->input('direccion');
    $persona->user_id = $user->id;
    $persona->save();

    // Asignar el rol de representante al usuario
    $user->assignRole('representante');

    // Crear el representante asociado al usuario
    $representante = new Representante();
    $representante->user_id = $user->id;
    $representante->save();

    return response()->json(['message' => 'Representante agregado correctamente', 'representante' => $representante]);
}

public function borrarRepresentante($id)
{
    $representante = Representante::find($id);

    if (!$representante) {
        return response()->json(['error' => 'Representante no encontrado'], 404);
    }

    // Eliminar el usuario y la persona asociada
    $representante->user->persona->delete();
    $representante->user->delete();
    $representante->delete();

    return response()->json(['message' => 'Representante eliminado correctamente']);
}
}
