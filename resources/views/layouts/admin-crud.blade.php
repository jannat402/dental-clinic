<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin - Dental Clinic')</title>
    <link rel="stylesheet" href="{{ asset('css/doctor.css') }}">
</head>
<body>
<header>
    <h2>Panel de Administración</h2>
    <nav>
        <a href="{{ route('iniciadministrativo') }}">Dashboard</a>
        <a href="{{ route('clientes.index') }}">Clientes</a>
        <a href="{{ route('doctores.index') }}">Doctores</a>
        <a href="{{ route('administrativos.index') }}">Administradores</a>
        <a href="{{ route('tratamientos.index') }}">Tratamientos</a>
        <a href="{{ route('horarios.index') }}">Horarios</a>
        <a href="{{ route('pagos.index') }}">Pagos</a>
        <a href="{{ route('blog.index') }}">Blog</a>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Cerrar sesión</button>
        </form>
    </nav>
</header>
<main>
    @if(session('success'))
        <div class="success-msg" style="background:#d4edda;padding:12px;border-radius:8px;margin-bottom:20px;">{{ session('success') }}</div>
    @endif
    @yield('contenido')
</main>
</body>
</html>
