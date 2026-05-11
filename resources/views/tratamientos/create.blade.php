@extends('layouts.admin-crud')
@section('title', 'Nou tractament')
@section('contenido')
<h1>Nou tractament</h1>
<form action="{{ route('tratamientos.store') }}" method="POST">
    @csrf
    <label>Nom:</label><input type="text" name="nombre_tratamiento" required>
    <label>Durada (minuts):</label><input type="number" name="duracion_minutos" min="1" required>
    <label>Preu (€):</label><input type="number" name="precio" step="0.01" min="0.01" required>
    <label>Descripció:</label><textarea name="descripcion"></textarea>
    <button type="submit">Crear</button>
</form>
@endsection
