<x-app-layout>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Docentes</h1>
        <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-auto">
            <i class="fas fa-plus mr-2"></i> Agregar docente
        </a>
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
                    <th class="py-3 px-6 text-center">Contraseña</th>
                    <th class="py-3 px-6 text-center">Accciones</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                <tr>
                    <td class="py-3 px-6 border-b border-gray-200">02</td>
                    <td class="py-3 px-6 border-b border-gray-200">5to</td>
                    <td class="py-3 px-6 border-b border-gray-200">Psicología</td>
                    <td class="py-3 px-6 border-b border-gray-200">30.501.253</td>
                    <td class="py-3 px-6 border-b border-gray-200">user</td>
                    <td class="py-3 px-6 border-b border-gray-200">contraseña</td>
                    <td class="py-3 px-6 text-center border-b border-gray-200">
                        <a href="#"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs">
                            <i class="fas fa-edit mr-1"></i> Editar
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="py-3 px-6 border-b border-gray-200">02</td>
                    <td class="py-3 px-6 border-b border-gray-200">5to</td>
                    <td class="py-3 px-6 border-b border-gray-200">Psicología</td>
                    <td class="py-3 px-6 border-b border-gray-200">30.501.253</td>
                    <td class="py-3 px-6 border-b border-gray-200">user</td>
                    <td class="py-3 px-6 border-b border-gray-200">contraseña</td>
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
</x-app-layout>
