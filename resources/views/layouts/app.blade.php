<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="app.css">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-white flex">
        <!-- Sidebar -->
        <div
            class="bg-blue-900 text-white w-64 fixed top-0 left-0 h-screen overflow-y-auto transform -translate-x-full md:translate-x-0 transition duration-300 z-10">
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
                            x-transition:leave-end="transform opacity-0 scale-95" class="submenu ml-4 space-y-2">
                            <li><a href="{{ route('sidebar.periodos') }}" class="block p-2 hover:bg-gray-800">Crear
                                    período académico</a></li>
                            <li><a href="{{ route('sidebar.crearseccion') }}" class="block p-2 hover:bg-gray-800">Crear
                                    sección</a></li>
                            <li><a href="{{ route('sidebar.crearpersona') }}" class="block p-2 hover:bg-gray-800">Crear
                                    persona</a></li>
                            <li><a href="{{ route('sidebar.formulario_carga_academica') }}"
                                    class="block p-2 hover:bg-gray-800">Crear carga académica</a></li>
                            <li><a href="{{ route('sidebar.inscribir') }}" class="block p-2 hover:bg-gray-800">Inscribir
                                    estudiante</a></li>
                            <li><a href="{{ route('sidebar.modificar_calificacion') }}"
                                    class="block p-2 hover:bg-gray-800">Modificar calificaciones</a></li>
                            <li><a href="{{ route('sidebar.modirepresentantes') }}"
                                    class="block p-2 hover:bg-gray-800">Modificación de datos representante</a></li>
                            <li><a href="{{ route('sidebar.modiestudiantes') }}"
                                    class="block p-2 hover:bg-gray-800">Modificación de datos estudiante</a></li>
                            <li><a href="{{ route('sidebar.modidocentes') }}"
                                    class="block p-2 hover:bg-gray-800">Modificación datos de Docente</a></li>
                            <li><a href="{{ route('sidebar.materias') }}" class="block p-2 hover:bg-gray-800">Modificar
                                    datos de materias</a></li>
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
                            x-transition:leave-end="transform opacity-0 scale-95" class="submenu ml-4 space-y-2">
                            <li><a href="{{ route('sidebar.CargaNotas') }}" class="block p-2 hover:bg-gray-800">Cargar
                                    notas</a></li>
                            <li><a href="{{ route('sidebar.VerSecciones') }}" class="block p-2 hover:bg-gray-800">Ver
                                    secciones de clases</a></li>
                            <li><a href="{{ route('sidebar.VerSecciones') }}" class="block p-2 hover:bg-gray-800">Mi
                                    carga académica</a></li>
                        </ul>
                    </li>
                    <li x-data="{ open: false }">
                        <a href="#" class="p-2 font-semibold hover:bg-gray-700 flex items-center justify-between"
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
                            x-transition:leave-end="transform opacity-0 scale-95" class="submenu ml-4 space-y-2">
                            <li><a href="{{ route('sidebar.mostrar_boletin') }}"
                                    class="block p-2 hover:bg-gray-800">Ver boletin de calificaciones</a></li>
                            <li><a href="{{ route('boletin.indexTodo') }}" class="block p-2 hover:bg-gray-800">Consulta
                                    de boletines académicos</a></li>
                            <li><a href="{{ route('Ficha.index') }}" class="block p-2 hover:bg-gray-800">Ficha del
                                    estudiante</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div class="flex-1 min-h-screen bg-white">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-blue-900 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="flex-1 max-w-screen-lg mx-80 mt-5">
                @yield('content')
                {{-- $slot --}}
            </main>
        </div>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
