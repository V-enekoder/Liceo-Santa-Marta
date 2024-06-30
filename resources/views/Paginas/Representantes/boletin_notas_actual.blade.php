<x-app-layout>
    <div>
        <h1 style="font-family: 'Arial', sans-serif; font-size: 23px; text-align: left">Boletín de Calificaciones del alumno</h1>

        <table  class="tabla-centrada">
            <thead>
                <tr>
                    <th style="border: 1px solid black; padding: 8px; text-align:center;">Cédula</th>
                    <th style="border: 1px solid black; padding: 8px; width: 300px; text-align:center;">Nombres y
                        Apellidos</th>
                    <th style="border: 1px solid black; padding: 8px; text-align:center;">Año</th>
                    <th style="border: 1px solid black; padding: 8px; text-align: center;">Sección</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: 1px solid black; padding: 8px; text-align:center;">12.345.678</td>
                    <td style="border: 1px solid black; padding: 8px; width: 200px; text-align:center;">Perez Martinez
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
            <h1 style="font-weight: bold; font-size: 20px; text-align: left"> > Situación del alumno respecto al
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

</x-app-layout>
