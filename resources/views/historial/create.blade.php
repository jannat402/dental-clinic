@extends('layouts.admin-crud')
@section('title', 'Nou registre clínic')
@section('contenido')
<h1>Nou registre clínic</h1>
<form action="{{ route('historial.store') }}" method="POST">
    @csrf
    <label>Client:</label>
    <select name="id_cliente" required>
        @foreach($clientes as $c)
        <option value="{{ $c->id_cliente }}">{{ $c->nombre }} {{ $c->apellidos }}</option>
        @endforeach
    </select>
    <label>Notes diagnòstic:</label><textarea name="notas_diagnostico"></textarea>
    <label>Documents adjunts:</label><input type="text" name="documentos_adjuntos">
    <button type="submit">Crear</button>
</form>
@endsection
