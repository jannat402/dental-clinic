<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Usuario - Dental Clinic</title>
    <link rel="stylesheet" href="{{asset('css/panelusuario.css')}}">
</head>
<body>
    <main>

        <h1>Bienvenido a Dental Clinic</h1>
        <p>Aquí puede reservar cita. Para cualquier problema o para agendar cita por teléfono, llame al 931 23 45 67 o al 600 123 456 </p>

        <div id="botones">
            <a href="{{route('mostrar')}}" class="btn">Consultar citas</a>
            <a href="{{route('pedircita')}}" class="btn">Pedir cita</a>
            <a href="{{route('cambiar')}}" class="btn">Modificar citas</a>
        </div>

    </main>
</body>
</html>
