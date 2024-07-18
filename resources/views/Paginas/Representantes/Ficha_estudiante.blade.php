<x-app-layout>
    <h1 style="font-weight: bold; font-size: 23px; text-align: left">Ficha informativa del estudiante</h1>

    <div class="contenedor-dropdown flex items-center space-x-4 mt-4">
        <label for="busquedaEstudiante" class="font-bold">
            Ingrese la cédula de su representado:
        </label>
        <input type="text" id="busquedaEstudiante" class="rounded border px-2 py-1">
        <span id="mensaje-no-encontrado" style="display: none; color:blue;">Usuario no encontrado</span>
        <button id="buscarBtn"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
            Buscar
        </button>
        <button id="limpiarBtn"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
            Limpiar
        </button>
    </div>
    <div class="mt-10 max-w-sm rounded overflow-hidden shadow-lg mx-auto my-8 bg-white ml-72">
        <div class="bg-blue-200 text-center py-8">
            <input type="file" id="imageUpload" accept="image/*" class="hidden">
            <h2 id="nombre" class="text-2xl font-semibold mt-4">Nombre</h2>
            <h2 id="apellido" class="text-2xl font-semibold mt-4">Apellido</h2>
            <h4 id="fecha" class="text-2xl font-light mt-4">Fecha de Nacimiento</h4>
        </div>
        <div class="px-6 py-4">
            <div class="text-gray-700 text-lg ">
                <p><span class="font-semibold ">ID:</span> <span id="student-id"></span></p>
                <p><span class="font-semibold ">Cédula:</span> <span id="student-cedula"></span></p>
                <p><span class="font-semibold">Dirección:</span> <span id="direccion"></span></p>
                <p><span class="font-semibold">Año actual cursando:</span> <span id="student-año"></span></p>
            </div>
        </div>
    </div>

    <script>
        // Obtener referencias a los elementos de la vista
        const busquedaEstudianteInput = document.getElementById('busquedaEstudiante');
        const studentNameElement = document.getElementById('nombre');
        const studentLastNameElement = document.getElementById('apellido');
        const studentFechaElement = document.getElementById('fecha');
        const studentDireccionElement = document.getElementById('direccion');
        const studentIdElement = document.getElementById('student-id');
        const studentCedulaElement = document.getElementById('student-cedula');
        const studentAñoElement = document.getElementById('student-año');
        const studentSeccionElement = document.getElementById('student-seccion');
        const mensajeNoEncontradoElement = document.getElementById('mensaje-no-encontrado');

        // Limpiar los campos de la vista
        const limpiarButton = document.getElementById('limpiarBtn');
        limpiarButton.addEventListener('click', () => {
            busquedaEstudianteInput.value = '';
            studentIdElement.textContent = '';
            studentCedulaElement.textContent = '';
            studentAñoElement.textContent = '';
            studentSeccionElement.textContent = '';
            mensajeNoEncontradoElement.style.display = 'none';
        });

        async function fercho(cedulaEstudiante) {
            try {
                const response = await fetch(`/verficha/${cedulaEstudiante}`);
                const data = await response.json();
                console.log(data);
                if (data.persona) {
                    // Actualizar los valores en la vista con los datos del estudiante
                    studentNameElement.textContent = data.persona.primer_nombre + " " + data.persona.segundo_nombre;
                    studentLastNameElement.textContent = data.persona.primer_apellido + " " + data.persona.segundo_apellido;
                    studentFechaElement.textContent = "Fecha de nacimiento: " + data.persona.fecha_nacimiento;
                    studentDireccionElement.textContent = data.persona.direccion;
                    studentIdElement.textContent = data.persona.id;
                    studentCedulaElement.textContent = data.persona.cedula;
                    studentAñoElement.textContent = data.ultimo_grado_aprobado + 1;
                    studentSeccionElement.textContent = data.persona.seccion;
                    mensajeNoEncontradoElement.style.display = 'none';
                } else {
                    // No se encontraron coincidencias, mostrar mensaje de no encontrado
                    studentNameElement.textContent = '';
                    studentLastNameElement.textContent = '';
                    studentFechaElement.textContent = '';
                    studentDireccionElement.textContent = '';
                    studentIdElement.textContent = '';
                    studentCedulaElement.textContent = '';
                    studentAñoElement.textContent = '';
                    studentSeccionElement.textContent = '';
                    mensajeNoEncontradoElement.style.display = 'block';
                }
                console.log("Success:", data);
            } catch (error) {
                console.error("Error:", error);
            }
        }

        // Buscar el estudiante y mostrar los datos en la vista
        const buscarButton = document.getElementById('buscarBtn');
        buscarButton.addEventListener('click', () => {
            const cedulaEstudiante = busquedaEstudianteInput.value;
            fercho(cedulaEstudiante);
        });
    </script>
</x-app-layout>
