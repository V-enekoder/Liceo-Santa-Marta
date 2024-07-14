<!-- resources/views/inscribir-estudiante.blade.php -->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscribir Estudiante en Sección</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="container mt-5">
        <h2>Inscribir Estudiante en Sección</h2>
        <form action="{{ route('inscribir_estudiante') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="seccion_id">Sección</label>
                <select name="seccion_id" id="seccion_id" class="form-control" required>
                    <option value="">Seleccione una sección</option>
                    @foreach ($secciones as $seccion)
                        <option value="{{ $seccion->id }}">{{ $seccion->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-3">
                <label for="cedula_estudiante">Cédula del Estudiante</label>
                <input type="text" name="cedula_estudiante" id="cedula_estudiante" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Inscribir</button>
        </form>
        @if (session('message'))
            <div class="alert alert-success mt-3">
                {{ session('message') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif
    </div>
</body>

</html>
