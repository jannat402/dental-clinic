<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dental Clinic - Iniciar sesión</title>
    <link rel="stylesheet" href="{{ asset('css/iniciarSession.css') }}">
</head>
<body>
    <main>

        <h1>Inicia sesión para ver tus citas, pedir citas y mucho más.</h1>

        {{-- MENSAJE DE ERROR --}}
        @if ($errors->any())
            <div class="error-box">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <fieldset>
                <input type="text" placeholder="Email o teléfono" name="login" required>
                <input type="password" placeholder="Contraseña" name="password" required>
                <input type="submit" value="Iniciar sesión">
            </fieldset>

            <h1>¿No estás registrado? <a href="{{ route('registro') }}">Regístrate aquí</a></h1>
        </form>
    </main>
</body>
</html>
