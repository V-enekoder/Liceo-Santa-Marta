<x-app-layout>

    <!DOCTYPE html>
    <html lang="es">
    
    <h1 class="h1Docente">Coordinador: Inscribir estudiante</h1>
    
    <body>
        <div class="container mt-5 tablaDis widthFinal flexForms">
            <label class="formTitle" >Formulario de inscripción</label>
            <form action="{{ route('inscribir_estudiante') }}" method="POST">
                @csrf
                <div class="form-group tablaDis2">
                    <label class="text-default-black" for="seccion_id">Sección</label>
                    <select name="seccion_id" id="seccion_id" class="form-control" required>
                        <option value="">Seleccione una sección</option>
                        @foreach ($secciones as $seccion)
                            <option value="{{ $seccion->id }}">{{ $seccion->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-3 tablaDis2">
                    <label class="text-default-black" for="cedula_estudiante">Cédula del Estudiante</label>
                    <input type="text" name="cedula_estudiante" id="cedula_estudiante" class="form-control" required>
                </div>
                <button type="submit" class="ml-0 mt-8 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Inscribir</button>
            </form>
            @if (session('message'))
                <div class="alert alert-success mt-3 tablaDis2">
                    {{ session('message') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger mt-3">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </body>
    
    </html>
    
    </x-app-layout>