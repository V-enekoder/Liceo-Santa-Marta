<x-app-layout>
    <h1 class="text-3xl font-bold text-center mb-8">Cargas Académicas</h1>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Asignar Carga Académica</h2>

            <form action="#" method="POST"> 
                @csrf 
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="periodo_id" class="block text-sm font-medium text-gray-700">Período Académico:</label>
                        <select name="periodo_id" id="periodo_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">-- Selecciona un período --</option>
                            <option value="1">Período 2023-2</option>
                            <option value="2">Período 2024-1</option> 
                        </select>
                    </div>
                </div>

                <div class="mt-6">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Docente
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cursos Asignados
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Acciones</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr> 
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Juan Pérez</div> 
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <select name="carga[1][cursos][]" multiple class="form-multiselect block w-full" id="carga-1"> 
                                        <option value="1">Matemáticas I</option>
                                        <option value="2">Física Básica</option> 
                                        <option value="3" selected>Programación I</option> 
                                    </select>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                </td>
                            </tr>
                            <tr> 
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Ana López</div> 
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <select name="carga[2][cursos][]" multiple class="form-multiselect block w-full" id="carga-2"> 
                                        <option value="4" selected>Química Orgánica</option>
                                        <option value="5" selected>Biología Celular</option> 
                                    </select>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                </td>
                            </tr>

                            
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-75 transition ease-in-out duration-150">
                        Guardar Carga Académica
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>