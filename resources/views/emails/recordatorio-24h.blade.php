<!DOCTYPE html>
<html lang="ca">
<head><meta charset="UTF-8"><title>Recordatori cita</title></head>
<body style="font-family:Arial,sans-serif;background:#f4f8fb;padding:30px;">
<div style="max-width:600px;margin:0 auto;background:white;border-radius:12px;box-shadow:0 0 15px rgba(0,0,0,0.08);padding:30px;">
    <h1 style="color:#1565c0;">Recordatori de cita</h1>
    <p>Hola {{ $cita->cliente->nombre }}, et recordem que tens una cita demà.</p>
    <table style="width:100%;border-collapse:collapse;margin:20px 0;">
        <tr><td style="padding:8px;font-weight:bold;">Data:</td><td style="padding:8px;">{{ $cita->fecha }}</td></tr>
        <tr><td style="padding:8px;font-weight:bold;">Hora:</td><td style="padding:8px;">{{ $cita->hora_inicio }}</td></tr>
        <tr><td style="padding:8px;font-weight:bold;">Doctor:</td><td style="padding:8px;">{{ $cita->doctor->nombre }} {{ $cita->doctor->apellidos }}</td></tr>
        <tr><td style="padding:8px;font-weight:bold;">Tractament:</td><td style="padding:8px;">{{ $cita->tratamiento->nombre_tratamiento }}</td></tr>
    </table>
    <p style="color:#666;">Si no pots assistir, recorda cancel·lar amb 48h d'antelació.</p>
</div>
</body>
</html>
