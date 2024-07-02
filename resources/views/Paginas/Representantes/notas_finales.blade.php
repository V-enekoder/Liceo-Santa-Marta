<x-app-layout>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <div class="mt-4">
        <div class="contenedor-dropdown flex items-center space-x-4">
                <label for="miDropdown" class="font-bold whitespace-nowrap">
                     > Seleccione el período del Boletín a consultar:
                </label>
            <select
                class="form-select appearance-none 
                       px-3 
                       py-1.5 
                       text-base
                       font-normal
                       text-black
                       bg-white bg-clip-padding bg-no-repeat
                       border border-solid border-black
                       rounded-md
                       transition
                       ease-in-out
                       m-0
                       focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none w-40"
                id="miDropdown">
            </select>

            <button id="buscarBtn"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
                Buscar
            </button>
            <button id="limpiarBtn"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
                Limpiar
            </button>
        </div>

        <div id="resultados" style="display: none;" class="mt-10 ml-48">
            <h1 style="font-weight: bold; font-size: 23px; text-align: center">Boletín de Calificaciones
                del alumno</h1>

            <table class="tabla-centrada">
                <thead>
                    <tr>
                        <th style="border: 1px solid black; padding: 8px; text-align:center;">Cédula</th>
                        <th style="border: 1px solid black; padding: 8px; width: 300px; text-align:center;">Nombres
                            y
                            Apellidos</th>
                        <th style="border: 1px solid black; padding: 8px; text-align:center;">Año</th>
                        <th style="border: 1px solid black; padding: 8px; text-align: center;">Sección</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="border: 1px solid black; padding: 8px; text-align:center;">12.345.678</td>
                        <td style="border: 1px solid black; padding: 8px; width: 200px; text-align:center;">Perez
                            Martinez
                            Pedro Alejandro</td>
                        <td style="border: 1px solid black; padding: 8px; text-align: center;">3ero</td>
                        <td style="border: 1px solid black; padding: 8px; text-align: center;">A</td>
                    </tr>
                    <!-- Agrega más filas aquí -->
                </tbody>
            </table>

            <table style="border-collapse: collapse; width: 100%; margin-top: 30px;">
                <thead>
                    <tr>
                        <th style="border: 1px solid black; padding: 8px;">Asignatura</th>
                        <th style="border: 1px solid black; padding: 8px;">Lapso 1</th>
                        <th style="border: 1px solid black; padding: 8px;">Lapso 2</th>
                        <th style="border: 1px solid black; padding: 8px;">Lapso 3</th>
                        <th style="border: 1px solid black; padding: 8px;">Definitiva</th>
                    </tr>
                </thead>
                <tbody style="text-align: center">
                    <tr>
                        <td style="border: 1px solid black; padding: 8px;">Matemáticas</td>
                        <td style="border: 1px solid black; padding: 8px;">8.5</td>
                        <td style="border: 1px solid black; padding: 8px;">9.0</td>
                        <td style="border: 1px solid black; padding: 8px;">8.8</td>
                        <td style="border: 1px solid black; padding: 8px;">8.7</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; padding: 8px;">Ciencias</td>
                        <td style="border: 1px solid black; padding: 8px;">7.9</td>
                        <td style="border: 1px solid black; padding: 8px;">8.2</td>
                        <td style="border: 1px solid black; padding: 8px;">8.5</td>
                        <td style="border: 1px solid black; padding: 8px;">8.2</td>
                    </tr>
                    <!-- Agrega más filas para otras asignaturas -->
                </tbody>
            </table>
            <div class="mt-10 ">
                <h1 style="font-weight: bold; font-size: 17px; text-align: center"> Situación del alumno respecto al
                    promedio de la sección</h1>
            </div>

            <table class="mb-20" style="border-collapse: collapse; width: 100%; margin-top: 20px;">
                <thead>
                    <tr>
                        <th style="border: 1px solid black; padding: 8px;">Asignatura</th>
                        <th style="border: 1px solid black; padding: 8px;">Nota del alumno</th>
                        <th style="border: 1px solid black; padding: 8px;">Promedio de la sección</th>
                    </tr>
                </thead>
                <tbody style="text-align: center">
                    <tr>
                        <td style="border: 1px solid black; padding: 8px;">Matemáticas</td>
                        <td style="border: 1px solid black; padding: 8px;">8.5</td>
                        <td style="border: 1px solid black; padding: 8px;">9.0</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; padding: 8px;">Ciencias</td>
                        <td style="border: 1px solid black; padding: 8px;">7.9</td>
                        <td style="border: 1px solid black; padding: 8px;">8.2</td>
                    </tr>
                    <!-- Agrega más filas para otras asignaturas -->

                    <tr style="font-weight: bold;">
                        <td style="border: 1px solid black; padding: 8px;">Medias globales:</td>
                        {{-- aqui se debe de implementar la logica para mostrar el promedio del alumno y el promedio del salon --}}
                        <td style="border: 1px solid black; padding: 8px;" id="promedio-alumno"></td>
                        <td style="border: 1px solid black; padding: 8px;"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <script>
            // Simulación de datos (reemplaza con tu lógica de carga)
            const datos = ["2020-2021", "2021-2022", "2022-2023"];

            // Obtener el elemento select
            const dropdown = document.getElementById("miDropdown");

            // Cargar datos en el dropdown
            datos.forEach(opcion => {
                const optionElement = document.createElement("option");
                optionElement.value = opcion;
                optionElement.text = opcion;
                dropdown.add(optionElement);
            });

            // Manejar el evento click del botón "Buscar"
            document.getElementById('buscarBtn').addEventListener('click', function() {
                // Mostrar la sección de resultados
                document.getElementById('resultados').style.display = 'block';
            });
            // Manejar el evento click del botón "Limpiar"
            document.getElementById('limpiarBtn').addEventListener('click', function() {
                // Ocultar la sección de resultados
                document.getElementById('resultados').style.display = 'none';
            });
        </script>

    </div>

    </html>

</x-app-layout>
