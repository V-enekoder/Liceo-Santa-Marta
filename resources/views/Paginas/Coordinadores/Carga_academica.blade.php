<x-app-layout> 

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

    <!-- Mostrar errores de validación -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="container dflexFix">
        <h1 class="h1Docente text-center mb-4">Coordinador: Crear carga académica</h1>
        <div class="ajuste-tablas">
            <div class="col-lg-4 mx-auto">
                <div class="panel panel-default">
                    <div class="panel-heading text-table-head">Crear Carga Académica</div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('sidebar.formulario_carga_academica') }}">
                            @csrf
                            <div class="form-group">
                                <label class="text-default-black" for="persona_id">Persona</label>
                                <select id="persona_id" class="form-control @error('persona_id') is-invalid @enderror"
                                    name="persona_id" required>
                                    <option value="">Seleccionar Persona</option>
                                    @foreach ($personas as $persona)
                                        <option value="{{ $persona->id }}">{{ $persona->primer_nombre }}
                                            {{ $persona->primer_apellido }}</option>
                                    @endforeach
                                </select>
                                <!-- Mostrar mensaje de error -->
                                @error('persona_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="text-default-black">Materias Disponibles</label>
                                <table class="table table-striped table-bordered table-hover" style="border-radius: 8px;">
                                    <thead>
                                        <tr>
                                            <th>Grado</th>
                                            <th>Materia</th>
                                            <th>Asignar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="materias-tbody">
                                        @foreach ($materias as $index => $materia)
                                            <tr class="{{ $index % 2 == 0 ? 'even' : 'odd' }}">
                                                <td class="py-0 px-6 border-b border-gray-200">{{ $materia->grado->nombre }}</td>
                                                <td class="py-0 px-6 border-b border-gray-200">{{ $materia->nombre }}</td>
                                                <td class="py-0 px-6 border-b border-gray-200">
                                                    <input id="materia_{{ $materia->id }}" type="checkbox" class="checkbox-input" name="materias[]" value="{{ $materia->id }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div id="pagination-container" class="pagination-container"></div>
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
    
    <!-- Estilos CSS adicionales -->
    <style>
        .even {
            background-color: #f9f9f9;
        }
        .odd {
            background-color: #ffffff;
        }
    </style>
    
    <!-- Script de paginación -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rowsPerPage = 8;
            const rows = document.querySelectorAll('#materias-tbody tr');
            const paginationContainer = document.getElementById('pagination-container');
            
            function displayRows(startIndex) {
                rows.forEach((row, index) => {
                    row.style.display = index >= startIndex && index < startIndex + rowsPerPage ? '' : 'none';
                });
            }
    
            function setupPagination() {
                const totalPages = Math.ceil(rows.length / rowsPerPage);
                paginationContainer.innerHTML = '';
                for (let i = 0; i < totalPages; i++) {
                    const pageButton = document.createElement('button');
                    pageButton.textContent = i + 1;
                    pageButton.classList.add('pagination-button');
                    pageButton.addEventListener('click', () => {
                        displayRows(i * rowsPerPage);
                    });
                    paginationContainer.appendChild(pageButton);
                }
            }
    
            displayRows(0);
            setupPagination();
        });
    </script>

</x-app-layout>
