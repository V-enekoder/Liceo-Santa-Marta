<x-app-layout>
    <div class="container mx-auto mt-6">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Boletín de Calificaciones</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Estudiante: {{ $estudiante->persona->primer_nombre }} {{ $estudiante->persona->primer_apellido }}
                    - Cédula: {{ $estudiante->persona->cedula }} - Grado: {{ $grado->id }}
                </p>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    @foreach ($calificaciones as $materia => $calificacion)
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">{{ $materia }}</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-3">
                                <div class="flex items-center">
                                    @if ($calificacion)
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Lapso 1: {{ $calificacion->lapso_1 }} |
                                            Lapso 2: {{ $calificacion->lapso_2 }} |
                                            Lapso 3: {{ $calificacion->lapso_3 }} |
                                            Promedio: {{ $calificacion->promedio }} |
                                            Docente:
                                            {{ $calificacion->docente_materia->docente->user->persona->primer_nombre }}
                                            {{ $calificacion->docente_materia->docente->user->persona->primer_apellido }}
                                        </span>
                                    @else
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Sin calificación
                                        </span>
                                    @endif
                                </div>
                            </dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        </div>
    </div>
</x-app-layout>
