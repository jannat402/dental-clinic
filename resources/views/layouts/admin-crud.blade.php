<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin - Dental Clinic')</title>
    <link rel="stylesheet" href="{{ asset('css/doctor.css') }}">
</head>
<body>
<header>
    <h2>Panel d'Administració</h2>
    <nav>
        <a href="{{ route('iniciadministrativo') }}">Dashboard</a>
        <a href="{{ route('clientes.index') }}">Clients</a>
        <a href="{{ route('doctores.index') }}">Doctors</a>
        <a href="{{ route('administrativos.index') }}">Administradors</a>
        <a href="{{ route('tratamientos.index') }}">Tractaments</a>
        <a href="{{ route('horarios.index') }}">Horaris</a>
        <a href="{{ route('pagos.index') }}">Pagaments</a>
        <a href="{{ route('blog.index') }}">Blog</a>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Tancar sessió</button>
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
