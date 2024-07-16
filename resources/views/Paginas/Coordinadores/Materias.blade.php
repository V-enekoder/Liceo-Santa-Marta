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
                    <th class="py-3 px-6 text-center">ID ASIGNATURA</th>
                    <th class="py-3 px-6 text-center">GRADO PERTENECIENTE</th>
                    <th class="py-3 px-6 text-center">ASIGNATURA</th>
                    <th class="py-3 px-6 text-center">OPCIONES DE AJUSTE</th>
                </tr>
            </thead>
            <tbody id="materiasTablaBody" class="text-gray-800">
                @foreach ($materias as $materia)
                    <tr data-id="{{ $materia->id }}">
                        <td class="py-3 px-6 border-b border-gray-200">{{ $materia->id }}</td>
                        <td class="py-3 px-6 border-b border-gray-200">{{ $materia->grado->nombre_grado }}</td>
                        <td class="py-3 px-6 border-b border-gray-200">{{ $materia->nombre }}</td>
                        <td class="py-3 px-6 text-center border-b border-gray-200">
                            <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs editarMateriaBtn"
                                data-id="{{ $materia->id }}" data-grado="{{ $materia->grado->id }}" data-nombre="{{ $materia->nombre }}">
                                <i class="fas fa-edit mr-1"></i> Editar
                            </a>
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs eliminarMateriaBtn"
                                    data-id="{{ $materia->id }}">
                                Eliminar
                            </button>
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

    <!-- Formulario para editar materia -->
    <div id="editarMateriaForm" style="display: none;">
        <form id="formEditarMateria" method="POST">
            @csrf
            @method('PUT')
            <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                <div class="bg-white p-4 rounded">
                    <h1 class="text-xl font-bold mb-4">Editar Materia</h1>
                    <div>
                        <label for="editGrado" class="block mb-2">Grado:</label>
                        <select id="editGrado" name="grado_id" class="border border-gray-300 px-2 py-1 rounded mb-2">
                            @foreach($grados as $grado)
                                <option value="{{ $grado->id }}">{{ $grado->nombre_grado }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="editNombre" class="block mb-2">Nombre:</label>
                        <input type="text" id="editNombre" name="nombre" class="border border-gray-300 px-2 py-1 rounded mb-2">
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="button" id="cancelarEditarBtn" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Cancelar
                        </button>
                        <button type="submit" id="guardarEditarBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
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
                        var newRow = '<tr data-id="' + response.materia.id + '">' +
                            '<td class="py-3 px-6 border-b border-gray-200">' + response.materia.id + '</td>' +
                            '<td class="py-3 px-6 border-b border-gray-200">' + $('#addGrado option:selected').text() + '</td>' +
                            '<td class="py-3 px-6 border-b border-gray-200">' + $('#addNombre').val() + '</td>' +
                            '<td class="py-3 px-6 text-center border-b border-gray-200">' +
                            '<a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs editarMateriaBtn" data-id="' + response.materia.id + '" data-grado="' + $('#addGrado option:selected').val() + '" data-nombre="' + $('#addNombre').val() + '">' +
                            '<i class="fas fa-edit mr-1"></i> Editar</a>' +
                            '<button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs eliminarMateriaBtn" data-id="' + response.materia.id + '">Eliminar</button>' +
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

            // Mostrar el formulario para editar materia
            $(document).on('click', '.editarMateriaBtn', function() {
                var id = $(this).data('id');
                var grado = $(this).data('grado');
                var nombre = $(this).data('nombre');

                $('#editGrado').val(grado);
                $('#editNombre').val(nombre);

                $('#formEditarMateria').attr('action', '/dashboard/dataMaterias/' + id);
                $('#editarMateriaForm').show();
            });

            $('#cancelarEditarBtn').click(function() {
                $('#editarMateriaForm').hide();
            });

            $('#formEditarMateria').submit(function(event) {
                event.preventDefault();

                var formData = $(this).serialize();
                var actionUrl = $(this).attr('action');

                $.ajax({
                    url: actionUrl,
                    type: 'PUT',
                    dataType: 'json',
                    data: formData,
                    success: function(response) {
                        alert(response.message);
                        var updatedRow = '<td class="py-3 px-6 border-b border-gray-200">' + response.materia.id + '</td>' +
                            '<td class="py-3 px-6 border-b border-gray-200">' + $('#editGrado option:selected').text() + '</td>' +
                            '<td class="py-3 px-6 border-b border-gray-200">' + $('#editNombre').val() + '</td>' +
                            '<td class="py-3 px-6 text-center border-b border-gray-200">' +
                            '<a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs editarMateriaBtn" data-id="' + response.materia.id + '" data-grado="' + $('#editGrado option:selected').val() + '" data-nombre="' + $('#editNombre').val() + '">' +
                            '<i class="fas fa-edit mr-1"></i> Editar</a>' +
                            '<button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs eliminarMateriaBtn" data-id="' + response.materia.id + '">Eliminar</button>' +
                            '</td>';

                        $('tr[data-id="' + response.materia.id + '"]').html(updatedRow);
                        $('#editarMateriaForm').hide();
                    },
                    error: function(xhr) {
                        alert('Error al actualizar la materia.');
                    }
                });
            });

            // Eliminar una materia
            $(document).on('click', '.eliminarMateriaBtn', function() {
                var id = $(this).data('id');

                if (confirm('¿Estás seguro de que deseas eliminar esta materia?')) {
                    $.ajax({
                        url: '/dashboard/dataMaterias/' + id,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            alert(response.message);
                            $('tr[data-id="' + id + '"]').remove();
                        },
                        error: function(xhr) {
                            alert('Error al eliminar la materia.');
                        }
                    });
                }
            });
        });
    </script>
</x-app-layout>