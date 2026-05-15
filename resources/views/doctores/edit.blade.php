@extends('layouts.admin-crud')
@section('title', 'Editar doctor')
@section('contenido')
<h1>Editar doctor</h1>
<form action="{{ route('doctores.update', $doctor->id_doctor) }}" method="POST">
    @csrf @method('PUT')
    <div class="box">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="{{ $doctor->nombre }}" required>
        <label>Apellidos:</label>
        <input type="text" name="apellidos" value="{{ $doctor->apellidos }}" required>
        <label>Email:</label>
        <input type="email" name="email" value="{{ $doctor->email }}" required>
        <label>Especialidad:</label>
        <input type="text" name="especialidad" value="{{ $doctor->especialidad }}">
        <label>Estado:</label>
        <select name="estado">
            <option value="activo" {{ $doctor->estado == 'activo' ? 'selected' : '' }}>Activo</option>
            <option value="vacaciones" {{ $doctor->estado == 'vacaciones' ? 'selected' : '' }}>Vacaciones</option>
            <option value="baja" {{ $doctor->estado == 'baja' ? 'selected' : '' }}>Baja</option>
        </select>
        <label>Nueva contraseña (dejar vacío para no cambiar):</label>
        <input type="password" name="contrasenya">
        <label>Doble factor (2FA):</label>
        <select name="doble_factor">
            <option value="0" {{ !$doctor->doble_factor ? 'selected' : '' }}>No</option>
            <option value="1" {{ $doctor->doble_factor ? 'selected' : '' }}>Sí</option>
        </select>
        <button type="submit">Actualizar</button>
    </div>
</form>
@endsection