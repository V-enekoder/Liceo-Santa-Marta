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
