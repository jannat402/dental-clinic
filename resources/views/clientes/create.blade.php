@extends('layouts.admin-crud')
@section('title', 'Nou client')
@section('contenido')
<h1>Nou client</h1>
<form action="{{ route('clientes.store') }}" method="POST">
    @csrf
    <label>Nom:</label><input type="text" name="nombre" required>
    <label>Apellidos:</label><input type="text" name="apellidos" required>
    <label>Email:</label><input type="email" name="email" required>
    <label>Telèfon:</label><input type="text" name="telefono" required>
    <label>Contrasenya:</label><input type="password" name="contrasenya" required>
    <button type="submit">Crear</button>
</form>
@endsection
