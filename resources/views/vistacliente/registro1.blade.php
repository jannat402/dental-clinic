<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/registro1.css')}}">
</head>
<body>
    <main>
        <h1>¿Ya estás registrado? Entonces, <a href="{{route('paginainici')}}">inicia sesión</a></h1>
        <form action="{{route('pedircita')}}" method="get">
            <fieldset>
                <input type="text" placeholder="Nom" name="nombre" id="nombre">
                <input type="text" placeholder="Cognoms" name="apellidos" id="apellidos">
                <input type="email" placeholder="Email" name="email" id="email">
                <input type="tel" name="telefono" id="telefono" placeholder="Telefono de contacte">
            </fieldset>
            <fieldset>
                <input type="password" name="password" id="password" placeholder="contrasenya">
                <input type="password" name="password" id="password" placeholder="repeteix contrasenya">
                <input type="submit" value="Registrarse">
            </fieldset>
        </form>
    </main>
</body>
</html>