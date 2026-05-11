<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Cita cancelada</title></head>
<body style="font-family:Arial,sans-serif;background:#f4f8fb;padding:30px;">
<div style="max-width:600px;margin:0 auto;background:white;border-radius:12px;box-shadow:0 0 15px rgba(0,0,0,0.08);padding:30px;">
    <h1 style="color:#e53935;">Cita cancelada</h1>
    <p>Hola {{ $cita->cliente->nombre }}, tu cita del <strong>{{ $cita->fecha }}</strong> a las <strong>{{ $cita->hora_inicio }}</strong> ha sido cancelada.</p>
    <p style="color:#666;">Si lo deseas, puedes reservar una nueva cita en nuestra web.</p>
    <p style="color:#666;">Disculpa las molestias.</p>
</div>
</body>
</html>
