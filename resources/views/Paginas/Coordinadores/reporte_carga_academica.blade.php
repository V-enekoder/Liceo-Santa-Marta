    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Carga Académica</div>

                    <div class="card-body">
                        <form action="{{ route('carga_academica.obtener') }}" method="POST">
                            @csrf

                            <div class="form-group row">
                                <label for="persona_id" class="col-md-4 col-form-label text-md-right">Seleccione
                                    Persona:</label>

                                <div class="col-md-6">
                                    <select id="persona_id"
                                        class="form-control @error('persona_id') is-invalid @enderror" name="persona_id"
                                        required>
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
                                <label for="periodo_id" class="col-md-4 col-form-label text-md-right">Seleccione Período
                                    Académico:</label>

                                <div class="col-md-6">
                                    <select id="periodo_id"
                                        class="form-control @error('periodo_id') is-invalid @enderror" name="periodo_id"
                                        required>
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
                                    <button type="submit" class="btn btn-primary">
                                        Obtener Carga Académica
                                    </button>
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
                                        <li>No se encontraron materias asignadas para este docente en el período
                                            especificado.
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
