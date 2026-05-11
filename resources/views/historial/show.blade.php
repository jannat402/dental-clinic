@extends('layouts.admin-crud')
@section('title', 'Detalle historial')
@section('contenido')
<h1>Historial clínico</h1>
<p><strong>Cliente:</strong> {{ $historial->cliente->nombre }} {{ $historial->cliente->apellidos }}</p>
<p><strong>Notas:</strong> {{ $historial->notas_diagnostico }}</p>
<p><strong>Documentos:</strong> {{ $historial->documentos_adjuntos ?? '—' }}</p>
<p><strong>Última actualización:</strong> {{ $historial->fecha_ultima_actualizacion }}</p>
<a class="btn" href="{{ route('historial.edit', $historial->id_historial) }}">Editar</a>
<a class="btn" href="{{ route('historial.index') }}">Volver</a>
@endsection
