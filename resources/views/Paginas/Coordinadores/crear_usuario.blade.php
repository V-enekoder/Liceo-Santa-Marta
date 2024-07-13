<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Crear Usuario</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/dashboard/crear-usuario') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="cedula">Cédula</label>
                <input type="text" class="form-control" id="cedula" name="cedula" value="{{ old('cedula') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="rol_id">Rol</label>
                <select class="form-control" id="rol_id" name="rol_id" required>
                    <option value="">Seleccione un rol</option>
                    @foreach ($roles as $rol)
                        <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="primer_nombre">Primer Nombre</label>
                <input type="text" class="form-control" id="primer_nombre" name="primer_nombre"
                    value="{{ old('primer_nombre') }}" required>
            </div>

            <div class="form-group">
                <label for="segundo_nombre">Segundo Nombre</label>
                <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre"
                    value="{{ old('segundo_nombre') }}">
            </div>

            <div class="form-group">
                <label for="primer_apellido">Primer Apellido</label>
                <input type="text" class="form-control" id="primer_apellido" name="primer_apellido"
                    value="{{ old('primer_apellido') }}" required>
            </div>

            <div class="form-group">
                <label for="segundo_apellido">Segundo Apellido</label>
                <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido"
                    value="{{ old('segundo_apellido') }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion"
                    value="{{ old('direccion') }}">
            </div>

            <button type="submit" class="btn btn-primary">Crear Usuario</button>
        </form>
    </div>
</body>

</html>
