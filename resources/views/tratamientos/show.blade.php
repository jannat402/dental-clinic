@extends('layouts.admin-crud')
@section('title', 'Detall tractament')
@section('contenido')
<h1>{{ $tratamiento->nombre_tratamiento }}</h1>
<p><strong>Durada:</strong> {{ $tratamiento->duracion_minutos }} minuts</p>
<p><strong>Preu:</strong> {{ $tratamiento->precio }}€</p>
<p><strong>Descripció:</strong> {{ $tratamiento->descripcion }}</p>
<a class="btn" href="{{ route('tratamientos.edit', $tratamiento->id_tratamiento) }}">Editar</a>
<a class="btn" href="{{ route('tratamientos.index') }}">Tornar</a>
@endsection
