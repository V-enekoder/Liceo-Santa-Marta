<!-- resources/views/Paginas/Coordinadores/Profesores.blade.php -->
<x-app-layout>
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Gestión de Docentes</h1>
    </div>

    <div class="overflow-x-auto">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden mx-auto max-w-6xl">
            <table id="table-docentes" class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-200 text-gray-600 uppercase text-xs leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-center">ID</th>
                        <th class="py-3 px-6 text-center">Nombre</th>
                        <th class="py-3 px-6 text-center">Apellido</th>
                        <th class="py-3 px-6 text-center">Cédula</th>
                        <th class="py-3 px-6 text-center">Usuario</th>
                        <th class="py-3 px-6 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody id="table-body" class="text-gray-800 divide-y divide-gray-200">
                    @foreach($docentes as $docente)
                        <tr class="hover:bg-gray-100">
                            <td class="py-4 px-6 text-center">{{ $docente->id }}</td>
                            <td class="py-4 px-6 text-center">{{ $docente->user->persona->primer_nombre }}</td>
                            <td class="py-4 px-6 text-center">{{ $docente->user->persona->primer_apellido }}</td>
                            <td class="py-4 px-6 text-center">{{ $docente->user->persona->cedula }}</td>
                            <td class="py-4 px-6 text-center">{{ $docente->user->email }}</td>
                            <td class="py-4 px-6 text-center">
                                <button onclick="editDocente({{ $docente }})" class="text-blue-500 hover:text-blue-700 font-bold transition duration-300">
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para editar docente -->
    <div id="editModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- Contenido del Modal -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Editar Docente
                            </h3>
                            <div class="mt-2">
                                <form id="editDocenteForm" action="{{ route('sidebar.updateDocente', 0) }}" method="PUT">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="editNombre" class="block text-gray-700">Nombre</label>
                                        <input type="text" name="nombre" id="editNombre" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="editApellido" class="block text-gray-700">Apellido</label>
                                        <input type="text" name="apellido" id="editApellido" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="editCedula" class="block text-gray-700">Cédula</label>
                                        <input type="text" name="cedula" id="editCedula" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="editEmail" class="block text-gray-700">Usuario (Email)</label>
                                        <input type="email" name="email" id="editEmail" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="submitEditForm()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">Guardar Cambios</button>
                    <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
<script>
    function editDocente(docente) {
        document.getElementById('editNombre').value = docente.user.persona.primer_nombre;
        document.getElementById('editApellido').value = docente.user.persona.primer_apellido;
        document.getElementById('editCedula').value = docente.user.persona.cedula;
        document.getElementById('editEmail').value = docente.user.email;
        document.getElementById('editDocenteForm').action = `/docente/${docente.id}/update`;

        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    function submitEditForm() {
        document.getElementById('editDocenteForm').submit();
    }

    // Script para efecto de resaltado al pasar el mouse sobre filas
    const rows = document.querySelectorAll('#table-body tr');
    rows.forEach(row => {
        row.addEventListener('mouseover', () => {
            row.classList.add('bg-blue-100');
        });
        row.addEventListener('mouseout', () => {
            row.classList.remove('bg-blue-100');
        });
    });
</script>
@endpush