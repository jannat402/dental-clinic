@extends('layouts.admin-crud')
@section('title', 'Editar administrador')
@section('contenido')
<h1>Editar administrador</h1>
<form action="{{ route('administrativos.update', $admin->id_admin) }}" method="POST">
    @csrf @method('PUT')
    <label>Nom:</label><input type="text" name="nombre" value="{{ $admin->nombre }}" required>
    <label>Apellidos:</label><input type="text" name="apellidos" value="{{ $admin->apellidos }}" required>
    <label>Email:</label><input type="email" name="email" value="{{ $admin->email }}" required>
    <label>Autenticació segura:</label>
    <select name="autenticacion_segura">
        <option value="2FA" {{ $admin->autenticacion_segura == '2FA' ? 'selected' : '' }}>2FA</option>
        <option value="certificado" {{ $admin->autenticacion_segura == 'certificado' ? 'selected' : '' }}>Certificat</option>
    </select>
    <label>Rol:</label><input type="text" name="rol" value="{{ $admin->rol }}" required>
    <button type="submit">Actualitzar</button>
</form>
@endsection
