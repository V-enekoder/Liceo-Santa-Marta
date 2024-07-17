<x-app-layout>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Docentes</h1>
    </div>

    <div class="container mx-auto px-4">
        <div class="overflow-x-auto">
            <table class="table-auto w-full mt-4 bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
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
                <tbody class="text-gray-800">
                    <tr>
                        <td class="py-3 px-6 text-center">02</td>
                        <td class="py-3 px-6 text-center">Nombre</td>
                        <td class="py-3 px-6 text-center">Apellido</td>
                        <td class="py-3 px-6 text-center">30.501.253</td>
                        <td class="py-3 px-6 text-center">user</td>
                        <td class="py-3 px-6 text-center">********</td>
                        <td class="py-3 px-6 text-center">
                            <a href="#" class="text-blue-500 hover:text-blue-700 font-bold">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-3 px-6 text-center">03</td>
                        <td class="py-3 px-6 text-center">Nombre</td>
                        <td class="py-3 px-6 text-center">Apellido</td>
                        <td class="py-3 px-6 text-center">30.501.254</td>
                        <td class="py-3 px-6 text-center">user2</td>
                        <td class="py-3 px-6 text-center">********</td>
                        <td class="py-3 px-6 text-center">
                            <a href="#" class="text-blue-500 hover:text-blue-700 font-bold">
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

