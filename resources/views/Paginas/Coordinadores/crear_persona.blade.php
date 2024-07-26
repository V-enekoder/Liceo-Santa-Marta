{{-- @extends('layouts.simple')

@section('content') --}}
<div class="form-container">
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
            <input type="text" id="cedula" name="cedula" value="{{ old('cedula') }}" required>
        </div>

        <div class="form-group">
            <label for="categoria_id">Categoria</label>
            <select id="categoria_id" name="categoria_id" required>
                <option value="">Seleccione una categoria</option>
                <option value="1">Usuario</option>
                <option value="2">Estudiante</option>
            </select>
        </div>

        <div class="form-group" id="rol_id_group">
            <label for="rol_id">Rol</label>
            <select id="rol_id" name="rol_id" required>
                <option value="">Seleccione un rol</option>
                @foreach ($roles as $rol)
                    <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group" id="email_group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}">
        </div>

        <div class="form-group" id="password_group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password">
        </div>

        <div class="form-group" id="password_confirmation_group">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>

        <div class="form-group">
            <label for="primer_nombre">Primer Nombre</label>
            <input type="text" id="primer_nombre" name="primer_nombre" value="{{ old('primer_nombre') }}" required>
        </div>

        <div class="form-group">
            <label for="segundo_nombre">Segundo Nombre</label>
            <input type="text" id="segundo_nombre" name="segundo_nombre" value="{{ old('segundo_nombre') }}">
        </div>

        <div class="form-group">
            <label for="primer_apellido">Primer Apellido</label>
            <input type="text" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido') }}"
                required>
        </div>

        <div class="form-group">
            <label for="segundo_apellido">Segundo Apellido</label>
            <input type="text" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido') }}">
        </div>

        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}">
        </div>

        <div id="estudiante-fields" style="display: none;">
            <div class="form-group">
                <label for="ultimo_grado_aprobado">Último Grado Aprobado</label>
                <select id="ultimo_grado_aprobado" name="ultimo_grado_aprobado">
                    <option value="">Seleccione el último grado aprobado</option>
                    @for ($i = 0; $i <= 4; $i++)
                        <option value="{{ $i }}"
                            {{ old('ultimo_grado_aprobado') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>

        <button type="submit" class="submit-button">Crear usuario</button>
    </form>
</div>

<style>
    body,
    html {
        height: 100%;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f0f0f0;
        font-family: Arial, sans-serif;
    }

    .form-container {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        width: 100%;
        margin-top: 120px;
        /* Añadido margen superior */
    }

    .form-container h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-container .form-group {
        margin-bottom: 15px;
    }

    .form-container label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-container input,
    .form-container select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .submit-button {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        color: white;
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .submit-button:hover {
        background-color: #0056b3;
    }

    .alert-danger {
        color: red;
        margin-bottom: 20px;
    }

    .alert-danger ul {
        padding-left: 20px;
    }
</style>

<script>
    var categoriaSelect = document.getElementById('categoria_id');
    var rolIdGroup = document.getElementById('rol_id_group');
    var emailGroup = document.getElementById('email_group');
    var passwordGroup = document.getElementById('password_group');
    var passwordConfirmationGroup = document.getElementById('password_confirmation_group');
    var estudianteFields = document.getElementById('estudiante-fields');

    categoriaSelect.addEventListener('change', function() {
        var categoria = this.value;

        // Mostrar u ocultar campos según la categoria seleccionada
        if (categoria === '2') { // Estudiante
            estudianteFields.style.display = 'block';
            rolIdGroup.style.display = 'none';
            emailGroup.style.display = 'none';
            passwordGroup.style.display = 'none';
            passwordConfirmationGroup.style.display = 'none';
        } else { // Usuario (categoria 1)
            estudianteFields.style.display = 'none';
            rolIdGroup.style.display = 'block';
            emailGroup.style.display = 'block';
            passwordGroup.style.display = 'block';
            passwordConfirmationGroup.style.display = 'block';
        }
    });
</script>

{{-- @endsection --}}
