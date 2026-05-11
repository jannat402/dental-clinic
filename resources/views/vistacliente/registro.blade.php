<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dental Clinic - Registro</title>
    <link rel="stylesheet" href="{{ asset('css/registro1.css') }}">
</head>
<body>
    <main>
        <img src="{{ asset('images/logosinfondo.png') }}" alt="Dental Clinic" class="login-logo">
        <div class="registre-card">
            <h1>Crea tu cuenta</h1>

            @if ($errors->any())
                <div class="error-box">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('registro.process') }}" method="POST">
                @csrf
                <fieldset>
                    <input type="text" placeholder="Nombre" name="nombre" value="{{ old('nombre') }}" required>
                    <input type="text" placeholder="Apellidos" name="apellidos" value="{{ old('apellidos') }}" required>
                    <input type="email" placeholder="Email" name="email" value="{{ old('email') }}" required>
                    <input type="tel" placeholder="Teléfono" name="telefono" value="{{ old('telefono') }}">
                </fieldset>
                <fieldset>
                    <input type="password" placeholder="Contraseña" name="contrasenya" required>
                    <input type="password" placeholder="Repite la contraseña" name="contrasenya_confirmation" required>
                    <input type="submit" value="Registrarse">
                </fieldset>
            </form>
        </div>
        <div class="registre-footer">¿Ya tienes cuenta? <a href="{{ route('paginainici') }}">Inicia sesión</a></div>
    </main>
</body>
</html>
