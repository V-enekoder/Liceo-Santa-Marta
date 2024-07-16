<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    
    <h1 class="h1Docente">Coordinador: Crear sección</h1>
    
    <body>
        <div class="container mt-5 tablaDis widthFinal flexForms">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <label class="formTitle" >Crear sección</label>
        <div class="tablaDis2">
            <form action="{{ url('/dashboard/crear-seccion') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="text-default-black" for="grado_id">Grado</label>
                    <select class="form-control" id="grado_id" name="grado_id" required>
                        <option value="">Seleccione un grado</option>
                        @foreach ($grados as $grado)
                            <option value="{{ $grado->id }}">{{ $grado->año }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="form-group">
                    <label class="text-default-black" for="periodo_id">Periodo</label>
                    <select class="form-control" id="periodo_id" name="periodo_id" required>
                        <option value="">Seleccione un periodo</option>
                        @foreach ($periodos as $periodo)
                            <option value="{{ $periodo->id }}">{{ $periodo->nombre }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="form-group">
                    <label class="text-default-black" for="capacidad">Capacidad</label>
                    <input type="number" class="form-control" id="capacidad" name="capacidad"
                        value="{{ old('capacidad', 40) }}" min="1">
                </div>
    
                <div class="form-group">
                    <label class="text-default-black" for="nombre">Nombre de la Sección</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $nombre }}"
                        readonly>
                </div>
        </div>
    
                <button type="submit" class="mt-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear Sección</button>
            </form>
        </div>
    </body>
    
    </html>
    
    </x-app-layout>