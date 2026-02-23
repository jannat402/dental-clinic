<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/panelusuario.css')}}">
</head>
<body>
    <main>
        <h1>Bievenido a dental clinic</a></h1>
        <p> Aquí puede reservar cita. Para cualquier problema o para agendar cita por teléfono, lama al 666666666</p>
        <div id="botones">
            <button><a href="{{route('mostrar')}}">Consultar citas</a></button>
            <button><a href="{{route('pedircita')}}">Pedir cita</a></button>
            <button><a href="{{route('cambiar')}}">Modificar citas</a></button>
        </div>
    </main>
</body>
</html>