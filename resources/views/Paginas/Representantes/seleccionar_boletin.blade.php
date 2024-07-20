<head>
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
</head>
<!-- Contenido principal -->
<div class="flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-1/2">
        <h1 style="font-family: 'Arial', sans-serif; font-size: 30px" class="text-center">Seleccionar Estudiante y
            Grado</h1>

        <!-- Formulario para seleccionar estudiante y grado -->
        <form method="POST" action="{{ route('buscar.boletin') }}">
            @csrf
            <div class="mb-4">
                <label for="cedula_estudiante" class="block text-gray-700 text-sm font-bold mb-2">Cédula del
                    Estudiante:</label>
                <input type="text" name="cedula_estudiante" id="cedula_estudiante"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="Ingrese la cédula del estudiante">
                @error('cedula_estudiante')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="grado_id" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Grado:</label>
                <select name="grado_id" id="grado_id"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach ($grados as $grado)
                        <option value="{{ $grado->id }}">{{ $grado->nombre }}</option>
                    @endforeach
                </select>
                @error('grado_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Buscar Boletín
                </button>
            </div>
        </form>
    </div>
</div>
