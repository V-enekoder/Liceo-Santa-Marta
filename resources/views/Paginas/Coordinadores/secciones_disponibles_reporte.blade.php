@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($secciones->isEmpty())
                    <div class="alert alert-warning">
                        No hay secciones disponibles para el grado y período académico seleccionados.
                    </div>
                @else
                    <div class="card">
                        <div class="card-header">Seleccione Sección y Materia</div>

                        <div class="card-body">
                            <form action="{{ route('reporte.notas.obtener') }}" method="POST">
                                @csrf

                                <div class="form-group row">
                                    <label for="seccion_id" class="col-md-4 col-form-label text-md-right">Sección:</label>
                                    <div class="col-md-6">
                                        <select id="seccion_id" class="form-control" name="seccion_id" required>
                                            <option value="">Seleccione una sección</option>
                                            @foreach ($secciones as $seccion)
                                                <option value="{{ $seccion->id }}">{{ $seccion->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="materia_id" class="col-md-4 col-form-label text-md-right">Materia:</label>
                                    <div class="col-md-6">
                                        <select id="materia_id" class="form-control" name="materia_id" required>
                                            <option value="">Seleccione una materia</option>
                                            @foreach ($materias as $materia)
                                                <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Obtener Reporte de Notas
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
