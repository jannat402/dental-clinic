@extends('layouts.admin-crud')
@section('title', 'Nuevo tratamiento')
@section('contenido')
<h1>Nuevo tratamiento</h1>
<form action="{{ route('tratamientos.store') }}" method="POST">
    @csrf
    <label>Nom:</label><input type="text" name="nombre_tratamiento" required>
    <label>Durada (minuts):</label><input type="number" name="duracion_minutos" min="1" required>
    <label>Precio (€):</label><input type="number" name="precio" step="0.01" min="0.01" required>
    <label>Descripción:</label><textarea name="descripcion"></textarea>
    <button type="submit">Crear</button>
</form>
@endsection
