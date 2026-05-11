@extends('layouts.admin-crud')
@section('title', 'Editar tratamiento')
@section('contenido')
<h1>Editar tratamiento</h1>
<form action="{{ route('tratamientos.update', $tratamiento->id_tratamiento) }}" method="POST">
    @csrf @method('PUT')
    <label>Nom:</label><input type="text" name="nombre_tratamiento" value="{{ $tratamiento->nombre_tratamiento }}" required>
    <label>Durada (minuts):</label><input type="number" name="duracion_minutos" value="{{ $tratamiento->duracion_minutos }}" min="1" required>
    <label>Precio (€):</label><input type="number" name="precio" value="{{ $tratamiento->precio }}" step="0.01" min="0.01" required>
    <label>Descripción:</label><textarea name="descripcion">{{ $tratamiento->descripcion }}</textarea>
    <button type="submit">Actualitzar</button>
</form>
@endsection
