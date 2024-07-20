<div class="container dflexFix">
    <h1 class="h1Docente mb-4">Coordinador: Reportes de cargas académicas</h1>

    <div class="col-lg-6 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading text-table-head">Panel de visualización</div>
            <div class="panel-body">

                <div class="card-body">
                    <form id="cargaAcademicaForm" method="POST">
                        @csrf

                        <div class="form-group row">
                            <label class="text-default-black" for="persona_id"
                                class="col-md-4 col-form-label text-md-right">Seleccione Persona:</label>
                            <div class="col-md-6">
                                <select id="persona_id" class="form-control @error('persona_id') is-invalid @enderror"
                                    name="persona_id" required>
                                    <option value="">Seleccione una persona</option>
                                    @foreach ($personas as $persona)
                                        <option value="{{ $persona->id }}"
                                            {{ old('persona_id') == $persona->id ? 'selected' : '' }}>
                                            {{ $persona->primer_nombre }} {{ $persona->primer_apellido }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('persona_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="text-default-black" for="periodo_id"
                                class="col-md-4 col-form-label text-md-right">Seleccione Período Académico:</label>
                            <div class="col-md-6">
                                <select id="periodo_id" class="form-control @error('periodo_id') is-invalid @enderror"
                                    name="periodo_id" required>
                                    <option value="">Seleccione un período académico</option>
                                    @foreach ($periodos as $periodo)
                                        <option value="{{ $periodo->id }}"
                                            {{ old('periodo_id') == $periodo->id ? 'selected' : '' }}>
                                            {{ $periodo->nombre }} (ID: {{ $periodo->id }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('periodo_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit"
                                    class="mt-5 mb-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Buscar</button>
                            </div>
                        </div>
                    </form>

                    @isset($materias)
                        <div class="mt-4">
                            <h5>Materias Asignadas:</h5>
                            <ul>
                                @forelse ($materias as $materia)
                                    <li>{{ $materia->nombre }}</li>
                                @empty
                                    <li>No se encontraron materias asignadas para este docente en el período especificado.
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    @endisset

                    @isset($error)
                        <div class="alert alert-danger mt-4">
                            {{ $error }}
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#cargaAcademicaForm').submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: '{{ route('carga_academica.obtener') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Construir el mensaje con los detalles de la carga académica
                    var mensaje = 'Carga académica obtenida exitosamente:\n';
                    response.materias.forEach(function(materia) {
                        mensaje += 'Año: ' + materia.grado_id +
                            ' | Materia: ' + materia.nombre + '\n';
                    });

                    // Mostrar ventana emergente en caso de éxito
                    alert(mensaje);
                },
                error: function(xhr) {
                    var errorMessage = 'Error al obtener la carga académica.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    // Mostrar ventana emergente en caso de error
                    alert(errorMessage);
                }
            });
        });
    });
</script>
