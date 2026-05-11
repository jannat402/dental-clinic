@extends('layouts.admin-crud')
@section('title', 'Detalle tratamiento')
@section('contenido')
<h1>{{ $tratamiento->nombre_tratamiento }}</h1>
<p><strong>Durada:</strong> {{ $tratamiento->duracion_minutos }} minutos</p>
<p><strong>Precio:</strong> {{ $tratamiento->precio }}€</p>
<p><strong>Descripción:</strong> {{ $tratamiento->descripcion }}</p>
<a class="btn" href="{{ route('tratamientos.edit', $tratamiento->id_tratamiento) }}">Editar</a>
<a class="btn" href="{{ route('tratamientos.index') }}">Volver</a>
@endsection
