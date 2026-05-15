@extends('layouts.admin-crud')
@section('title', 'Detalle tratamiento')
@section('contenido')
<h1>{{ $tratamiento->nombre_tratamiento }}</h1>
<div class="box">
    <div class="detail-group">
        <label>Duración</label>
        <div class="detail-value">{{ $tratamiento->duracion_minutos }} minutos</div>
    </div>
    <div class="detail-group">
        <label>Precio</label>
        <div class="detail-value">{{ $tratamiento->precio }}€</div>
    </div>
    <div class="detail-group">
        <label>Descripción</label>
        <div class="detail-value">{{ $tratamiento->descripcion ?? '—' }}</div>
    </div>
</div>
<a class="btn" href="{{ route('tratamientos.edit', $tratamiento->id_tratamiento) }}">Editar</a>
<a class="btn" href="{{ route('tratamientos.index') }}">Volver</a>
@endsection