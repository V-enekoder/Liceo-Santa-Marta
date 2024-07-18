    <h1 class="h1Docente">Ver carga académica</h1>

    <div class="col-lg-8 panel-carga-academica">
        <div class="panel panel-default panel-carga-academica">
            <div class="panel-heading text-table-head">Carga actual</div>
            <div class="row">
                <div class="col-sm-12 padding-carga">
                    <table width="100%"
                        class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline"
                        id="dataTables" role="grid" aria-describedby="dataTables_info" style="width: 100%;">
                        <thead>
                            <tr role="row">
                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 100px;">ID</th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 300px;">
                                    Asignatura</th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 100px;">Año
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($materias as $materia)
                                <tr role="row" class="{{ $loop->odd ? 'odd' : 'even' }}">
                                    <th scope="row">{{ $materia->id }}</th>
                                    <td>{{ $materia->nombre }}</td>
                                    <td>{{ $materia->grado->nombre }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
