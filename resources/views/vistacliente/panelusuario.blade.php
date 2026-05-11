<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Client - Dental Clinic</title>
    <link rel="stylesheet" href="{{asset('css/panelusuario.css')}}">
</head>
<body>
    <main>

        <h1>Benvingut a Dental Clinic</h1>

        <p>
            Des d'aquí pots gestionar les teves cites. Per a qualsevol problema,
            truca'ns al <strong>931 23 45 67</strong>.
        </p>

        <div id="botones">
            <a href="{{route('pedircita')}}" class="btn">Demanar cita</a>
            <a href="{{route('mostrar')}}" class="btn">Consultar cites</a>
        </div>

        <form action="{{ route('logout') }}" method="POST" style="margin-top: 30px;">
            @csrf
            <button class="btn-logout">Tancar sessió</button>
        </form>

    </main>
</body>
</html>
