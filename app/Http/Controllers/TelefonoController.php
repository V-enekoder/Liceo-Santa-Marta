<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Telefono;
use Illuminate\Http\Request;

class TelefonoController extends Controller
{
    public function indexTelefono()
    {
        $user = Auth::user();
        return view('Paginas.Representantes.agregar_telefono', compact('user'));
    }

    public function agregarTelefono(Request $request)
    {
        try {
            // Validación de los datos de entrada
            $request->validate([
                'numero_telefonico' => 'required|string|max:255'
            ]);

            // Obtener el usuario autenticado
            $user = Auth::user();

            //Crear el registro de teléfono para el usuario autenticado
            Telefono::create([
                'user_id' => $user->id,
                'numero_telefonico' => $request->numero_telefonico
            ]);

            return redirect()->back()->with('success', 'Teléfono ' . $request->numero_telefonico . ' añadido correctamente');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al agregar teléfono: ' . $e->getMessage());
        }
    }
}
