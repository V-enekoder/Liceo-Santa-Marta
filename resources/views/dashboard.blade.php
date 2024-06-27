<x-app-layout>

    <head>
        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    </head>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex h-screen">
                <!-- Sidebar -->
              

                <script>
                    function toggleSubmenu(element) {
                        const submenu = element.nextElementSibling;
                        submenu.classList.toggle("hidden");
                        submenu.classList.toggle("show"); // Añade 'show' al submenu visible
                    }
                </script>
                <!-- Contenido principal -->
                <div class="flex-1 p-4 ml-60">
                    <table>
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
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
