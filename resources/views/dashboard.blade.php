<x-app-layout>

    <head>
        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    </head>
    <!-- Sidebar -->


    <script>
        function toggleSubmenu(element) {
            const submenu = element.nextElementSibling;
            submenu.classList.toggle("hidden");
            submenu.classList.toggle("show"); // Añade 'show' al submenu visible
        }
    </script>
    <!-- Contenido principal -->
    <div class=" p-4 ml-40">
        <div class="flex-1 ml-20">
            <h1 style="font-family: 'Arial', sans-serif; font-size: 30px">Menú principal</h1>
        </div>


        {{-- <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>  --}}
</x-app-layout>
