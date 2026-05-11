<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar cita - Dental Clinic</title>
    <link rel="stylesheet" href="{{asset('css/citaseleccionada.css')}}">
</head>
<body>
    <main>
        <h1>Confirma tu cita</h1>

        @php
            $doctor = \App\Models\Doctor::find($id_doctor);
            $tractament = \App\Models\Tratamiento::find($id_tratamiento);
        @endphp

        <div class="resum">
            <div class="resum-item">
                <span class="resum-label">Doctor</span>
                <span class="resum-value">Dr. {{ $doctor->nombre ?? '' }} {{ $doctor->apellidos ?? '' }}</span>
            </div>
            <div class="resum-item">
                <span class="resum-label">Tratamiento</span>
                <span class="resum-value">{{ $tractament->nombre_tratamiento ?? '' }}</span>
            </div>
            <div class="resum-item">
                <span class="resum-label">Data</span>
                <span class="resum-value">{{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}</span>
            </div>
            <div class="resum-item">
                <span class="resum-label">Hora</span>
                <span class="resum-value">{{ substr($hora_inicio, 0, 5) }} - {{ substr($hora_fin, 0, 5) }}</span>
            </div>
            <div class="resum-item">
                <span class="resum-label">Precio</span>
                <span class="resum-value">{{ $tractament->precio ?? '0' }}€</span>
            </div>
        </div>

        <p style="text-align:center;margin-bottom:25px;">Revisa los datos antes de confirmar.</p>

        <form action="{{ route('citas.store') }}" method="POST" style="text-align:center;">
            @csrf
            <input type="hidden" name="id_cliente" value="{{ session('cliente_id') }}">
            <input type="hidden" name="id_doctor" value="{{ $id_doctor }}">
            <input type="hidden" name="id_tratamiento" value="{{ $id_tratamiento }}">
            <input type="hidden" name="fecha" value="{{ $fecha }}">
            <input type="hidden" name="hora_inicio" value="{{ $hora_inicio }}">
            <input type="hidden" name="hora_fin" value="{{ $hora_fin }}">
            <input type="hidden" name="estado" value="reservada">
            <input type="hidden" name="tipo_reserva" value="online">
            @if(isset($clau))
                <input type="hidden" name="clau" value="{{ $clau }}">
            @endif
            <button type="submit" class="btn-confirmar">Confirmar reserva</button>
        </form>

        <div style="text-align:center;margin-top:15px;">
            <a href="{{ route('pedircita') }}" style="color:rgba(255,255,255,0.7);">Volver atrás</a>
        </div>
    </main>
</body>
</html>
