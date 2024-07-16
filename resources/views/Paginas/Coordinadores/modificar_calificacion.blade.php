<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Calificación</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Modificar Calificación</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('sidebar.modificar_calificacion') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="periodo_id" class="col-md-4 col-form-label text-md-right">Período
                                    Académico</label>
                                <div class="col-md-6">
                                    <select id="periodo_id" name="periodo_id" class="form-control" required>
                                        @foreach ($periodos as $periodo)
                                            <option value="{{ $periodo->id }}">{{ $periodo->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('periodo_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="materia_id" class="col-md-4 col-form-label text-md-right">Materia</label>
                                <div class="col-md-6">
                                    <select id="materia_id" name="materia_id" class="form-control" required>
                                        @foreach ($materias as $materia)
                                            <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('materia_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cedula_estudiante" class="col-md-4 col-form-label text-md-right">Cédula
                                    Estudiante</label>
                                <div class="col-md-6">
                                    <input id="cedula_estudiante" type="number" class="form-control"
                                        name="cedula_estudiante" required>
                                    @error('cedula_estudiante')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lapso_1" class="col-md-4 col-form-label text-md-right">Lapso 1</label>
                                <div class="col-md-6">
                                    <input id="lapso_1" type="number" class="form-control" name="lapso_1">
                                    @error('lapso_1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lapso_2" class="col-md-4 col-form-label text-md-right">Lapso 2</label>
                                <div class="col-md-6">
                                    <input id="lapso_2" type="number" class="form-control" name="lapso_2">
                                    @error('lapso_2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lapso_3" class="col-md-4 col-form-label text-md-right">Lapso 3</label>
                                <div class="col-md-6">
                                    <input id="lapso_3" type="number" class="form-control" name="lapso_3">
                                    @error('lapso_3')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Actualizar Calificación
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Mostrar listas de materias y estudiantes -->
                        <div class="mt-4">
                            <h5>Materias:</h5>
                            <ul id="materias_list">
                                @foreach ($materias as $materia)
                                    <li>{{ $materia->grado->año }} - {{ $materia->nombre }}</li>
                                @endforeach
                            </ul>

                            <h5>Estudiantes:</h5>
                            <ul id="estudiantes_list">
                                @foreach ($estudiantes as $estudiante)
                                    <li>{{ $estudiante->primer_nombre }} {{ $estudiante->primer_apellido }} -
                                        {{ $estudiante->cedula }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
