<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Client - Dental Clinic</title>
    <link rel="stylesheet" href="{{asset('css/panelusuario.css')}}">
</head>
<body>
    <main>

        <h1>Bienvenido a Dental Clinic</h1>

        <p>
            Desde aquí puedes gestionar tus citas. Para cualquier problema,
            llámanos al <strong>931 23 45 67</strong>.
        </p>

        <div id="botones">
            <a href="{{route('pedircita')}}" class="btn">Pedir cita</a>
            <a href="{{route('mostrar')}}" class="btn">Consultar citas</a>
        </div>

        <form action="{{ route('logout') }}" method="POST" style="margin-top: 30px;">
            @csrf
            <button class="btn-logout">Cerrar sesión</button>
        </form>

    </main>
</body>
</html>
