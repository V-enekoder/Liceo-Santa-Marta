<x-app-layout>

    <head>
        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    </head>
    <!-- Contenido principal -->
    <div class="flex justify-center items-center h-screen">
        <div class="bg-white p-8 rounded shadow-md w-1/2">
            <h1 style="font-family: 'Arial', sans-serif; font-size: 30px" class="text-center">Vincular Estudiante y
                Representante</h1>

            <!-- Mensajes de éxito y error -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('sidebar.vincular_representante') }}">
                @csrf
                <div class="mb-4">
                    <label for="cedula_representante" class="block text-gray-700 text-sm font-bold mb-2">Cédula del
                        Representante:</label>
                    <input type="text" name="cedula_representante" value="{{ old('cedula_representante') }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('cedula_representante')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="cedula_estudiante" class="block text-gray-700 text-sm font-bold mb-2">Cédula del
                        Estudiante:</label>
                    <input type="text" name="cedula_estudiante" value="{{ old('cedula_estudiante') }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('cedula_estudiante')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="periodo_id" class="block text-gray-700 text-sm font-bold mb-2">ID del Período
                        Académico:</label>
                    <select name="periodo_id"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @foreach ($periodos as $periodo)
                            <option value="{{ $periodo->id }}">{{ $periodo->nombre }}</option>
                        @endforeach
                    </select>
                    @error('periodo_id')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Vincular Estudiante y Representante
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
