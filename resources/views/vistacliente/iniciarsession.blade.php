<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dental Clinic</title>
    <link rel="stylesheet" href="{{asset('css/iniciarsession.css')}} ">
</head>
<body>
    <main>
        <h1>Inicia sesión para ver tus citas, pedir citas y mucho más. El email es tu usuario y tu nombre es tu contraseña</h1>
        <form action="">
            <fieldset>
                <input type="text" placeholder="email o telefono" name="emailotelefono" id="emailotelefono">
                <input type="password" name="password" id="password" placeholder="contrasenya">
                <input type="submit" value="iniciarsession">
            </fieldset>
            <h1>¿Ya estás registrado? Entonces, <a href="{{route('registro')}}">registrate</a></h1>
        </form>
    </main>
</body>
</html>