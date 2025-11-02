<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Gestión')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="d-flex" id="wrapper">
        <div class="bg-dark border-right" id="sidebar-wrapper">
            <div class="sidebar-heading text-white fw-bold text-center py-4">
                Colegio Superior
            </div>
            <div class="list-group list-group-flush">
                <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action bg-dark text-white"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="{{ route('turnos.index') }}" class="list-group-item list-group-item-action bg-dark text-white"><i class="fas fa-calendar-check me-2"></i>Turnos</a>
                <a href="{{ route('actividades.index') }}" class="list-group-item list-group-item-action bg-dark text-white"><i class="fas fa-basketball-ball me-2"></i>Actividades</a>

                {{-- Menú solo para Administradores --}}
                @can('es-admin')
                    <a href="{{ route('admin.espacios.index') }}" class="list-group-item list-group-item-action bg-dark text-white ps-5">Espacios</a>
                        <a href="{{ route('admin.recursos.index') }}" class="list-group-item list-group-item-action bg-dark text-white ps-5">Recursos</a>
                        <a href="{{ route('admin.usuarios.index') }}" class="list-group-item list-group-item-action bg-dark text-white ps-5">Usuarios</a>
                @endcan
                {{-- Formulario oculto que maneja el logout seguro --}}
                <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                    @csrf
                </form>
                
                {{-- El enlace visible que parece un botón y activa el formulario --}}
                <a href="{{ route('logout') }}" 
                    class="list-group-item list-group-item-action bg-dark text-danger fw-bold" {{-- Texto rojo para destacar --}}
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                </a>
            </div>
        </div>

        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            @auth
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                        {{ auth()->user()->name }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Mi Perfil</a>
                                        <div class="dropdown-divider"></div>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                                Cerrar Sesión
                                            </a>
                                        </form>

                                    </div>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="container-fluid p-4">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>