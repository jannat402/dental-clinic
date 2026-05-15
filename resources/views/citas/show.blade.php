@extends('layouts.admin-crud')
@section('title', 'Detalle cita')
@section('contenido')
<h1>Cita #{{ $cita->id_cita }}</h1>
<div class="box">
    <div class="detail-group">
        <label>Cliente</label>
        <div class="detail-value">{{ $cita->cliente->nombre ?? '—' }} {{ $cita->cliente->apellidos ?? '' }}</div>
    </div>
    <div class="detail-group">
        <label>Doctor</label>
        <div class="detail-value">{{ $cita->doctor->nombre ?? '—' }}</div>
    </div>
    <div class="detail-group">
        <label>Tratamiento</label>
        <div class="detail-value">{{ $cita->tratamiento->nombre_tratamiento ?? '—' }}</div>
    </div>
    <div class="detail-group">
        <label>Fecha</label>
        <div class="detail-value">{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</div>
    </div>
    <div class="detail-group">
        <label>Hora</label>
        <div class="detail-value">{{ substr($cita->hora_inicio, 0, 5) }} - {{ substr($cita->hora_fin, 0, 5) }}</div>
    </div>
    <div class="detail-group">
        <label>Estado</label>
        <div class="detail-value">{{ $cita->estado }}</div>
    </div>
    <div class="detail-group">
        <label>Tipo</label>
        <div class="detail-value">{{ $cita->tipo_reserva ?? '—' }}</div>
    </div>
</div>

<div class="btn-group">
    <a class="btn" href="{{ route('citas.index') }}">Volver</a>
    @if(in_array($cita->estado, ['reservada', 'pendiente_pago']))
    <form action="{{ route('citas.destroy', $cita->id_cita) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Cancelar esta cita?');">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-danger">Cancelar cita</button>
    </form>
    @endif
</div>
@endsection