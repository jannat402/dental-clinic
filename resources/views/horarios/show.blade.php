@extends('layouts.admin-crud')
@section('title', 'Detalle horario')
@section('contenido')
<h1>Horario</h1>
<p><strong>Doctor:</strong> {{ $horario->doctor->nombre }} {{ $horario->doctor->apellidos }}</p>
<p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($horario->fecha)->format('d/m/Y') }}</p>
<p><strong>Inicio:</strong> {{ substr($horario->hora_inicio, 0, 5) }}</p>
<p><strong>Fin:</strong> {{ substr($horario->hora_fin, 0, 5) }}</p>
<p><strong>Disponible:</strong>
    <span class="badge {{ $horario->disponible ? 'badge-available' : 'badge-blocked' }}">
        {{ $horario->disponible ? 'Sí' : 'No' }}
    </span>
</p>
@if(!$horario->disponible)
    <p><strong>Tipo bloqueo:</strong> {{ $horario->tipus_bloqueig ?? '—' }}</p>
    <p><strong>Motivo:</strong> {{ $horario->motivo_bloqueo ?? '—' }}</p>
@endif
<a class="btn" href="{{ route('horarios.edit', $horario->id_horario) }}">Editar</a>
<a class="btn" href="{{ route('horarios.index') }}">Volver</a>
@endsection
