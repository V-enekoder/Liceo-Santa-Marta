    <div class="container dflexFix">
        <h1 class="h1Docente mb-4">Coordinador: Crear sección</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="col-lg-6 mx-auto">
            <div class="panel panel-default">
                <div class="panel-heading text-table-head">Panel de crear sección</div>
                <div class="panel-body">
                    <form id="crearSeccionForm" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="text-default-black" for="grado_id">Grado</label>
                            <select class="form-control" id="grado_id" name="grado_id" required>
                                <option value="">Seleccione un grado</option>
                                @foreach ($grados as $grado)
                                    <option value="{{ $grado->id }}">{{ $grado->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="text-default-black" for="capacidad">Capacidad</label>
                            <input type="number" class="form-control" id="capacidad" name="capacidad"
                                value="{{ old('capacidad', 40) }}" min="1" required>
                        </div>

                        <button type="submit"
                            class="mt-5 mb-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear
                            sección</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#crearSeccionForm').submit(function(event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: '{{ url('/dashboard/crear-seccion') }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Mostrar ventana emergente en caso de éxito
                        alert('Sección creada exitosamente: \n' +
                            'ID: ' + response.seccion.id + '\n' +
                            'Capacidad: ' + response.seccion.capacidad + '\n' +
                            'Grado/Año: ' + response.seccion.grado_periodo_id + '\n' +
                            'Seccion: ' + response.seccion.nombre);

                        // Redireccionar o realizar cualquier otra acción necesaria
                        window.location.reload();
                    },
                    error: function(xhr) {
                        var errorMessage = 'Error al crear la sección.';
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
