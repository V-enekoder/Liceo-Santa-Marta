<x-app-layout>

    <h1 class="h1Docente">Docente: Cambiar contraseña</h1>
    <!-- Estilos CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #f0f0f0;
            padding: 10px;
            font-weight: bold;
        }

        .card-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
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
    </style>


<div class="col-lg-4">
    <div class="panel panel-default">
        <div class="panel-heading text-table-head">Panel de cambiar contraseña</div>
        <div class="panel-body">
                        <!-- Mostrar mensaje de estado -->
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('cambiar_clave') }}">
                            @csrf

                            <div class="form-group">
                                <label for="docente_id">ID del Docente</label>
                                <input id="docente_id" type="text"
                                    class="form-control @error('docente_id') is-invalid @enderror" name="docente_id"
                                    value="{{ old('docente_id') }}" required autofocus>

                                <!-- Mostrar mensaje de error -->
                                @error('docente_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nueva_contrasena">Nueva Contraseña</label>
                                <input id="nueva_contrasena" type="password"
                                    class="form-control @error('nueva_contrasena') is-invalid @enderror"
                                    name="nueva_contrasena" required>

                                <!-- Mostrar mensaje de error -->
                                @error('nueva_contrasena')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nueva_contrasena_confirmation">Confirmar Nueva Contraseña</label>
                                <input id="nueva_contrasena_confirmation" type="password" class="form-control"
                                    name="nueva_contrasena_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Cambiar Contraseña
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Verificar si se ha enviado el formulario -->
    @if (request()->isMethod('post'))
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
    @endif

        </x-app-layout>