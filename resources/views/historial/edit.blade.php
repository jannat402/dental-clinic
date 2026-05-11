@extends('layouts.admin-crud')
@section('title', 'Editar historial')
@section('contenido')
<h1>Editar historial clínic</h1>
<form action="{{ route('historial.update', $historial->id_historial) }}" method="POST">
    @csrf @method('PUT')
    <label>Client:</label>
    <select name="id_cliente" required>
        @foreach($clientes as $c)
        <option value="{{ $c->id_cliente }}" {{ $historial->id_cliente == $c->id_cliente ? 'selected' : '' }}>{{ $c->nombre }} {{ $c->apellidos }}</option>
        @endforeach
    </select>
    <label>Notes diagnòstic:</label><textarea name="notas_diagnostico">{{ $historial->notas_diagnostico }}</textarea>
    <label>Documents adjunts:</label><input type="text" name="documentos_adjuntos" value="{{ $historial->documentos_adjuntos }}">
    <button type="submit">Actualitzar</button>
</form>
@endsection
