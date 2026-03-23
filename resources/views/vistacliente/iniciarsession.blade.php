<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dental Clinic</title>
    <link rel="stylesheet" href="{{asset('css/iniciarSession.css')}} ">
</head>
<body>
    <main>
        <h1>Inicia sesión para ver tus citas, pedir citas y mucho más. El email es tu usuario y tu nombre es tu contraseña</h1>
        <form action="{{ route('login.process') }}" method="POST">
            <!--Laravel bloquea cualquier formulario sin token CSRF.-->
            @csrf
            <fieldset>
                <input type="text" placeholder="email o telefono" name="login" required>
                <input type="password" name="password" id="password" placeholder="contraseña" required>
                <input type="submit" value="iniciarSession">
            </fieldset>
            <h1>¿Ya estás registrado? Entonces, <a href="{{route('registro')}}">regístrate</a></h1>
        </form>
    </main>
</body>
</html>