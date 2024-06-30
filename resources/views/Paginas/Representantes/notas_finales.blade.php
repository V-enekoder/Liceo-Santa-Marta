<x-app-layout>
    <!DOCTYPE html>
    <html>
    <div class="mt-4">
        <h1 style="font-family: 'Arial', sans-serif; font-size: 23px; text-align: left">Consulta de boletines acádemicos
        </h1>

        <body>

            <div class="contenedor-dropdown">

                <label for="miDropdown" class="flex flex-auto items-start mt-4 mb-4"> > Selecciona el periodo a
                    consultar:</label>
                <select id="miDropdown">
                </select>
                <div class="flex flex-auto items-start mt-4"> <button
                        class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                        Buscar
                </div>
                </button>
                <script>
                    // Simulación de datos (reemplaza con tu lógica de carga)
                    const datos = ["Victor", "Victor", "Roberto"];

                    // Obtener el elemento select
                    const dropdown = document.getElementById("miDropdown");

                    // Cargar datos en el dropdown
                    datos.forEach(opcion => {
                        const optionElement = document.createElement("option");
                        optionElement.value = opcion;
                        optionElement.text = opcion;
                        dropdown.add(optionElement);
                    });
                </script>

        </body>
    </div>

    </html>

</x-app-layout>
