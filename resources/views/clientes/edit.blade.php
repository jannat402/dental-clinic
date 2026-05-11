@extends('layouts.admin-crud')
@section('title', 'Editar client')
@section('contenido')
<h1>Editar client</h1>
<form action="{{ route('clientes.update', $cliente->id_cliente) }}" method="POST">
    @csrf @method('PUT')
    <label>Nom:</label><input type="text" name="nombre" value="{{ $cliente->nombre }}" required>
    <label>Apellidos:</label><input type="text" name="apellidos" value="{{ $cliente->apellidos }}" required>
    <label>Email:</label><input type="email" name="email" value="{{ $cliente->email }}" required>
    <label>Telèfon:</label><input type="text" name="telefono" value="{{ $cliente->telefono }}" required>
    <button type="submit">Actualitzar</button>
</form>
@endsection
