<x-app-layout>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Períodos Académicos</h1>
        <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-plus mr-2"></i> Agregar Período
        </a>
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
                        <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs">
                            <i class="fas fa-edit mr-1"></i> Editar
                        </a>
                    </td>
                </tr>
                <tr> 
                    <td class="py-3 px-6 border-b border-gray-200">2022-2023</td>
                    <td class="py-3 px-6 border-b border-gray-200">20-09-2022</td>
                    <td class="py-3 px-6 border-b border-gray-200">30-06-2023</td>
                    <td class="py-3 px-6 text-center border-b border-gray-200">
                        <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs">
                            <i class="fas fa-edit mr-1"></i> Editar
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>