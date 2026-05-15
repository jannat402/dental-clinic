@extends('layouts.admin-crud')
@section('title', 'Detalle historial')
@section('contenido')
<h1>Historial clínico</h1>
<div class="box">
    <div class="detail-group">
        <label>Cliente</label>
        <div class="detail-value">{{ $historial->cliente->nombre }} {{ $historial->cliente->apellidos }}</div>
    </div>
    <div class="detail-group">
        <label>Notas de diagnóstico</label>
        <div class="detail-value">{{ $historial->notas_diagnostico }}</div>
    </div>
    <div class="detail-group">
        <label>Documentos adjuntos</label>
        <div class="detail-value">{{ $historial->documentos_adjuntos ?? '—' }}</div>
    </div>
    <div class="detail-group">
        <label>Última actualización</label>
        <div class="detail-value">{{ $historial->fecha_ultima_actualizacion }}</div>
    </div>
</div>
<a class="btn" href="{{ route('historial.edit', $historial->id_historial) }}">Editar</a>
<a class="btn" href="{{ route('historial.index') }}">Volver</a>
@endsection