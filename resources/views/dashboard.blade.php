<x-app-layout>

    <head>
        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    </head>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex h-screen">
                <!-- Sidebar -->
                <div
                    class=" bg-blue-900 text-white w-64 fixed top-0 left-0 h-screen 
                overflow-y-auto transform -translate-x-full md:translate-x-0 transition duration-300">
                    <div class="p-4">
                        <div style="text-align: center;">
                            <i class="fa-solid fa-school icono-menu"></i>
                        </div>
                        <a href="{{ route('dashboard') }}" class="text-lg font-bold flex justify-center">
                            U.E.N Santa Marta
                        </a>
                        <hr class="mt-3 border-t border-white">
                        <ul class="space-y-4">
                            <li x-data="{ open: false }">
                                <a href="#"
                                    class="mt-10 font-semibold text-xl font p-2 hover:bg-gray-700 flex items-center justify-between"
                                    @click="open = !open">
                                    <div>
                                        <i class="fas fa-user-cog icono-side"></i>
                                        Coordinador
                                    </div>
                                    <i :class="{ 'rotate-180': open }"
                                        class="fas fa-chevron-down arrow transition-transform duration-200 ease-in-out"></i>
                                </a>
                                <ul x-show="open" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="submenu ml-4 space-y-2">
                                    <li><a href="#" class="block p-2 hover:bg-gray-800">Modificar notas</a></li>
                                    <li><a href="#" class="block p-2 hover:bg-gray-800">Modificar Usuarios</a>
                                    </li>
                                    <li><a href="#" class="block p-2 hover:bg-gray-800">Modificar sección</a></li>
                                    <li><a href="#" class="block p-2 hover:bg-gray-800">Modificar periodo
                                            acádemico</a></li>
                                    <li><a href="#" class="block p-2 hover:bg-gray-800">Modificar materia</a></li>
                                </ul>
                            </li>
                            <li x-data="{ open: false }">
                                <a href="#"
                                    class="p-2 font-semibold text-xl hover:bg-gray-700 flex items-center justify-between"
                                    @click="open = !open">
                                    <div>
                                        <i class="fa-solid fa-chalkboard-user icono-side"></i>
                                        Docente
                                    </div>
                                    <i :class="{ 'rotate-180': open }"
                                        class="fas fa-chevron-down arrow transition-transform duration-200 ease-in-out"></i>
                                </a>
                                <ul x-show="open" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="submenu ml-4 space-y-2">
                                    <li><a href="#" class="block p-2 hover:bg-gray-800">Cargar notas</a></li>
                                    <li><a href="#" class="block p-2 hover:bg-gray-800">Ver alumnos</a></li>
                                    <li><a href="#" class="block p-2 hover:bg-gray-800">Ver secciones</a></li>
                                </ul>
                            </li>
                            <li x-data="{ open: false }">
                                <a href="#"
                                    class=" p-2 font-semibold hover:bg-gray-700 flex items-center justify-between"
                                    style="font-size: 19px" @click="open = !open">
                                    <div>
                                        <i class="fa-solid fa-users icono-side"></i>
                                        Representante
                                    </div>
                                    <i :class="{ 'rotate-180': open }"
                                        class="fas fa-chevron-down arrow transition-transform duration-200 ease-in-out"></i>
                                </a>
                                <ul x-show="open" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="submenu ml-4 space-y-2">
                                    <li><a href="#" class="block p-2 hover:bg-gray-800">Ver calificaciones</a>
                                    </li>
                                    <li><a href="#" class="block p-2 hover:bg-gray-800">Ver materias</a></li>
                                    <li><a href="#" class="block p-2 hover:bg-gray-800">Ver información</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                <script>
                    function toggleSubmenu(element) {
                        const submenu = element.nextElementSibling;
                        submenu.classList.toggle("hidden");
                        submenu.classList.toggle("show"); // Añade 'show' al submenu visible
                    }
                </script>

                <!-- Contenido principal -->
                <div class="flex-1 p-4 ml-60">
                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
