<!-- resources/views/estudiantes/mostrar.blade.php -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading text-table-head">Buscar Estudiante</div>
                <div class="panel-body">
                    <form action="{{ route('sidebar.buscar_estudiante') }}" method="GET">
                        @csrf
                        <div class="form-group">
                            <label for="cedula_estudiante" class="text-default-black">Cédula del Estudiante</label>
                            <input type="text" name="cedula_estudiante" id="cedula_estudiante" class="form-control"
                                required>
                        </div>
                        <button type="submit"
                            class="ml-0 mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Buscar Estudiante
                        </button>
                    </form>

                    @isset($estudiante)
                        <div class="mt-4">
                            <h2>Información del Estudiante</h2>
                            <ul class="list-group">
                                <li class="list-group-item"><strong>Cédula:</strong> {{ $estudiante->persona->cedula }}
                                </li>
                                <li class="list-group-item"><strong>Nombre:</strong>
                                    {{ $estudiante->persona->primer_nombre }}
                                    {{ $estudiante->persona->primer_apellido }}</li>
                                <li class="list-group-item"><strong>Fecha de Nacimiento:</strong>
                                    {{ $estudiante->persona->fecha_nacimiento }}</li>
                                <!-- Agregar más campos según sea necesario -->
                            </ul>
                        </div>
                    @endisset

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
