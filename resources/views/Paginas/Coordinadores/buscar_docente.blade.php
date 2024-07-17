<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Docentes</title>
</head>

<body>
    <h1>Listado de Docentes</h1>

    <form action="{{ route('docentes.buscar') }}" method="GET">
        <label for="cedula">Buscar por Cédula:</label>
        <input type="text" id="cedula" name="cedula">
        <button type="submit">Buscar</button>
    </form>

    @if ($docentes->isNotEmpty())
        <ul id="docentes-list">
            @foreach ($docentes as $docente)
                <li class="docente-item">
                    <strong>Nombre:</strong> {{ $docente->persona->primer_nombre ?? 'No existe' }}
                    {{ $docente->persona->primer_apellido ?? 'No existe' }}<br>
                    <strong>Cédula:</strong> {{ $docente->persona->cedula ?? 'No existe' }}<br>
                    <strong>Categoría:</strong> {{ $docente->persona->categoria->nombre ?? 'No existe' }}<br>
                    <strong>Email:</strong> {{ $docente->user->email ?? 'No existe' }}<br>
                    <strong>Dirección:</strong> {{ $docente->persona->direccion ?? 'No existe' }}<br>
                    <strong>Fecha de Nacimiento:</strong> {{ $docente->persona->fecha_nacimiento ?? 'No existe' }}<br>
                    <strong>Activo:</strong> {{ $docente->persona->activo ? 'Sí' : 'No' ?? 'No existe' }}<br>
                    <!-- Otros detalles del docente -->
                </li>
            @endforeach
        </ul>
    @else
        <p>No se encontraron docentes.</p>
    @endif

    <!-- scripts -->
    <script>
        // Script de filtrado y visualización de docentes
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('cedula');
            const docenteItems = document.querySelectorAll('.docente-item');

            searchInput.addEventListener('input', function() {
                const cedula = parseInt(searchInput.value.trim()); // Convertir a número entero

                docenteItems.forEach(function(item) {
                    const cedulaDocente = parseInt(item.querySelector('strong:nth-of-type(3)')
                        .textContent.trim()); // Convertir a número entero desde el tercer strong

                    if (isNaN(cedula) || isNaN(cedulaDocente)) {
                        item.style.display =
                        'block'; // Mostrar si hay un error de cédula (puede ser un enfoque según el requerimiento)
                    } else if (cedulaDocente === cedula) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>

</body>

</html>
