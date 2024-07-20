<x-app-layout>

    <h1 class="h1Docente">Representante: Agregar teléfono</h1>

    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading text-table-head">Panel de agregar teléfono</div>
            <div class="panel-body">

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

            <form method="POST" action="{{ route('sidebar.agregar_telefono') }}">
                @csrf
                <div class="mb-4">
                    <label for="cedula" class="block text-gray-700 text-sm font-bold mb-2">Cédula:</label>
                    <input type="text" name="cedula" value="{{ $user->cedula }}" disabled
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="numero_telefonico" class="block text-gray-700 text-sm font-bold mb-2">Número
                        Telefónico:</label>
                    <input type="text" name="numero_telefonico"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Agregar Teléfono
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
