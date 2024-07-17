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

        <form action="{{ route('sidebar.crearpersona') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="cedula">Cédula</label>
                <input type="text" class="form-control" id="cedula" name="cedula" value="{{ old('cedula') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="categoria_id">Categoría</label>
                <select class="form-control" id="categoria_id" name="categoria_id" required>
                    <option value="">Seleccione una categoría</option>
                    <option value="1">Usuario</option>
                    <option value="2">Estudiante</option>
                </select>
            </div>

            <div class="form-group" id="rol_id_group">
                <label for="rol_id">Rol</label>
                <select class="form-control" id="rol_id" name="rol_id" required>
                    <option value="">Seleccione un rol</option>
                    @foreach ($roles as $rol)
                        <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" id="email_group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
            </div>

            <div class="form-group" id="password_group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="form-group" id="password_confirmation_group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
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
                <label for="direccion">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion"
                    value="{{ old('direccion') }}">
            </div>

            <div id="estudiante-fields" style="display: none;">
                <div class="form-group">
                    <label for="ultimo_grado_aprobado">Último Grado Aprobado</label>
                    <select class="form-control" id="ultimo_grado_aprobado" name="ultimo_grado_aprobado">
                        <option value="">Seleccione el último grado aprobado</option>
                        @for ($i = 0; $i <= 4; $i++)
                            <option value="{{ $i }}"
                                {{ old('ultimo_grado_aprobado') == $i ? 'selected' : '' }}>
                                {{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Crear Usuario</button>
        </form>
    </div>
</body>

<script>
    var categoriaSelect = document.getElementById('categoria_id');
    var rolIdGroup = document.getElementById('rol_id_group');
    var emailGroup = document.getElementById('email_group');
    var passwordGroup = document.getElementById('password_group');
    var passwordConfirmationGroup = document.getElementById('password_confirmation_group');
    var estudianteFields = document.getElementById('estudiante-fields');

    categoriaSelect.addEventListener('change', function() {
        var categoria = this.value;

        // Mostrar u ocultar campos según la categoría seleccionada
        if (categoria === '2') { // Estudiante
            estudianteFields.style.display = 'block';
            rolIdGroup.style.display = 'none';
            emailGroup.style.display = 'none';
            passwordGroup.style.display = 'none';
            passwordConfirmationGroup.style.display = 'none';
        } else { // Usuario (categoría 1)
            estudianteFields.style.display = 'none';
            rolIdGroup.style.display = 'block';
            emailGroup.style.display = 'block';
            passwordGroup.style.display = 'block';
            passwordConfirmationGroup.style.display = 'block';
        }
    });
</script>

</html>
