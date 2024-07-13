<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Sección</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Crear Sección</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/dashboard/crear-seccion') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="grado_id">Grado</label>
                <select class="form-control" id="grado_id" name="grado_id" required>
                    <option value="">Seleccione un grado</option>
                    @foreach ($grados as $grado)
                        <option value="{{ $grado->id }}">{{ $grado->año }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="periodo_id">Periodo</label>
                <select class="form-control" id="periodo_id" name="periodo_id" required>
                    <option value="">Seleccione un periodo</option>
                    @foreach ($periodos as $periodo)
                        <option value="{{ $periodo->id }}">{{ $periodo->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="capacidad">Capacidad</label>
                <input type="number" class="form-control" id="capacidad" name="capacidad"
                    value="{{ old('capacidad', 40) }}" min="1">
            </div>

            <div class="form-group">
                <label for="nombre">Nombre de la Sección</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $nombre }}"
                    readonly>
            </div>

            <button type="submit" class="btn btn-primary">Crear Sección</button>
        </form>
    </div>
</body>

</html>
