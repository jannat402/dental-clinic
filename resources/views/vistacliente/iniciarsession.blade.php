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
        <img src="{{ asset('images/logosinfondo.png') }}" alt="Dental Clinic" class="login-logo">
        <div class="login-card">
            <h1>Inicia sesión para ver tus citas, pedir citas y mucho más.</h1>

            @if ($errors->any())
                <div class="error-box">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('login.process') }}" method="POST">
                @csrf
                <fieldset>
                    <input type="text" placeholder="Email o teléfono" name="login" required>
                    <input type="password" placeholder="Contraseña" name="password" required>
                    <div class="rol-selector">
                        <label class="rol-option">
                            <input type="radio" name="rol" value="cliente" checked>
                            <span>Paciente</span>
                        </label>
                        <label class="rol-option">
                            <input type="radio" name="rol" value="doctor">
                            <span>Doctor</span>
                        </label>
                        <label class="rol-option">
                            <input type="radio" name="rol" value="admin">
                            <span>Administrativo</span>
                        </label>
                    </div>
                    <input type="submit" value="Iniciar sesión">
                </fieldset>
            </form>
        </div>
        <div class="login-footer">¿No estás registrado? <a href="{{ route('registro') }}">Regístrate aquí</a></div>
    </main>
</body>
</html>
