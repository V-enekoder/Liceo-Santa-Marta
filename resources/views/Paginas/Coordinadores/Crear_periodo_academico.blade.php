<x-app-layout>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Períodos Académicos</h1>
        <button onclick="document.getElementById('crearPeriodoModal').classList.remove('hidden')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-plus mr-2"></i> Agregar Período
        </button>
    </div>

    <div class="container mx-auto px-4">
        <table class="table-auto w-full">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Período</th>
                    <th class="py-3 px-6 text-left">Fecha inicio</th>
                    <th class="py-3 px-6 text-left">Fecha fin</th>
                    <th class="py-3 px-6 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                <tr>
                    <td class="py-3 px-6 border-b border-gray-200">2023-2024</td>
                    <td class="py-3 px-6 border-b border-gray-200">15-09-2023</td>
                    <td class="py-3 px-6 border-b border-gray-200">12-07-2024</td>
                    <td class="py-3 px-6 text-center border-b border-gray-200">
                        <a href="#"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs">
                            <i class="fas fa-edit mr-1"></i> Editar
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="py-3 px-6 border-b border-gray-200">2022-2023</td>
                    <td class="py-3 px-6 border-b border-gray-200">20-09-2022</td>
                    <td class="py-3 px-6 border-b border-gray-200">30-06-2023</td>
                    <td class="py-3 px-6 text-center border-b border-gray-200">
                        <a href="#"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs">
                            <i class="fas fa-edit mr-1"></i> Editar
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal para Crear Período Académico -->
    <div id="crearPeriodoModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="{{ route('coordinador.crear_periodo_academico') }}" method="POST">
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Crear Período Académico</h3>
                                <div class="mt-2">
                                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre del Período</label>
                                    <input type="text" name="nombre" id="nombre" placeholder="Nombre del Período" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                                    <label for="año_inicio" class="block text-sm font-medium text-gray-700 mt-4">Año Inicio</label>
                                    <input type="number" name="año_inicio" id="año_inicio" placeholder="Año Inicio" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                                    <label for="año_fin" class="block text-sm font-medium text-gray-700 mt-4">Año Fin</label>
                                    <input type="number" name="año_fin" id="año_fin" placeholder="Año Fin" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">Crear</button>
                        <button type="button" onclick="document.getElementById('crearPeriodoModal').classList.add('hidden')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>








{{--
<x-app-layout>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Períodos Académicos</h1>
        <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <button id="crearPeriodo">Crear Período Académico</button>
        </a>
    </div>

    <div class="container mx-auto px-4 mt-6">
        <table class="table-auto w-full">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Período</th>
                    <th class="py-3 px-6 text-left">Fecha inicio</th>
                    <th class="py-3 px-6 text-left">Fecha fin</th>
                    <th class="py-3 px-6 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                <tr>
                    <td class="py-3 px-6 border-b border-gray-200">2023-2024</td>
                    <td class="py-3 px-6 border-b border-gray-200">15-09-2023</td>
                    <td class="py-3 px-6 border-b border-gray-200">12-07-2024</td>
                    <td class="py-3 px-6 text-center border-b border-gray-200">
                        <a href="#"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs">
                            <i class="fas fa-edit mr-1"></i> Editar
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="py-3 px-6 border-b border-gray-200">2022-2023</td>
                    <td class="py-3 px-6 border-b border-gray-200">20-09-2022</td>
                    <td class="py-3 px-6 border-b border-gray-200">30-06-2023</td>
                    <td class="py-3 px-6 text-center border-b border-gray-200">
                        <a href="#"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs">
                            <i class="fas fa-edit mr-1"></i> Editar
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
<<<<<<< HEAD
</x-app-layout>
--}}




{{--

<!-- archivo.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Crear Período Académico</title>
</head>
<body>
    <div>
        <h1>Crear Período Académico</h1>
        <button id="crearPeriodo">Crear Período Académico</button>
    </div>
=======
>>>>>>> master

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#crearPeriodo').click(function() {
                $.ajax({
                    url: '{{ route('sidebar.periodos') }}',
                    type: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert('Período académico creado: ' + response.periodo_academico.nombre);
                        // Aquí podrías agregar más acciones después de crear el período académico
                    },
                    error: function(xhr) {
                        alert('Error al crear el período académico.');
                    }
                });
            });
        });
    </script>
</x-app-layout>

