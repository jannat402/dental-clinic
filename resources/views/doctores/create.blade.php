@extends('layouts.admin-crud')
@section('title', 'Nou doctor')
@section('contenido')
<h1>Nou doctor</h1>
<form action="{{ route('doctores.store') }}" method="POST">
    @csrf
    <label>Nom:</label><input type="text" name="nombre" required>
    <label>Apellidos:</label><input type="text" name="apellidos" required>
    <label>Email:</label><input type="email" name="email" required>
    <label>Especialitat:</label><input type="text" name="especialidad">
    <label>Contrasenya:</label><input type="password" name="contrasenya" required>
    <label>Doble factor (2FA):</label>
    <select name="doble_factor"><option value="0">No</option><option value="1">Sí</option></select>
    <button type="submit">Crear</button>
</form>
@endsection
