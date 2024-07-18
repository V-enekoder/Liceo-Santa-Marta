@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Reporte de Notas</div>
                    <div class="card-body">
                        @if ($calificaciones->isEmpty())
                            <div class="alert alert-warning">
                                No se encontraron calificaciones para la sección y materia seleccionadas.
                            </div>
                        @else
                            <ul>
                                @foreach ($calificaciones as $calificacion)
                                    <li>Estudiante ID: {{ $calificacion->estudiante_id }}, Promedio:
                                        {{ $calificacion->promedio }}</li>
                                @endforeach
                            </ul>
                            <hr>
                            <p>Total de Estudiantes: {{ $totalEstudiantes }}</p>
                            <p>Total de Aprobados: {{ $totalAprobados }}</p>
                            <p>Total de Reprobados: {{ $totalReprobados }}</p>
                            <p>Porcentaje de Aprobados: {{ number_format($porcentajeAprobados, 2) }}%</p>
                            <p>Porcentaje de Reprobados: {{ number_format($porcentajeReprobados, 2) }}%</p>
                            <p>Promedio General: {{ number_format($promedioGeneral, 2) }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Styles -->
    <style>
        /* Estilos personalizados aquí */
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div id="reporte-notas" class="card mt-4">
                    <div class="card-header">Reporte de Notas</div>
                    <div class="card-body">
                        <ul id="lista-calificaciones">
                            @foreach ($calificaciones as $calificacion)
                                <li>
                                    Estudiante: {{ $calificacion->estudiante_id }}, Promedio:
                                    {{ $calificacion->promedio }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html> --}}
