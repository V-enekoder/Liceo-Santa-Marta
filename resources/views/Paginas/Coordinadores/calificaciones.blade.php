<!-- resources/views/inscripciones/index.blade.php -->

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Detalles de Inscripción</div>

                    <div class="card-body">
                        @if ($estudianteSeccion)
                            <p><strong>ID de Estudiante:</strong> {{ $estudianteSeccion->estudiante_id }}</p>
                            <p><strong>ID de Sección:</strong> {{ $estudianteSeccion->seccion_id }}</p>

                            <form action="{{ route('mostrar_inscripcion') }}" method="POST">
                                @csrf
                                <input type="hidden" name="estudiante_id" value="{{ $estudianteSeccion->estudiante_id }}">
                                <input type="hidden" name="seccion_id" value="{{ $estudianteSeccion->seccion_id }}">
                                <button type="submit" class="btn btn-primary">Crear Calificaciones</button>
                            </form>
                        @else
                            <p>No hay registros de inscripción disponibles.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
