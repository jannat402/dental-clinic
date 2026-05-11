@extends('layouts.admin-crud')
@section('title', 'Nuevo registro clínico')
@section('contenido')
<h1>Nuevo registro clínico</h1>
<form action="{{ route('historial.store') }}" method="POST">
    @csrf
    <label>Cliente:</label>
    <select name="id_cliente" required>
        @foreach($clientes as $c)
        <option value="{{ $c->id_cliente }}">{{ $c->nombre }} {{ $c->apellidos }}</option>
        @endforeach
    </select>
    <label>Notas diagnóstico:</label><textarea name="notas_diagnostico"></textarea>
    <label>Documentos adjuntos:</label><input type="text" name="documentos_adjuntos">
    <button type="submit">Crear</button>
</form>
@endsection
