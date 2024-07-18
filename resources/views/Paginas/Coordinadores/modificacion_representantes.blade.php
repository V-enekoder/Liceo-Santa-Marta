<x-app-layout>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Gestión de Representantes</h1>
    </div>

    <div class="container mx-auto px-4">
        <table class="table-auto w-full mt-4">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-center">ID</th>
                    <th class="py-3 px-6 text-center">Nombre</th>
                    <th class="py-3 px-6 text-center">Apellido</th>
                    <th class="py-3 px-6 text-center">Cédula</th>
                    <th class="py-3 px-6 text-center">Correo</th>
                    <th class="py-3 px-6 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody id="table-body" class="text-gray-800">
                @foreach($representantes as $representante)
                    <tr data-id="{{ $representante->id }}">
                        <td class="py-3 px-6 border-b border-gray-200">{{ $representante->id }}</td>
                        <td class="py-3 px-6 border-b border-gray-200">{{ $representante->user->persona->primer_nombre }}</td>
                        <td class="py-3 px-6 border-b border-gray-200">{{ $representante->user->persona->primer_apellido }}</td>
                        <td class="py-3 px-6 border-b border-gray-200">{{ $representante->user->persona->cedula }}</td>
                        <td class="py-3 px-6 border-b border-gray-200">{{ $representante->user->email }}</td>
                        <td class="py-3 px-6 text-center border-b border-gray-200">
                            <a href="#"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs editarRepresentanteBtn"
                                data-id="{{ $representante->id }}" data-nombre="{{ $representante->user->persona->primer_nombre }}"
                                data-apellido="{{ $representante->user->persona->primer_apellido }}" data-cedula="{{ $representante->user->persona->cedula }}"
                                data-email="{{ $representante->user->email }}">
                                <i class="fas fa-edit mr-1"></i> Editar
                            </a>
                            <button
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs eliminarRepresentanteBtn"
                                data-id="{{ $representante->id }}">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Formulario para editar representante -->
    <div id="editarRepresentanteForm" style="display: none;">
        <form id="formEditarRepresentante" method="POST">
            @csrf
            @method('PUT')
            <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                <div class="bg-white p-4 rounded">
                    <h1 class="text-xl font-bold mb-4">Editar Representante</h1>
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
            // Mostrar el formulario para editar representante
            $(document).on('click', '.editarRepresentanteBtn', function() {
                var id = $(this).data('id');
                var nombre = $(this).data('nombre');
                var apellido = $(this).data('apellido');
                var cedula = $(this).data('cedula');
                var email = $(this).data('email');

                $('#editNombre').val(nombre);
                $('#editApellido').val(apellido);
                $('#editCedula').val(cedula);
                $('#editEmail').val(email);

                $('#formEditarRepresentante').attr('action', '/dashboard/dataRepresentantes/' + id);
                $('#editarRepresentanteForm').show();
            });

            $('#cancelarEditarBtn').click(function() {
                $('#editarRepresentanteForm').hide();
            });

            $('#formEditarRepresentante').submit(function(event) {
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
                            response.representante.id + '</td>' +
                            '<td class="py-3 px-6 border-b border-gray-200">' + $('#editNombre').val() + '</td>' +
                            '<td class="py-3 px-6 border-b border-gray-200">' + $('#editApellido').val() + '</td>' +
                            '<td class="py-3 px-6 border-b border-gray-200">' + $('#editCedula').val() + '</td>' +
                            '<td class="py-3 px-6 border-b border-gray-200">' + $('#editEmail').val() + '</td>' +
                            '<td class="py-3 px-6 text-center border-b border-gray-200">' +
                            '<a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs editarRepresentanteBtn" data-id="' +
                            response.representante.id + '" data-nombre="' + $('#editNombre').val() + '" data-apellido="' +
                            $('#editApellido').val() + '" data-cedula="' + $('#editCedula').val() + '" data-email="' +
                            $('#editEmail').val() + '">' +
                            '<i class="fas fa-edit mr-1"></i> Editar</a>' +
                            '<button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs eliminarRepresentanteBtn" data-id="' +
                            response.representante.id + '">Eliminar</button>' +
                            '</td>';

                        $('tr[data-id="' + response.representante.id + '"]').html(updatedRow);
                        $('#editarRepresentanteForm').hide();
                    },
                    error: function(xhr) {
                        alert('Error al actualizar el representante.');
                    }
                });
            });

            // Eliminar un representante
            $(document).on('click', '.eliminarRepresentanteBtn', function() {
                var id = $(this).data('id');

                if (confirm('¿Estás seguro de que deseas eliminar este representante?')) {
                    $.ajax({
                        url: '/dashboard/dataRepresentantes/' + id,
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
                            alert('Error al eliminar el representante.');
                        }
                    });
                }
            });
        });
    </script>
</x-app-layout>