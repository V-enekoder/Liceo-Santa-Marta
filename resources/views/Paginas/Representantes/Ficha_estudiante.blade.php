<x-app-layout>
    <h1 style="font-weight: bold; font-size: 23px; text-align: left">> Ficha informativa del estudiante
    </h1>

    <div class="contenedor-dropdown flex items-center space-x-4 mt-4">
        <label for="miDropdown" class="font-bold">
            Ingrese la cédula de su representado:
        </label>
        <input type="text" id="busquedaEstudiante" class="rounded border px-2 py-1">

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
            <img id="profile-image" class="h-48 w-48 rounded-full mx-auto object-cover" src="ruta/a/foto.jpg"
                alt="fotoaqui">

            <input type="file" id="imageUpload" accept="image/*" class="hidden">
            <h2 class="text-2xl font-semibold mt-4">Byeon Woo-seok</h2>
            <button id="uploadButton" class="mt-4 mb-2 px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-700">
                Cambiar Imagen
            </button>
        </div>
        <div class="px-6 py-4">
            <div class="text-gray-700 text-lg">
                <p><span class="font-semibold">ID:</span> <span id="student-id">12345</span></p>
                <p><span class="font-semibold">Cédula:</span> <span id="student-cedula">30.501.253</span></p>
                <p><span class="font-semibold">Año actual cursando:</span> <span id="student-año">4to</span></p>
                <p><span class="font-semibold">Sección:</span> <span id="student-seccion">B</span></p>
                <!-- Puedes agregar más campos aquí -->
            </div>
        </div>
        <div class="px-6 pt-4 pb-2 text-center mb-4">
            <button id="edit-button"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2">
                Editar
            </button>
            <button id="delete-button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Eliminar
            </button>
        </div>
    </div>
</x-app-layout>


{{-- esto es para la logica como tal que debe de cargar la ficha, esto era prueba pero no funciono  --}}
{{-- <script>
    const inputBusqueda = document.getElementById('busquedaEstudiante');
    const botonBuscar = document.getElementById('buscarBtn');
    const botonLimpiar = document.getElementById('limpiarBtn');
    const fichaEstudiante = document.getElementById('fichaEstudiante'); // Agrega un ID a la ficha

    // Oculta la ficha inicialmente
    fichaEstudiante.style.display = 'none';

    botonBuscar.addEventListener('click', () => {
        const valorBusqueda = inputBusqueda.value;

        // Realiza una solicitud AJAX al servidor (usando fetch o XMLHttpRequest)
        fetch(`/buscar-estudiante/${valorBusqueda}`) // Ajusta la ruta según tu backend
            .then(response => response.json())
            .then(data => {
                // Actualiza el contenido de la ficha con la información recibida
                document.getElementById('student-id').textContent = data.id;
                document.getElementById('student-nombre').textContent = data.nombre;
                // ... actualiza otros campos ...

                // Muestra la ficha
                fichaEstudiante.style.display = 'block';
            })
            .catch(error => {
                console.error("Error al obtener datos del estudiante:", error);
                // Maneja el error, por ejemplo, mostrando un mensaje al usuario
            });
    });

    botonLimpiar.addEventListener('click', () => {
        // Limpia el campo de búsqueda y oculta la ficha
        inputBusqueda.value = '';
        fichaEstudiante.style.display = 'none';
    });

    // ... (código para subir la imagen) ...
</script> --}}
