@extends('layouts.admin-crud')
@section('title', 'Detall historial')
@section('contenido')
<h1>Historial clínic</h1>
<p><strong>Client:</strong> {{ $historial->cliente->nombre }} {{ $historial->cliente->apellidos }}</p>
<p><strong>Notes:</strong> {{ $historial->notas_diagnostico }}</p>
<p><strong>Documents:</strong> {{ $historial->documentos_adjuntos ?? '—' }}</p>
<p><strong>Última actualització:</strong> {{ $historial->fecha_ultima_actualizacion }}</p>
<a class="btn" href="{{ route('historial.edit', $historial->id_historial) }}">Editar</a>
<a class="btn" href="{{ route('historial.index') }}">Tornar</a>
@endsection
