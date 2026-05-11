@extends('layouts.admin-crud')
@section('title', 'Detall horari')
@section('contenido')
<h1>Horari</h1>
<p><strong>Doctor:</strong> {{ $horario->doctor->nombre }} {{ $horario->doctor->apellidos }}</p>
<p><strong>Data:</strong> {{ \Carbon\Carbon::parse($horario->fecha)->format('d/m/Y') }}</p>
<p><strong>Inici:</strong> {{ substr($horario->hora_inicio, 0, 5) }}</p>
<p><strong>Fi:</strong> {{ substr($horario->hora_fin, 0, 5) }}</p>
<p><strong>Disponible:</strong>
    <span class="badge {{ $horario->disponible ? 'badge-available' : 'badge-blocked' }}">
        {{ $horario->disponible ? 'Sí' : 'No' }}
    </span>
</p>
@if(!$horario->disponible)
    <p><strong>Tipus bloqueig:</strong> {{ $horario->tipus_bloqueig ?? '—' }}</p>
    <p><strong>Motiu:</strong> {{ $horario->motivo_bloqueo ?? '—' }}</p>
@endif
<a class="btn" href="{{ route('horarios.edit', $horario->id_horario) }}">Editar</a>
<a class="btn" href="{{ route('horarios.index') }}">Tornar</a>
@endsection
