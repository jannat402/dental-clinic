<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar pago - Dental Clinic</title>
    <link rel="stylesheet" href="{{ asset('css/pago.css') }}">
</head>
<body>
    <main>
        <img src="{{ asset('images/logosinfondo.png') }}" alt="Dental Clinic" class="pago-logo">
        <div class="pago-card">
            <h1>Confirma tu reserva</h1>

            <div class="resum-pago">
                <p><span class="label">Doctor</span><span class="value">{{ $cita->doctor->nombre }} {{ $cita->doctor->apellidos }}</span></p>
                <p><span class="label">Tratamiento</span><span class="value">{{ $cita->tratamiento->nombre_tratamiento }}</span></p>
                <p><span class="label">Data</span><span class="value">{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</span></p>
                <p><span class="label">Hora</span><span class="value">{{ substr($cita->hora_inicio, 0, 5) }} - {{ substr($cita->hora_fin, 0, 5) }}</span></p>
            </div>

            <div class="preu-destacat">{{ number_format($cita->tratamiento->precio, 2) }} €</div>

            <div class="msg-info">Pago simulado: no se realizará ningún cargo real.</div>

            <form method="POST" action="{{ route('payment.process', ['id_cita' => $cita->id_cita]) }}">
                @csrf
                <button type="submit" class="btn-pago btn-pago-success" onclick="return confirm('¿Estás seguro de confirmar la reserva?')">
                    Confirmar i pagar
                </button>
            </form>
        </div>
        <div class="pago-footer"><a href="{{ route('mostrar') }}">Cancelar</a></div>
    </main>
</body>
</html>
