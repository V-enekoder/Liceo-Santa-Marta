<!-- resources/views/Paginas/Coordinadores/Profesores.blade.php -->
<x-app-layout>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Gestión de Docentes</h1>
    </div>

    <div class="container mx-auto px-4">
        <table class="table-auto w-full mt-4">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-center">ID</th>
                    <th class="py-3 px-6 text-center">Nombre</th>
                    <th class="py-3 px-6 text-center">Apellido</th>
                    <th class="py-3 px-6 text-center">Cédula</th>
                    <th class="py-3 px-6 text-center">Usuario</th>
                    <th class="py-3 px-6 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody id="table-body" class="text-gray-800">
                @foreach($docentes as $docente)
                    <tr data-id="{{ $docente->id }}">
                        <td class="py-3 px-6 border-b border-gray-200">{{ $docente->id }}</td>
                        <td class="py-3 px-6 border-b border-gray-200">{{ $docente->user->persona->primer_nombre }}</td>
                        <td class="py-3 px-6 border-b border-gray-200">{{ $docente->user->persona->primer_apellido }}</td>
                        <td class="py-3 px-6 border-b border-gray-200">{{ $docente->user->persona->cedula }}</td>
                        <td class="py-3 px-6 border-b border-gray-200">{{ $docente->user->email }}</td>
                        <td class="py-3 px-6 text-center border-b border-gray-200">
                            <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs editarDocenteBtn"
                                data-id="{{ $docente->id }}" data-nombre="{{ $docente->user->persona->primer_nombre }}"
                                data-apellido="{{ $docente->user->persona->primer_apellido }}" data-cedula="{{ $docente->user->persona->cedula }}"
                                data-email="{{ $docente->user->email }}">
                                <i class="fas fa-edit mr-1"></i> Editar
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Formulario para editar docente -->
    <div id="editarDocenteForm" style="display: none;">
        <form id="formEditarDocente" method="POST">
            @csrf
            @method('PUT')
            <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                <div class="bg-white p-4 rounded">
                    <h1 class="text-xl font-bold mb-4">Editar Docente</h1>
                    <div>
                        <label for="editNombre" class="block mb-2">Nombre:</label>
                        <input type="text" id="editNombre" name="primer_nombre" class="border border-gray-300 px-2 py-1 rounded mb-2" required>
                    </div>
                    <div>
                        <label for="editApellido" class="block mb-2">Apellido:</label>
                        <input type="text" id="editApellido" name="primer_apellido" class="border border-gray-300 px-2 py-1 rounded mb-2" required>
                    </div>
                    <div>
                        <label for="editCedula" class="block mb-2">Cédula:</label>
                        <input type="text" id="editCedula" name="cedula" class="border border-gray-300 px-2 py-1 rounded mb-2" required>
                    </div>
                    <div>
                        <label for="editEmail" class="block mb-2">Usuario (Email):</label>
                        <input type="email" id="editEmail" name="email" class="border border-gray-300 px-2 py-1 rounded mb-2" required>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="button" id="cancelarEditarBtn" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Cancelar</button>
                        <button type="submit" id="guardarEditarBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Mostrar el formulario para editar docente
            $(document).on('click', '.editarDocenteBtn', function() {
                var id = $(this).data('id');
                var nombre = $(this).data('nombre');
                var apellido = $(this).data('apellido');
                var cedula = $(this).data('cedula');
                var email = $(this).data('email');

                $('#editNombre').val(nombre);
                $('#editApellido').val(apellido);
                $('#editCedula').val(cedula);
                $('#editEmail').val(email);

                $('#formEditarDocente').attr('action', '/dashboard/dataDocentes/' + id);
                $('#editarDocenteForm').show();
            });

            $('#cancelarEditarBtn').click(function() {
                $('#editarDocenteForm').hide();
            });

            $('#formEditarDocente').submit(function(event) {
                event.preventDefault();

                var formData = $(this).serialize();
                var actionUrl = $(this).attr('action');

                $.ajax({
                    url: actionUrl,
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-HTTP-Method-Override': 'PUT'
                    },
                    success: function(response) {
                        alert(response.message);
                        var updatedRow = '<td class="py-3 px-6 border-b border-gray-200">' +
                            response.docente.id + '</td>' +
                            '<td class="py-3 px-6 border-b border-gray-200">' + $('#editNombre').val() + '</td>' +
                            '<td class="py-3 px-6 border-b border-gray-200">' + $('#editApellido').val() + '</td>' +
                            '<td class="py-3 px-6 border-b border-gray-200">' + $('#editCedula').val() + '</td>' +
                            '<td class="py-3 px-6 border-b border-gray-200">' + $('#editEmail').val() + '</td>' +
                            '<td class="py-3 px-6 text-center border-b border-gray-200">' +
                            '<a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs editarDocenteBtn" data-id="' +
                            response.docente.id + '" data-nombre="' + $('#editNombre').val() + '" data-apellido="' +
                            $('#editApellido').val() + '" data-cedula="' + $('#editCedula').val() + '" data-email="' +
                            $('#editEmail').val() + '">' +
                            '<i class="fas fa-edit mr-1"></i> Editar</a>' +
                            '</td>';

                        $('tr[data-id="' + response.docente.id + '"]').html(updatedRow);
                        $('#editarDocenteForm').hide();
                    },
                    error: function(xhr) {
                        alert('Error al actualizar el docente.');
                    }
                });
            });
        });
    </script>
</x-app-layout>