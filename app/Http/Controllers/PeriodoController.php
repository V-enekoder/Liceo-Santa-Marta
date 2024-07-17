<?php

namespace App\Http\Controllers;

use App\Models\Periodo_Academico;
use App\Models\Grado;
use App\Models\GradoPeriodo;
use App\Models\Seccion;
use App\Models\Coordinador;
use App\Models\CoordinadorPeriodo;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    function ver_periodos(){
        //Gate::authorize('crear_periodos');
        return view('Paginas.Coordinadores.Crear_periodo_academico',);
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
            'año_fin' => $año_fin,
            'actual' => false,
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
}
