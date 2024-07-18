<!DOCTYPE html>
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
                <div class="card">
                    <div class="card-header">Seleccione Grado y Período Académico</div>

                    <div class="card-body">
                        <form action="{{ route('secciones.disponibles.obtener') }}" method="POST">
                            @csrf

                            <div class="form-group row">
                                <label for="grado_id" class="col-md-4 col-form-label text-md-right">Grado:</label>
                                <div class="col-md-6">
                                    <select id="grado_id" class="form-control" name="grado_id" required>
                                        <option value="">Seleccione un grado</option>
                                        @foreach ($grados as $grado)
                                            <option value="{{ $grado->id }}">{{ $grado->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="periodo_id" class="col-md-4 col-form-label text-md-right">Período
                                    Académico:</label>
                                <div class="col-md-6">
                                    <select id="periodo_id" class="form-control" name="periodo_id" required>
                                        <option value="">Seleccione un período</option>
                                        @foreach ($periodos as $periodo)
                                            <option value="{{ $periodo->id }}">{{ $periodo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Obtener Secciones Disponibles
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
