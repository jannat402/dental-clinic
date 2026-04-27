<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dental Clinic</title>
    <link rel="stylesheet" href="{{ asset('css/landingPage.css') }}">
</head>

<body>
    <header class="header">
        <nav class="nav">
            <ul>
                <li><a href="{{ route('paginainici') }}">Iniciar Sesión</a></li>
                <li><a href="{{ route('registro') }}">Registrarse</a></li>
            </ul>
        </nav>
    </header>

    <main class="main">
        <section class="hero">
            <div class="hero-content">
                <h1>Tu sonrisa, nuestra prioridad</h1>
                <p>Reserva tu cita en segundos y gestiona todo desde tu panel personal.</p>

                <a href="{{ route('paginainici') }}" class="btn-primary">PEDIR CITA</a>
            </div>

            <div class="hero-logo">
                <img src="{{ asset('images/logosinfondo.png') }}" alt="Logo de la clínica dental">
            </div>
        </section>
    </main>
</body>

</html>
