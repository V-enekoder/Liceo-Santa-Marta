<x-app-layout>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Materias</h1>
        <button id="agregarMateriaBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Agregar Materia
        </button>
    </div>

    <div class="container mx-auto px-4">
        <table class="table-auto w-full mt-4">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-center">ID de MATERIA</th>
                    <th class="py-3 px-6 text-center">Grado en el que se imparte</th>
                    <th class="py-3 px-6 text-center">Nombre Materia</th>
                    <th class="py-3 px-6 text-center">Editar</th>
                </tr>
            </thead>
            <tbody id="materiasTablaBody" class="text-gray-800">
                <!-- Las filas se agregarán dinámicamente aquí -->
                @foreach ($materias as $materia)
                    <tr>
                        <td class="py-3 px-6 border-b border-gray-200">{{ $materia->id }}</td>
                        <td class="py-3 px-6 border-b border-gray-200">{{ $materia->grado->nombre_grado }}</td>
                        <td class="py-3 px-6 border-b border-gray-200">{{ $materia->nombre }}</td>
                        <td class="py-3 px-6 text-center border-b border-gray-200">
                            <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs editarMateriaBtn"
                               data-id="{{ $materia->id }}" data-grado="{{ $materia->grado->nombre_grado }}" data-nombre="{{ $materia->nombre }}">
                                <i class="fas fa-edit mr-1"></i> Editar
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="agregarMateriaForm" style="display: none;">
        <form id="formAgregarMateria" action="{{ route('sidebar.crearMateria') }}" method="POST">
            @csrf
            <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                <div class="bg-white p-4 rounded">
                    <h1 class="text-xl font-bold mb-4">Agregar Materia</h1>
                    <div>
                        <label for="addGrado" class="block mb-2">Grado:</label>
                        <select id="addGrado" name="grado_id" class="border border-gray-300 px-2 py-1 rounded mb-2">
                            @foreach($grados as $grado)
                                <option value="{{ $grado->id }}">{{ $grado->nombre_grado }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="addNombre" class="block mb-2">Nombre:</label>
                        <input type="text" id="addNombre" name="nombre" class="border border-gray-300 px-2 py-1 rounded mb-2">
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="button" id="cancelarAgregarBtn" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Cancelar
                        </button>
                        <button type="submit" id="guardarAgregarBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#agregarMateriaBtn').click(function() {
                $('#agregarMateriaForm').show();
            });

            $('#cancelarAgregarBtn').click(function() {
                $('#agregarMateriaForm').hide();
            });

            $('#formAgregarMateria').submit(function(event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    success: function(response) {
                        alert(response.message);
                        var newRow = '<tr>' +
                            '<td class="py-3 px-6 border-b border-gray-200">' + response.materia.id + '</td>' +
                            '<td class="py-3 px-6 border-b border-gray-200">' + $('#addGrado option:selected').text() + '</td>' +
                            '<td class="py-3 px-6 border-b border-gray-200">' + $('#addNombre').val() + '</td>' +
                            '<td class="py-3 px-6 text-center border-b border-gray-200">' +
                            '<a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs editarMateriaBtn" data-id="' + response.materia.id + '" data-grado="' + $('#addGrado option:selected').text() + '" data-nombre="' + $('#addNombre').val() + '">' +
                            '<i class="fas fa-edit mr-1"></i> Editar</a>' +
                            '</td>' 
                            '</tr>';

                        $('#materiasTablaBody').append(newRow);
                        $('#agregarMateriaForm').hide();
                    },
                    error: function(xhr) {
                        alert('Error al guardar la materia.');
                    }
                });
            });
        });
    </script>
</x-app-layout>




































