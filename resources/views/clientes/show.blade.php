@extends('layouts.admin-crud')
@section('title', 'Detalle cliente')
@section('contenido')
<h1>Cliente: {{ $cliente->nombre }} {{ $cliente->apellidos }}</h1>
<div class="box">
    <div class="detail-group">
        <label>Email</label>
        <div class="detail-value">{{ $cliente->email }}</div>
    </div>
    <div class="detail-group">
        <label>Teléfono</label>
        <div class="detail-value">{{ $cliente->telefono }}</div>
    </div>
    <div class="detail-group">
        <label>Estado</label>
        <div class="detail-value">{{ $cliente->estat ?? 'Activo' }}</div>
    </div>
</div>
<a class="btn" href="{{ route('clientes.edit', $cliente->id_cliente) }}">Editar</a>
<a class="btn" href="{{ route('clientes.index') }}">Volver</a>
@endsection