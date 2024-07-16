<x-app-layout>

    <head>
        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
        <style>
            .centered-content {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                text-align: left;
            }

            .user-details {
                width: 50%;
                background-color: #f9f9f9;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
        </style>
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
    <div class="centered-content">
        <div class="user-details">
            <h1 style="font-family: 'Arial', sans-serif; font-size: 30px">Menú principal</h1>
            <h2>Datos del usuario</h2>
            <p><strong>Cédula:</strong> {{ $user->cedula }}</p>
            <p><strong>Primer Nombre:</strong> {{ $user->primer_nombre }}</p>
            <p><strong>Segundo Nombre:</strong> {{ $user->segundo_nombre }}</p>
            <p><strong>Primer Apellido:</strong> {{ $user->primer_apellido }}</p>
            <p><strong>Segundo Apellido:</strong> {{ $user->segundo_apellido }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Dirección:</strong> {{ $user->direccion }}</p>
            <p><strong>Rol:</strong> {{ $user->rol->nombre }}</p>
        </div>
    </div>
</x-app-layout>