{{-- <x-app-layout>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Materias</h1>
        <button id="agregarMateriaBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Agregar Materia
        </button>
    </div>

    <div class="container mx-auto px-4">
        <table class="table-auto w-full mt-4">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-center">ID</th>
                    <th class="py-3 px-6 text-center">Grado</th>
                    <th class="py-3 px-6 text-center">Nombre</th>
                    <th class="py-3 px-6 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody id="materiasTablaBody" class="text-gray-800">
                <!-- Las filas se agregarán dinámicamente aquí -->
            </tbody>
        </table>
    </div>

    <div id="agregarMateriaForm" style="display: none;">
        <form id="formAgregarMateria" action="{{ route('sidebar.materias') }}" method="POST">
            @csrf
            <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                <div class="bg-white p-4 rounded">
                    <h1 class="text-xl font-bold mb-4">Agregar Materia</h1>
                    <div>
                        <label for="addGrado" class="block mb-2">Grado:</label>
                        <select id="addGrado" name="grado_id" class="border border-gray-300 px-2 py-1 rounded mb-2">
                            @foreach($grados as $id => $nombre)
                                <option value="{{ $id }}">{{ $nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="addNombre" class="block mb-2">Nombre:</label>
                        <input type="text" id="addNombre" name="nombre" class="border border-gray-300 px-2 py-1 rounded mb-2">
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="button" id="cancelarAgregarBtn" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Cancelar
                        </button>
                        <button type="submit" id="guardarAgregarBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#agregarMateriaBtn').click(function() {
                $('#agregarMateriaForm').show();
            });

            $('#cancelarAgregarBtn').click(function() {
                $('#agregarMateriaForm').hide();
            });

            $('#formAgregarMateria').submit(function(event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: '{{ route('sidebar.crearMateria') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    success: function(response) {
                        alert(response.message);
                        var newRow = '<tr>' +
                            '<td class="py-3 px-6 border-b border-gray-200">' + response.materia.id + '</td>' +
                            '<td class="py-3 px-6 border-b border-gray-200">' + $('#addGrado option:selected').text() + '</td>' +
                            '<td class="py-3 px-6 border-b border-gray-200">' + $('#addNombre').val() + '</td>' +
                            '<td class="py-3 px-6 text-center border-b border-gray-200">' +
                            '<a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs editarMateriaBtn" data-id="' + response.materia.id + '" data-grado="' + $('#addGrado option:selected').text() + '" data-nombre="' + $('#addNombre').val() + '">' +
                            '<i class="fas fa-edit mr-1"></i> Editar</a>' +
                            '</td>' +
                            '</tr>';

                        $('#materiasTablaBody').append(newRow);
                        $('#agregarMateriaForm').hide();
                    },
                    error: function(xhr) {
                        alert('Error al guardar la materia.');
                    }
                });
            });
        });
    </script>
    
</x-app-layout> --}}


































{{-- anterior al de mariana --}}

