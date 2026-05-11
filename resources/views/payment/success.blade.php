<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del pago - Dental Clinic</title>
    <link rel="stylesheet" href="{{ asset('css/pago.css') }}">
</head>
<body>
    <main>
        <img src="{{ asset('images/logosinfondo.png') }}" alt="Dental Clinic" class="pago-logo">

        @if($status === 'succeeded')
            <div class="pago-card">
                <div class="icono">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#00ff9d" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                </div>
                <h1 class="exito">¡Reserva confirmada!</h1>
                <p>El pago se ha procesado correctamente.</p>

                @if(isset($cita))
                    <div class="resum-pago">
                        <p><span class="label">Data</span><span class="value">{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</span></p>
                        <p><span class="label">Hora</span><span class="value">{{ substr($cita->hora_inicio, 0, 5) }}</span></p>
                        <p><span class="label">Doctor</span><span class="value">{{ $cita->doctor->nombre }} {{ $cita->doctor->apellidos }}</span></p>
                        <p><span class="label">Tratamiento</span><span class="value">{{ $cita->tratamiento->nombre_tratamiento }}</span></p>
                    </div>
                @endif

                <a href="{{ route('mostrar') }}" class="btn-pago">Ver mis citas</a>
                <p class="id-simulat">ID simulado: {{ $paymentIntent }}</p>
            </div>
        @else
            <div class="pago-card">
                <div class="icono">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#ff6b6b" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                    </svg>
                </div>
                <h1 class="error">Pago fallido</h1>
                <p>{{ $message ?: 'Ha habido un error. Inténtalo de nuevo.' }}</p>

                @if(isset($cita))
                    <a href="{{ route('payment.page', ['id_cita' => $cita->id_cita]) }}" class="btn-pago">Intentar de nuevo</a>
                @else
                    <a href="{{ route('pedircita') }}" class="btn-pago">Nueva reserva</a>
                @endif
            </div>
        @endif

        <div class="pago-footer"><a href="{{ route('landing') }}">Volver al inicio</a></div>
    </main>
</body>
</html>
