<x-app-layout>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Periodo Académico</title>
</head>

<body>
    <form action="{{ route('sidebar.periodos') }}" method="POST">
        @csrf
        <button class="ml-60 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Crear Periodo Académico</button>
    </form>

    @if (request()->isMethod('post')) {{-- Verifica si se ha enviado el formulario --}}
        @if (session('success'))
            <div>{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div>{{ session('error') }}</div>
        @endif
    @endif
</body>

</html>
</x-app-layout>