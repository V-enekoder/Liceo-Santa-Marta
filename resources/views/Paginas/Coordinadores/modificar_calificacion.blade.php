<x-app-layout>
    <h1 class="h1Docente">Coordinador: Modificar calificaciones</h1>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif


    <div class="row ajuste-tablas">
        <!-- Panel de Modificar Notas -->
        <div class="col-lg-4">
            <div class="panel panel-default widthFix">
                <div class="panel-heading text-table-head">Panel de modificar notas</div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('sidebar.modificar_calificacion') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="text-default-black" for="periodo_id" class="col-md-4 col-form-label text-md-right">Período Académico</label>
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
                            <label class="text-default-black" for="materia_id" class="col-md-4 col-form-label text-md-right">Materia</label>
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
                            <label class="text-default-black" for="cedula_estudiante" class="col-md-4 col-form-label text-md-right">Cédula Estudiante</label>
                            <div class="col-md-6">
                                <input id="cedula_estudiante" type="number" class="form-control" name="cedula_estudiante" required>
                                @error('cedula_estudiante')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="text-default-black" for="lapso_1" class="col-md-4 col-form-label text-md-right">Lapso 1</label>
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
                            <label class="text-default-black" for="lapso_2" class="col-md-4 col-form-label text-md-right">Lapso 2</label>
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
                            <label class="text-default-black" for="lapso_3" class="col-md-4 col-form-label text-md-right">Lapso 3</label>
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
                                <button type="submit" class="mt-5 mb-5 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Actualizar calificación</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Panel de Materias -->
<div class="col-lg-4">
    <div class="panel panel-default ml-7">
        <div class="panel-heading text-table-head">Panel de materias</div>
        <div class="panel-body">
            <table class="table table-striped table-bordered table-hover" style="border-radius: 8px;">
                <thead>
                    <tr>
                        <th>Grado</th>
                        <th>Materia</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($materias as $materia)
                        <tr role="row" class="{{ $loop->even ? 'even' : 'odd' }}">
                            <td style="font-weight: bold">{{ $materia->grado->nombre }}</td>
                            <td>{{ $materia->nombre }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


        <!-- Panel de Estudiantes -->
        <div class="col-lg-3">
            <div class="panel panel-default ml-7">
                <div class="panel-heading text-table-head">Panel de estudiantes</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" style="border-radius: 8px;">
                            <thead>
                                <tr>
                                    <th>Cédula</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estudiantes as $estudiante)
                                    <tr role="row" class="{{ $loop->even ? 'even' : 'odd' }}">
                                        <td style="font-weight: bold">{{ $estudiante->cedula }}</td>
                                        <td>{{ $estudiante->primer_nombre }}</td>
                                        <td>{{ $estudiante->primer_apellido }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        


</x-app-layout>