@extends('layouts.admin-crud')
@section('title', 'Nuevo cliente')
@section('contenido')
<h1>Nuevo cliente</h1>
<form action="{{ route('clientes.store') }}" method="POST">
    @csrf
    <div class="box">
        <label>Nombre:</label>
        <input type="text" name="nombre" required>
        <label>Apellidos:</label>
        <input type="text" name="apellidos" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Teléfono:</label>
        <input type="text" name="telefono" required>
        <label>Contraseña:</label>
        <input type="password" name="contrasenya" required>
        <button type="submit">Crear</button>
    </div>
</form>
@endsection