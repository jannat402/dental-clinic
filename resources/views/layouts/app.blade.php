<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Clínica Dental')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="/">Clínica Dental</a>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="/clientes">Clientes</a></li>
            <li class="nav-item"><a class="nav-link" href="/doctores">Doctores</a></li>
            <li class="nav-item"><a class="nav-link" href="/administrativos">Administrativos</a></li>
            <li class="nav-item"><a class="nav-link" href="/tratamientos">Tratamientos</a></li>
            <li class="nav-item"><a class="nav-link" href="/citas">Citas</a></li>
            <li class="nav-item"><a class="nav-link" href="/pagos">Pagos</a></li>
            <li class="nav-item"><a class="nav-link" href="/blog">Blog</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @yield('content')
</div>

@yield('scripts')
</body>
</html>
