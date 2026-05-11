<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Verificación 2FA - Dental Clinic</title>
    <link rel="stylesheet" href="{{ asset('css/iniciarsession.css') }}">
</head>
<body>
<div class="login-container">
    <div class="login-box">
        <h1>Verificación de dos factores</h1>
        <p>Hemos enviado un código de verificación a tu correo electrónico.</p>

        @if(session('success'))
            <p class="success-msg">{{ session('success') }}</p>
        @endif

        <form action="{{ route('2fa.verificar') }}" method="POST">
            @csrf
            <input type="text" name="codi" placeholder="Código de 6 dígitos" maxlength="6" required>
            @error('codi') <p class="error-msg">{{ $message }}</p> @enderror
            <button type="submit">Verificar</button>
        </form>

        <form action="{{ route('2fa.enviar') }}" method="POST" style="margin-top:10px;">
            @csrf
            <button type="submit" class="btn-link">Reenviar código</button>
        </form>
    </div>
</div>
</body>
</html>
