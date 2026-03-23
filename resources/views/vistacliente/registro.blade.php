<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/registro.css')}}">
</head>
<body>
    <main>
        <h1>¿Ya estás registrado? Entonces, <a href="{{route('paginainici')}}">inicia sesión</a></h1>
        <form action="{{route('registro.process')}}" method="post">
            @csrf
            <fieldset>
                <input type="text" placeholder="Nom" name="nombre" required>
                <input type="text" placeholder="Cognoms" name="apellidos" required>
                <input type="email" placeholder="Email" name="email" required>
                <input type="tel" name="telefono" id="telefono" placeholder="Telefono de contacte">
            </fieldset>
            <fieldset>
                <input type="password" name="contrasenya" id="contrasenya" placeholder="contrasenya" required>
                <input type="password" name="contrasenya_confirmation" id="contrasenya_confirmation" placeholder="Repite la contraseña" required>
                <input type="submit" value="Registrarse">
            </fieldset>
        </form>
    </main>
</body>
</html>