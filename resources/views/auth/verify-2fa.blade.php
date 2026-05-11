<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Verificació 2FA - Dental Clinic</title>
    <link rel="stylesheet" href="{{ asset('css/iniciarsession.css') }}">
</head>
<body>
<div class="login-container">
    <div class="login-box">
        <h1>Verificació de dos factors</h1>
        <p>Hem enviat un codi de verificació al teu correu electrònic.</p>

        @if(session('success'))
            <p class="success-msg">{{ session('success') }}</p>
        @endif

        <form action="{{ route('2fa.verificar') }}" method="POST">
            @csrf
            <input type="text" name="codi" placeholder="Codi de 6 dígits" maxlength="6" required>
            @error('codi') <p class="error-msg">{{ $message }}</p> @enderror
            <button type="submit">Verificar</button>
        </form>

        <form action="{{ route('2fa.enviar') }}" method="POST" style="margin-top:10px;">
            @csrf
            <button type="submit" class="btn-link">Reenviar codi</button>
        </form>
    </div>
</div>
</body>
</html>
