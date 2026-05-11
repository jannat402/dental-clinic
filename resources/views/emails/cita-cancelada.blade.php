<!DOCTYPE html>
<html lang="ca">
<head><meta charset="UTF-8"><title>Cita cancel·lada</title></head>
<body style="font-family:Arial,sans-serif;background:#f4f8fb;padding:30px;">
<div style="max-width:600px;margin:0 auto;background:white;border-radius:12px;box-shadow:0 0 15px rgba(0,0,0,0.08);padding:30px;">
    <h1 style="color:#e53935;">Cita cancel·lada</h1>
    <p>Hola {{ $cita->cliente->nombre }}, la teva cita del <strong>{{ $cita->fecha }}</strong> a les <strong>{{ $cita->hora_inicio }}</strong> ha estat cancel·lada.</p>
    <p style="color:#666;">Si ho desitges, pots reservar una nova cita al nostre web.</p>
    <p style="color:#666;">Disculpa les molèsties.</p>
</div>
</body>
</html>
