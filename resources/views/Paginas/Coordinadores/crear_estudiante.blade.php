<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Estudiante</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Crear Estudiante</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/dashboard/crear-estudiante') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="cedula">Cédula</label>
                <input type="text" class="form-control" id="cedula" name="cedula" value="{{ old('cedula') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="primer_nombre">Primer Nombre</label>
                <input type="text" class="form-control" id="primer_nombre" name="primer_nombre"
                    value="{{ old('primer_nombre') }}" required>
            </div>

            <div class="form-group">
                <label for="segundo_nombre">Segundo Nombre</label>
                <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre"
                    value="{{ old('segundo_nombre') }}">
            </div>

            <div class="form-group">
                <label for="primer_apellido">Primer Apellido</label>
                <input type="text" class="form-control" id="primer_apellido" name="primer_apellido"
                    value="{{ old('primer_apellido') }}" required>
            </div>

            <div class="form-group">
                <label for="segundo_apellido">Segundo Apellido</label>
                <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido"
                    value="{{ old('segundo_apellido') }}">
            </div>

            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                    value="{{ old('fecha_nacimiento') }}" required>
            </div>

            <div class="form-group">
                <label for="ultimo_grado_aprobado">Último Grado Aprobado</label>
                <input type="number" class="form-control" id="ultimo_grado_aprobado" name="ultimo_grado_aprobado"
                    value="{{ old('ultimo_grado_aprobado') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Crear Estudiante</button>
        </form>
    </div>
</body>

</html>
