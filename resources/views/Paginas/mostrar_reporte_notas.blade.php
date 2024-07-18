<!-- resources/views/Paginas/mostrar_reporte_notas.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Reporte de Notas</h1>

        <div class="row">
            <div class="col-md-12">
                <h3>Estadísticas Generales</h3>
                <p>Total de Estudiantes: {{ $totalEstudiantes }}</p>
                <p>Aprobados: {{ $aprobados }}</p>
                <p>Reprobados: {{ $reprobados }}</p>
                <p>Porcentaje de Aprobados: {{ $porcentajeAprobados }}%</p>
                <p>Promedio General: {{ $promedioGeneral }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h3>Calificaciones</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Estudiante</th>
                            <th>Calificación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($calificaciones as $calificacion)
                            <tr>
                                <td>{{ $calificacion->estudiante->nombre }}</td>
                                <td>{{ $calificacion->promedio }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
