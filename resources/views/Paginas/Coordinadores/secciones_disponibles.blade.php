<!-- resources/views/Paginas/Coordinadores/secciones_disponibles.blade.php -->

<x-app-layout>
    <h1 class="h1Docente">Coordinador: Inscribir estudiante</h1>
    
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading text-table-head">Panel de búsqueda para inscripción</div>
                <div class="panel-body">

            <form action="{{ route('sidebar.inscribir') }}" method="POST" class="mb-5">
                @csrf
                <div class="mb-4">
                    
                    <label class="text-default-black" for="grado_id" class="block text-gray-700">Grado</label>
                    <select name="grado_id" id="grado_id" class="form-control mt-1 block w-full" required>
                        <option value="">Seleccione un grado</option>
                        @foreach ($grados as $grado)
                            <option value="{{ $grado->id }}">{{ $grado->año }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="text-default-black" for="periodo_id" class="block text-gray-700">Periodo Académico</label>
                    <select name="periodo_id" id="periodo_id" class="form-control mt-1 block w-full" required>
                        <option value="">Seleccione un periodo académico</option>
                        @foreach ($periodos as $periodo)
                            <option value="{{ $periodo->id }}">{{ $periodo->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="ml-0 mt-0 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Realizar búsqueda
                </button>
            </form>
        </div>
    </div>
    
    </x-app-layout>