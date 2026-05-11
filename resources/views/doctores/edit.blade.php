@extends('layouts.admin-crud')
@section('title', 'Editar doctor')
@section('contenido')
<h1>Editar doctor</h1>
<form action="{{ route('doctores.update', $doctor->id_doctor) }}" method="POST">
    @csrf @method('PUT')
    <label>Nom:</label><input type="text" name="nombre" value="{{ $doctor->nombre }}" required>
    <label>Apellidos:</label><input type="text" name="apellidos" value="{{ $doctor->apellidos }}" required>
    <label>Email:</label><input type="email" name="email" value="{{ $doctor->email }}" required>
    <label>Especialitat:</label><input type="text" name="especialidad" value="{{ $doctor->especialidad }}">
    <label>Estat:</label>
    <select name="estado">
        <option value="activo" {{ $doctor->estado == 'activo' ? 'selected' : '' }}>Actiu</option>
        <option value="vacaciones" {{ $doctor->estado == 'vacaciones' ? 'selected' : '' }}>Vacances</option>
        <option value="baja" {{ $doctor->estado == 'baja' ? 'selected' : '' }}>Baixa</option>
    </select>
    <label>Doble factor (2FA):</label>
    <select name="doble_factor">
        <option value="0" {{ !$doctor->doble_factor ? 'selected' : '' }}>No</option>
        <option value="1" {{ $doctor->doble_factor ? 'selected' : '' }}>Sí</option>
    </select>
    <button type="submit">Actualitzar</button>
</form>
@endsection
