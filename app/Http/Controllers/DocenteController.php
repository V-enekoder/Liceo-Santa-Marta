<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Docente;
use App\Models\DocenteMateria;
use App\Models\Grado;
use App\Models\Materia;
use App\Models\Periodo_Academico;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Exception;
class DocenteController extends Controller
{
    function cargarNotas(){
        //Gate::authorize('cargar_notas');
        return view('Paginas.Docentes.carga_notas',);
    }
    function verSecciones(){
        //Gate::authorize('ver_secciones');
        return view('Paginas.Docentes.gestion_secciones',);
    }
    function verCargaAcademica(){
        //Gate::authorize('ver_carga_academica');
        return view('Paginas.Docentes.reporte_carga_academica',);
    }

    public function mostrarDocentes() 
    {
    // Obtener todos los docentes junto con la información del usuario
    $docentes = Docente::with('user.persona')->get();
    return view('Paginas.Coordinadores.Profesores', ['docentes' => $docentes]);
    }

    public function updateDocente(Request $request, $id)
    {
        $docente = Docente::find($id);

        $request->validate([
            'primer_nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'cedula' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $docente->user->persona->primer_nombre = $request->input('primer_nombre');
        $docente->user->persona->primer_apellido = $request->input('primer_apellido');
        $docente->user->persona->cedula = $request->input('cedula');
        $docente->user->email = $request->input('email');
        $docente->user->persona->save();
        $docente->user->save();

        return response()->json(['message' => 'Docente actualizado correctamente', 'docente' => $docente]);
    }

    public function obtenerMateriasPorDocenteYPeriodo(Request $request)
    {
        $request->validate([
            'docente_id' => 'required|integer|exists:docentes,id',
            'periodo_id' => 'required|integer|exists:periodos_academicos,id',
        ]);

        try {
            // Buscar las materias asignadas al docente en el período especificado
            $materias = DocenteMateria::where('docente_id', $request->docente_id)
                ->where('periodo_id', $request->periodo_id)
                ->with('materia')
                ->get()
                ->pluck('materia');

            // Retornar la información de las materias
            return response()->json([
                'materias' => $materias,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al realizar la operación: ' . $e->getMessage(),
            ], 400);
        }
    }

    public function showCambiarContrasenaForm()
    {
        return view('Paginas.Docentes.cambiar_contrasena_docente');
    }

    public function cambiarContrasenaDocente(Request $request)
    {
        $request->validate([
            'docente_id' => 'required|integer|exists:docentes,id',
            'nueva_contrasena' => 'required|string|min:8|confirmed',
        ]);

        try {
            // Buscar el docente por su ID
            $docente = Docente::findOrFail($request->docente_id);

            // Buscar el usuario asociado al docente
            $usuario = User::findOrFail($docente->user_id);

            // Cambiar la contraseña del usuario
            $usuario->password = Hash::make($request->nueva_contrasena);

            // Guardar los cambios
            $usuario->save();

            return response()->json([
                'message' => 'Contraseña actualizada exitosamente.',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al realizar la operación: ' . $e->getMessage(),
            ], 400);
        }
    }

    public function mostrarFormularioAsignarCarga()
    {
        // Obtener las personas con categoria_id = 1
        $per = Persona::where('categoria_id', 1)->get();

        // Filtrar las personas que tienen rol_id = 3 (docentes)
        $personas = $per->filter(function ($per) {
            return $per->user && $per->user->rol_id === 3;
        });

        // Obtener todas las materias disponibles
        $materias = Materia::all();

        // Obtener los grados con sus materias
        $grados = Grado::with('materias')->get();

        return view('Paginas.Coordinadores.Carga_academica', compact('materias', 'personas', 'grados'));
    }

    public function asignarCargaAcademica(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'persona_id' => 'required|integer|exists:personas,id',
            'materias' => 'required|array',
            'materias.*' => 'integer|exists:materias,id',
        ]);

        try {
            // Buscar al usuario por persona_id
            $user = User::where('persona_id', $request->persona_id)
                ->with(['persona', 'docente'])
                ->first();

            // Verificar si se encontró un usuario
            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'error' => 'No se encontró un usuario asociado a la persona proporcionada.'
                ], 404);
            }

            $user = User::where('persona_id', $request->persona_id)
                ->with('persona')
                ->first();

            // Verificar si se encontró un usuario
            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'error' => 'No se encontró un usuario asociado a la persona proporcionada.'
                ], 404);
            }

            // Buscar al docente asociado a este usuario
            $docente = $user->docente;

            // Obtener el periodo académico actual
            $periodoActual = Periodo_Academico::where('actual', 1)->firstOrFail();

            // Asignar las materias al docente en el periodo académico actual
            foreach ($request->materias as $materiaId) {
                // Verificar si ya existe la asignación docente-materia en el periodo actual
                $existeAsignacion = DocenteMateria::where('docente_id', $docente->id)
                    ->where('materia_id', $materiaId)
                    ->where('periodo_id', $periodoActual->id)
                    ->exists();

                if (!$existeAsignacion) {
                    // Crear el registro en la tabla docente_materia
                    DocenteMateria::create([
                        'docente_id' => $docente->id,
                        'materia_id' => $materiaId,
                        'periodo_id' => $periodoActual->id
                    ]);
                }
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Carga académica asignada correctamente al docente'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al asignar la carga académica',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function mostrarTodosLosDocentes(Request $request)
    {
        // Obtener todos los docentes con sus datos de persona
        $docentes = User::whereHas('persona', function ($query) {
                $query->where('categoria_id', 1); // Filtrar por la categoría de docente, si aplica
            })
            ->where('rol_id', 3) // Filtrar por rol de docente
            ->with('persona') // Cargar relación persona
            ->get();

        // Filtrar por cédula si se proporciona en la solicitud
        if ($request->has('cedula')) {
            $cedula = $request->cedula;
            $docentes = $docentes->filter(function ($docente) use ($cedula) {
                return $docente->persona->cedula == $cedula;
            });
        }

        return view('Paginas.Coordinadores.buscar_docente', compact('docentes'));
    }
            
    public function mostrarDocentePorCedula($cedula)
    {
        try {
            // Buscar a la persona por su cédula
            $persona = Persona::where('cedula', $cedula)
                ->with(['user' => function ($query) {
                    // Cargar la relación 'user' y 'docente' si el usuario tiene el rol_id = 3 (docente)
                    $query->with('docente')->where('rol_id', 3);
                }])
                ->firstOrFail();

            // Verificar si se encontró el usuario y si tiene el rol de docente
            $user = $persona->user;
            if (!$user || !$user->docente) {
                throw new Exception('No se encontró al docente con la cédula proporcionada.');
            }

            // Retornar los datos del docente en formato JSON
            return response()->json([
                'docente' => $user
            ], 200);
        } catch (Exception $e) {
            // Manejar el error si no se encuentra el docente
            return response()->json([
                'error' => $e->getMessage()
            ], 404);
        }
    }
}
