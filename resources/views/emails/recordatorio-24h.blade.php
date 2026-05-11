<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Recordatorio de cita</title></head>
<body style="font-family:Arial,sans-serif;background:#f4f8fb;padding:30px;">
<div style="max-width:600px;margin:0 auto;background:white;border-radius:12px;box-shadow:0 0 15px rgba(0,0,0,0.08);padding:30px;">
    <h1 style="color:#1565c0;">Recordatorio de cita</h1>
    <p>Hola {{ $cita->cliente->nombre }}, te recordamos que tienes una cita mañana.</p>
    <table style="width:100%;border-collapse:collapse;margin:20px 0;">
        <tr><td style="padding:8px;font-weight:bold;">Fecha:</td><td style="padding:8px;">{{ $cita->fecha }}</td></tr>
        <tr><td style="padding:8px;font-weight:bold;">Hora:</td><td style="padding:8px;">{{ $cita->hora_inicio }}</td></tr>
        <tr><td style="padding:8px;font-weight:bold;">Doctor:</td><td style="padding:8px;">{{ $cita->doctor->nombre }} {{ $cita->doctor->apellidos }}</td></tr>
        <tr><td style="padding:8px;font-weight:bold;">Tratamiento:</td><td style="padding:8px;">{{ $cita->tratamiento->nombre_tratamiento }}</td></tr>
    </table>
    <p style="color:#666;">Si no puedes asistir, recuerda cancelar con 48h de antelación.</p>
</div>
</body>
</html>
