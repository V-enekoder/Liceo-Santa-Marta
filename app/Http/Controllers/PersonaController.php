<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Coordinador;
use App\Models\Docente;
use App\Models\Representante;
use App\Models\Estudiante;
use App\Models\Persona;
use App\Models\Categoria;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PersonaController extends Controller
{
public function mostrar_formulario_crear_usuario()
{
    // Obtener el usuario autenticado
    $user = Auth::user();

    $rolesPermitidos = [];
    switch ($user->rol_id) {
        case 1: // Si el usuario tiene rol_id 1
            $rolesPermitidos = [2, 3, 4]; // Mostrar roles con id 2, 3 y 4
            break;
        case 2: // Si el usuario tiene rol_id 2
            $rolesPermitidos = [3, 4]; // Mostrar roles con id 3 y 4
            break;
        default:
            // Por defecto, mostrar roles con id 2, 3 y 4
            $rolesPermitidos = [2, 3, 4];
            break;
    }

    // Filtrar roles según los roles permitidos
    $categorias = Categoria::all();
    $roles = Rol::whereIn('id', $rolesPermitidos)->get();

    return view('Paginas.Coordinadores.crear_persona', compact('roles','categorias'));
}

    public function crear(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'categoria_id' => 'required|integer',
            'cedula' => 'required|integer|unique:personas,cedula',
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            'password' => 'nullable|string|min:8|confirmed',
            'direccion' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'rol_id' => 'required|integer',
        ]);

        // Si la validación falla, retornar errores
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Crear persona
        $persona = Persona::create([
            'categoria_id' => $request->input('categoria_id'),
            'cedula' => $request->input('cedula'),
            'tipo' => $request->input('tipo'),
            'primer_nombre' => $request->input('primer_nombre'),
            'segundo_nombre' => $request->input('segundo_nombre'),
            'primer_apellido' => $request->input('primer_apellido'),
            'segundo_apellido' => $request->input('segundo_apellido'),
            'direccion' => $request->input('direccion'),
            'fecha_nacimiento' => $request->input('fecha_nacimiento'),
            'activo' => true,
        ]);
        // Crear un usuario si la categoria de persona es 1 y es solicitado
        $user = null;

        Log::info('Persona ID: ' . $persona->id);

        if($persona->categoria_id == 1){
            $user = User::create([
                'persona_id' => $persona->id,
                'rol_id' => $request->input('rol_id'),
                'email' => $request->input('email'),
                'password' => isset($request->password) ? Hash::make($request->password) : null,
            ]);

            switch ($user->rol_id) {
                case 2:
                    Coordinador::create([
                        'user_id' => $user->id,
                        'fecha_ingreso' => now() // Fecha actual como fecha de ingreso
                    ]);
                    break;
                case 3:
                    Docente::create([
                        'user_id' => $user->id
                    ]);
                    break;
                case 4:
                    Representante::create([
                        'user_id' => $user->id
                    ]);
                    break;
            }
        }
        // Crear un estudiante si la categoria de persona es 2 y es solicitado
        if ($persona->categoria_id == 2) {
            Estudiante::create([
                'persona_id' => $persona->id,
                'ultimo_grado_aprobado' => $request->input('ultimo_grado_aprobado', 0),
                'inscrito' => false,
            ]);
        }

        // Retornar respuesta con el usuario creado
        return response()->json(['user' => $user], 201);
    }
}
