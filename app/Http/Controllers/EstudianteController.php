<?php

namespace App\Http\Controllers;


use App\Models\Estudiante;
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
}
