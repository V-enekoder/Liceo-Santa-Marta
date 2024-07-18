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
use Illuminate\Support\Facades\Gate;

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
        $user = Auth::user();
        return view('Paginas.Representantes.agregar_telefono', compact('user'));
    }

    public function obtener_boletín_actual(Request $request)
    {
        $request->validate([
            'cedula_estudiante' => 'required|integer',
        ]);

        try {
            // Buscar al estudiante por su cédula
            $estudiante = Estudiante::where('cedula', $request->cedula_estudiante)->firstOrFail();

            // Buscar todas las calificaciones del estudiante
            $calificaciones = Calificacion::where('estudiante_id', $estudiante->id)
                ->with('docenteMateria')
                ->get();

            // Retornar la información de las calificaciones
            return response()->json([
                'calificaciones' => $calificaciones,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al realizar la operación: ' . $e->getMessage(),
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
