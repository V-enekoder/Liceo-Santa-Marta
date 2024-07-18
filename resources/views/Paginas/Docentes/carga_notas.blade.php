<x-app-layout>
    <h1 class="h1Docente">Carga de notas</h1>

    <div class="ajuste-tablas">

        <!-- PANEL DE CARGAS ACADÉMICAS -->
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading text-table-head">Panel de cargas académicas</div>
                <div class="panel-body">
                    <!-- Formulario de búsqueda de asignatura -->
                    <form class="form-signin" id="materiaForm" autocomplete="on">
                        <label class="text-default-black">Buscar asignatura</label>
                        <div class="input-group" style="width:100%">
                            <select id="materia_select" class="form-control" name="materia_id">
                                <option value="">Selecciona una asignatura</option>
                                @foreach ($materias as $materia)
                                    <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
                                @endforeach
                            </select>
                            <span class="input-group-addon"
                                style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- FORMULARIO DE CARGA DE NOTAS -->
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading text-table-head">Formulario de carga de notas</div>
                <div class="panel-body">
                    <!-- Mostrar el nombre del periodo académico -->
                    <h3>{{ $periodo->nombre }}</h3>

                    <!-- Notificación de error -->
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Formulario para cargar notas -->
                    <form class="form-signin" id="cargaNotasForm" autocomplete="off" action="{{ route('subir_notas') }}"
                        method="POST">
                        @csrf
                        <input type="hidden" id="docente_id" name="docente_id" value="{{ $docente->id }}">
                        <div class="form-group">
                            <label for="cedula_estudiante" class="text-default-black">Cédula del estudiante</label>
                            <input type="text" class="form-control" id="cedula_estudiante" name="cedula_estudiante"
                                required>
                        </div>

                        <!-- Espacios para las calificaciones de los 3 lapsos -->
                        <div class="form-group">
                            <label for="lapso1" class="text-default-black">Lapso 1</label>
                            <input type="number" class="form-control" id="lapso1" name="lapso1" min="1"
                                max="20" step="1">
                        </div>
                        <div class="form-group">
                            <label for="lapso2" class="text-default-black">Lapso 2</label>
                            <input type="number" class="form-control" id="lapso2" name="lapso2" min="1"
                                max="20" step="1">
                        </div>
                        <div class="form-group">
                            <label for="lapso3" class="text-default-black">Lapso 3</label>
                            <input type="number" class="form-control" id="lapso3" name="lapso3" min="1"
                                max="20" step="1">
                        </div>

                        <!-- Campo oculto para enviar el ID del periodo académico -->
                        <input type="hidden" id="periodo_id" name="periodo_id" value="{{ $periodo->id }}">

                        <!-- Campo oculto para enviar el ID de la materia seleccionada -->
                        <input type="hidden" id="materia_id" name="materia_id" value="">

                        <button type="submit" class="btn btn-success form-control text-default"
                            onclick="updateMateriaId()">Guardar notas</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateMateriaId() {
            var materiaSelect = document.getElementById('materia_select');
            var materiaIdInput = document.getElementById('materia_id');

            materiaIdInput.value = materiaSelect.value;
        }
    </script>
</x-app-layout>
