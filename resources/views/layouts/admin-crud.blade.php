<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Dental Clinic')</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

    {{-- Sidebar --}}
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>Dental Clinic</h2>
            <div class="subtitle">Panel de Administración</div>
        </div>

        <nav class="sidebar-nav">
            <div class="sidebar-label">General</div>
            <a href="{{ route('iniciadministrativo') }}" class="sidebar-link">
                <span class="icon">&#9632;</span>
                <span>Dashboard</span>
            </a>

            <div class="sidebar-label">Gestión</div>
            <a href="{{ route('clientes.index') }}" class="sidebar-link">
                <span class="icon">&#9644;</span>
                <span>Clientes</span>
            </a>
            <a href="{{ route('doctores.index') }}" class="sidebar-link">
                <span class="icon">&#9644;</span>
                <span>Doctores</span>
            </a>
            <a href="{{ route('administrativos.index') }}" class="sidebar-link">
                <span class="icon">&#9644;</span>
                <span>Administradores</span>
            </a>
            <a href="{{ route('tratamientos.index') }}" class="sidebar-link">
                <span class="icon">&#9644;</span>
                <span>Tratamientos</span>
            </a>

            <div class="sidebar-label">Planificación</div>
            <a href="{{ route('horarios.index') }}" class="sidebar-link">
                <span class="icon">&#9644;</span>
                <span>Horarios</span>
            </a>
            <a href="{{ route('citas.index') }}" class="sidebar-link">
                <span class="icon">&#9644;</span>
                <span>Citas</span>
            </a>

            <div class="sidebar-label">Finanzas</div>
            <a href="{{ route('pagos.index') }}" class="sidebar-link">
                <span class="icon">&#9644;</span>
                <span>Pagos</span>
            </a>

            <div class="sidebar-label">Contenido</div>
            <a href="{{ route('blog.index') }}" class="sidebar-link">
                <span class="icon">&#9644;</span>
                <span>Blog</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-name">{{ session('admin_nombre') ?? 'Admin' }}</div>
            <div class="user-role">Administrador</div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout-sidebar">Cerrar sesión</button>
            </form>
        </div>
    </aside>

    {{-- Main content --}}
    <div class="main-wrapper">
        <div class="topbar">
            <h1>@yield('title', 'Panel de Administración')</h1>
            <div class="topbar-right">
                <span class="user-badge">{{ session('admin_nombre') ?? 'Admin' }}</span>
            </div>
        </div>

        <div class="content">
            @if(session('success'))
                <div class="success-msg">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert-error">{{ $errors->first() }}</div>
            @endif
            @yield('contenido')
        </div>
    </div>

</body>
</html>