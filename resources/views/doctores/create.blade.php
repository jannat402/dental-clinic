@extends('layouts.admin-crud')
@section('title', 'Nuevo doctor')
@section('contenido')
<h1>Nuevo doctor</h1>
<form action="{{ route('doctores.store') }}" method="POST">
    @csrf
    <div class="box">
        <label>Nombre:</label>
        <input type="text" name="nombre" required>
        <label>Apellidos:</label>
        <input type="text" name="apellidos" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Especialidad:</label>
        <input type="text" name="especialidad">
        <label>Contraseña:</label>
        <input type="password" name="contrasenya" required>
        <label>Doble factor (2FA):</label>
        <select name="doble_factor">
            <option value="0">No</option>
            <option value="1">Sí</option>
        </select>
        <button type="submit">Crear</button>
    </div>
</form>
@endsection