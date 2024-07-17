<x-app-layout>
    <div class="container">
        <h1 class="h1Docente text-center mb-4">Coordinador: Crear sección</h1>

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
                    <form action="{{ url('/dashboard/crear-seccion') }}" method="POST">
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

                        <button type="submit" class="mt-3 btn btn-primary btn-block">Crear Sección</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
