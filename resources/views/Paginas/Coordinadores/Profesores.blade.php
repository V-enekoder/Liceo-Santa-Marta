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
                        <th class="py-3 px-6 text-center">Contraseña</th>
                        <th class="py-3 px-6 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody id="table-body" class="text-gray-800 divide-y divide-gray-200">
                    <tr class="hover:bg-gray-100">
                        <td class="py-4 px-6 text-center">01</td>
                        <td class="py-4 px-6 text-center">John</td>
                        <td class="py-4 px-6 text-center">Doe</td>
                        <td class="py-4 px-6 text-center">123456789</td>
                        <td class="py-4 px-6 text-center">johndoe</td>
                        <td class="py-4 px-6 text-center">********</td>
                        <td class="py-4 px-6 text-center">
                            <a href="#" class="text-blue-500 hover:text-blue-700 font-bold transition duration-300">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-100">
                        <td class="py-4 px-6 text-center">02</td>
                        <td class="py-4 px-6 text-center">Jane</td>
                        <td class="py-4 px-6 text-center">Smith</td>
                        <td class="py-4 px-6 text-center">987654321</td>
                        <td class="py-4 px-6 text-center">janesmith</td>
                        <td class="py-4 px-6 text-center">********</td>
                        <td class="py-4 px-6 text-center">
                            <a href="#" class="text-blue-500 hover:text-blue-700 font-bold transition duration-300">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                        </td>
                    </tr>
                    <!-- Más filas según los datos -->
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

@push('scripts')
<script>
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

