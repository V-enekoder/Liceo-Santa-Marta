<x-app-layout>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <h1 class="h1Docente">Coordinador: Crear persona</h1>

        <div class="panel panel-default">
            <div class="panel-heading text-table-head">Panel de registro</div>
            <div class="panel-body">

        <form action="{{ route('sidebar.crearpersona') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="text-default-black" for="cedula">Cédula</label>
                <input type="text" class="form-control" id="cedula" name="cedula" value="{{ old('cedula') }}"
                    required>
            </div>

            <div class="form-group">
                <label class="text-default-black" for="categoria_id">Categoria</label>
                <select class="form-control" id="categoria_id" name="categoria_id" required>
                    <option value="">Seleccione una categoria</option>
                    <option value="1">Usuario</option>
                    <option value="2">Estudiante</option>
                </select>
            </div>

            <div class="form-group" id="rol_id_group">
                <label class="text-default-black" for="rol_id">Rol</label>
                <select class="form-control" id="rol_id" name="rol_id" required>
                    <option value="">Seleccione un rol</option>
                    @foreach ($roles as $rol)
                        <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" id="email_group">
                <label class="text-default-black" for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
            </div>

            <div class="form-group" id="password_group">
                <label class="text-default-black" for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="form-group" id="password_confirmation_group">
                <label class="text-default-black" for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <div class="form-group">
                <label class="text-default-black" for="primer_nombre">Primer Nombre</label>
                <input type="text" class="form-control" id="primer_nombre" name="primer_nombre"
                    value="{{ old('primer_nombre') }}" required>
            </div>

            <div class="form-group">
                <label class="text-default-black" for="segundo_nombre">Segundo Nombre</label>
                <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre"
                    value="{{ old('segundo_nombre') }}">
            </div>

            <div class="form-group">
                <label class="text-default-black" for="primer_apellido">Primer Apellido</label>
                <input type="text" class="form-control" id="primer_apellido" name="primer_apellido"
                    value="{{ old('primer_apellido') }}" required>
            </div>

            <div class="form-group">
                <label class="text-default-black" for="segundo_apellido">Segundo Apellido</label>
                <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido"
                    value="{{ old('segundo_apellido') }}">
            </div>

            <div class="form-group">
                <label class="text-default-black" for="direccion">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion"
                    value="{{ old('direccion') }}">
            </div>

            <div id="estudiante-fields" style="display: none;">
                <div class="form-group">
                    <label class="text-default-black" for="ultimo_grado_aprobado">Último Grado Aprobado</label>
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

            <button type="submit"
            class="mt-5 mb-0 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear usuario</button>
        </form>
    </div>


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

</x-app-layout>