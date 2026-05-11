@extends('layouts.admin-crud')
@section('title', 'Nuevo administrador')
@section('contenido')
<h1>Nuevo administrador</h1>
<form action="{{ route('administrativos.store') }}" method="POST">
    @csrf
    <label>Nom:</label><input type="text" name="nombre" required>
    <label>Apellidos:</label><input type="text" name="apellidos" required>
    <label>Email:</label><input type="email" name="email" required>
    <label>Contrasenya:</label><input type="password" name="contrasenya" required>
    <label>Autenticación segura:</label>
    <select name="autenticacion_segura">
        <option value="2FA">2FA</option>
        <option value="certificado">Certificado</option>
    </select>
    <label>Rol:</label><input type="text" name="rol" value="admin" required>
    <button type="submit">Crear</button>
</form>
@endsection