{{-- <x-app-layout>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Materias</h1>
        <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            id="agregarMateriaBtn">
            <button id="guardarMateriaBtn">Agregar Materia</button>
        </a>
    </div>

    <div class="container mx-auto px-4">
        <table class="table-auto w-full mt-4">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-center">ID</th>
                    <th class="py-3 px-6 text-center">Grado</th>
                    <th class="py-3 px-6 text-center">Nombre</th>
                    <th class="py-3 px-6 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                <tr>
                    <td class="py-3 px-6 border-b border-gray-200">02</td>
                    <td class="py-3 px-6 border-b border-gray-200">5to</td>
                    <td class="py-3 px-6 border-b border-gray-200">Psicología</td>
                    <td class="py-3 px-6 text-center border-b border-gray-200">
                        <a href="#"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs editarMateriaBtn"
                            data-id="02" data-grado="5to" data-nombre="Psicología">
                            <i class="fas fa-edit mr-1"></i> Editar
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="py-3 px-6 border-b border-gray-200">01</td>
                    <td class="py-3 px-6 border-b border-gray-200">1ro</td>
                    <td class="py-3 px-6 border-b border-gray-200">Castellano</td>
                    <td class="py-3 px-6 text-center border-b border-gray-200">
                        <a href="#"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs editarMateriaBtn"
                            data-id="01" data-grado="1ro" data-nombre="Castellano">
                            <i class="fas fa-edit mr-1"></i> Editar
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="agregarMateriaForm" style="display: none;">
        <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-4 rounded">
                <h1 class="text-xl font-bold mb-4">Agregar Materia</h1>
                <div>
                    <label for="addGrado" class="block mb-2">Grado:</label>
                    <input type="text" id="addGrado" class="border border-gray-300 px-2 py-1 rounded mb-2">
                </div>
                <div>
                    <label for="addNombre" class="block mb-2">Nombre:</label>
                    <input type="text" id="addNombre" class="border border-gray-300 px-2 py-1 rounded mb-2">
                </div>
                <div class="flex justify-end mt-4">
                    <button id="cancelarAgregarBtn"
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                        Cancelar
                    </button>
                    <button id="guardarAgregarBtn"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>


    <div id="editarMateriaModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-4 rounded">
            <h1 class="text-xl font-bold mb-4">Editar Materia</h1>
            <div>
                <label for="editId" class="block mb-2">ID:</label>
                <input type="text" id="editId" class="border border-gray-300 px-2 py-1 rounded mb-2" readonly>
            </div>
            <div>
                <label for="editGrado" class="block mb-2">Grado:</label>
                <input type="text" id="editGrado" class="border border-gray-300 px-2 py-1 rounded mb-2">
            </div>
            <div>
                <label for="editNombre" class="block mb-2">Nombre:</label>
                <input type="text" id="editNombre" class="border border-gray-300 px-2 py-1 rounded mb-2">
            </div>
            <div class="flex justify-end mt-4">
                <button id="cancelarEdicionBtn"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Cancelar
                </button>
                <button id="guardarEdicionBtn"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Guardar
                </button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#agregarMateriaBtn').click(function(event) {
                event.preventDefault();
                $('#agregarMateriaForm').show();
            });

            $('#cancelarAgregarBtn').click(function() {
                $('#agregarMateriaForm').hide();
            });

            $('#guardarAgregarBtn').click(function() {
                var grado = $('#addGrado').val();
                var nombre = $('#addNombre').val();

                // Crear una nueva fila con los valores ingresados
                var newRow = '<tr>' +
                    '<td class="py-3 px-6 border-b border-gray-200">Nuevo ID</td>' +
                    '<td class="py-3 px-6 border-b border-gray-200">' + grado + '</td>' +
                    '<td class="py-3 px-6 border-b border-gray-200">' + nombre + '</td>' +
                    '<td class="py-3 px-6 text-center border-b border-gray-200">' +
                    '<a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs editarMateriaBtn" data-id="Nuevo ID" data-grado="' + grado + '" data-nombre="' + nombre + '">' +
                    '<i class="fas fa-edit mr-1"></i> Editar</a>' +
                    '</td>' +
                    '</tr>';

                // Agregar la nueva fila al cuerpo de la tabla
                $('#materiasTablaBody').append(newRow);

            });

            // El resto del código permanece igual...
        });

            $('.editarMateriaBtn').click(function() {
                var id = $(this).data('id');
                var grado = $(this).data('grado');
                var nombre = $(this).data('nombre');

                $('#editId').val(id);
                $('#editGrado').val(grado);
                $('#editNombre').val(nombre);

                $('#editarMateriaModal').show();
            });

            $('#cancelarEdicionBtn').click(function() {
                $('#editarMateriaModal').hide();
            });

            $('#guardarEdicionBtn').click(function() {
                var id = $('#editId').val();
                var grado = $('#editGrado').val();
                var nombre = $('#editNombre').val();

                // Aquí puedes enviar los datos actualizados al servidor mediante AJAX
                // y realizar las acciones necesarias después de guardar la edición

                $('#editarMateriaModal').hide();
            });

            $('#guardarMateriaBtn').click(function() {
                $.ajax({
                    url: '{{ route('sidebar.materias') }}',
                    type: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        // Aquí puedes obtener los valores de los campos del formulario y enviarlos como datos
                    },
                    success: function(response) {
                        alert('Materia agregada: ' + response.materia.nombre);
                        // Aquí podrías agregar más acciones después de guardar la materia
                    },
                    error: function(xhr) {
                        alert('Error al guardar la materia.');
                    }
                });
            });
    </script>
</x-app-layout> --}}
