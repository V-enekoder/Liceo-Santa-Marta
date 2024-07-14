<!-- resources/views/Paginas/Coordinadores/secciones_disponibles.blade.php -->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Grado y Periodo</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto mt-5 p-5 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-5">Seleccionar Grado y Periodo</h2>

        <form action="{{ route('sidebar.inscribir') }}" method="POST" class="mb-5">
            @csrf
            <div class="mb-4">
                <label for="grado_id" class="block text-gray-700">Grado</label>
                <select name="grado_id" id="grado_id" class="form-control mt-1 block w-full" required>
                    <option value="">Seleccione un grado</option>
                    @foreach ($grados as $grado)
                        <option value="{{ $grado->id }}">{{ $grado->año }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="periodo_id" class="block text-gray-700">Periodo Académico</label>
                <select name="periodo_id" id="periodo_id" class="form-control mt-1 block w-full" required>
                    <option value="">Seleccione un periodo académico</option>
                    @foreach ($periodos as $periodo)
                        <option value="{{ $periodo->id }}">{{ $periodo->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Buscar Secciones</button>
        </form>
    </div>
</body>

</html>
