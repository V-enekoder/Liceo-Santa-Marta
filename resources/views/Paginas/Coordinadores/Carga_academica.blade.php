<x-app-layout>
    <div class="container">
        <h1 class="h1Docente text-center mb-4">Coordinador: Crear carga académica</h1>

        <!-- Estilos CSS -->
        <style>
            body {
                font-family: Arial, sans-serif;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .checkbox-list {
                list-style-type: none;
                padding: 0;
            }

            .checkbox-item {
                margin-bottom: 10px;
            }

            .checkbox-label {
                font-weight: bold;
            }

            .checkbox-input {
                margin-right: 10px;
            }

            .btn-primary {
                background-color: #007bff;
                color: #fff;
                border: none;
                padding: 10px 20px;
                cursor: pointer;
                border-radius: 4px;
                display: block;
                width: 100%;
                text-align: center;
            }

            .btn-primary:hover {
                background-color: #0056b3;
            }

            .invalid-feedback {
                color: red;
                font-size: 14px;
            }

            .alert {
                margin-top: 20px;
                padding: 10px;
                border-radius: 4px;
            }

            .alert-success {
                background-color: #d4edda;
                border-color: #c3e6cb;
                color: #155724;
            }

            .alert-danger {
                background-color: #f8d7da;
                border-color: #f5c6cb;
                color: #721c24;
            }

            /* Estilos adicionales para alinear los elementos en múltiples columnas */
            .row-cols-5 {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
            }

            .column {
                flex-basis: 100%;
                margin-bottom: 20px;
            }

            @media (min-width: 768px) {
                .row-cols-5 .column {
                    flex-basis: calc(20% - 20px);
                }
            }
        </style>

        <!-- Mostrar mensajes de éxito o error -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="ajuste-tablas">
            <div class="col-lg-4 mx-auto">
                <div class="panel panel-default">
                    <div class="panel-heading text-table-head">Crear Carga Académica</div>
                    <div class="panel-body">

                        <!-- Mostrar mensaje de estado -->
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('sidebar.formulario_carga_academica') }}">
                            @csrf
                            <div class="form-group">
                                <label class="text-default-black" for="docente_id">Docente</label>
                                <select id="docente_id" class="form-control @error('docente_id') is-invalid @enderror"
                                    name="docente_id" required>
                                    <option value="">Seleccionar Docente</option>
                                    @foreach ($docentes as $docente)
                                        <option value="{{ $docente->id }}">{{ $docente->primer_nombre }}
                                            {{ $docente->primer_apellido }}</option>
                                    @endforeach
                                </select>

                                <!-- Mostrar mensaje de error -->
                                @error('docente_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="text-default-black">Materias Disponibles</label>
                                <div class="row">
                                    @foreach ($grados as $grado)
                                        <div class="col-12">
                                            <h4>{{ $grado['año'] }}</h4>
                                            <ul class="checkbox-list">
                                                @foreach ($grado['materias'] as $materia)
                                                    <li class="checkbox-item">
                                                        <input id="materia_{{ $materia->id }}" type="checkbox"
                                                            class="checkbox-input" name="materias[]"
                                                            value="{{ $materia->id }}">
                                                        <label for="materia_{{ $materia->id }}"
                                                            class="checkbox-label">
                                                            {{ $materia->nombre }}
                                                        </label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Mostrar mensaje de error -->
                                @error('materias')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn-primary">Asignar Carga Académica</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
