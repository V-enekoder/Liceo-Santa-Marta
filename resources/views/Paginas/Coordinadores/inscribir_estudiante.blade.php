<x-app-layout>

<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="h1Docente">Coordinador: Inscribir estudiante</h1>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading text-table-head">Panel de búsqueda para inscripción</div>
                    <div class="panel-body">
                    <form action="{{ route('inscribir_estudiante') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="text-default-black" for="seccion_id">Sección</label>
                            <select name="seccion_id" id="seccion_id" class="form-control" required>
                                <option value="">Seleccione una sección</option>
                                @foreach ($secciones as $seccion)
                                    <option value="{{ $seccion->id }}">{{ $seccion->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="text-default-black" for="cedula_estudiante">Cédula del Estudiante</label>
                            <input type="text" name="cedula_estudiante" id="cedula_estudiante" class="form-control"
                                required>
                        </div>
                        <button type="submit"
                        class="mt-5 mb-0 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Inscribir</button>
                    </form>

                    @if (session('message'))
                        <div class="alert alert-success mt-3">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger mt-3">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
