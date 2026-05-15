<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Doctor</title>
    <link rel="stylesheet" href="{{ asset('css/doctor.css') }}">
</head>
<body>

<header>
    <h2>Bienvenido Dr. {{ session('doctor_nombre') }}</h2>

    <nav>
        <a href="{{ route('doctor.agenda') }}">Agenda</a>
        <a href="{{ route('doctor.citas') }}">Citas</a>
        <a href="{{ route('doctor.historial') }}">Historiales</a>
        <a href="{{ route('doctor.seguimiento') }}">Seguimiento</a>

        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Cerrar sesión</button>
        </form>
    </nav>
</header>

<main>
    @if(session('success'))
        <div class="success-msg">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert-error">{{ $errors->first() }}</div>
    @endif
    @yield('contenido')
</main>

</body>
</html>
