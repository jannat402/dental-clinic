<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/landingPage.css')}}">
</head>

<body>
    <main>
        <header>
            <ul>
                <li>Iniciar Sesión</li>
                <li>Registrarse</li>
            </ul>
        </header>
        <div id="centralButton">
            <button><a href="{{route('paginainici')}}">PEDIR CITA</a></button>
        </div>
        <div id="logo">
            <img src="images/logosinfondo.png" alt="Logo de la clinica dental">
        </div>
    </main>
</body>

</html>