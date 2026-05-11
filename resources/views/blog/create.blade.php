@extends('layouts.admin-crud')
@section('title', 'Nou article')
@section('contenido')
<h1>Nou article de blog</h1>
<form action="{{ route('blog.store') }}" method="POST">
    @csrf
    <label>Títol:</label><input type="text" name="titulo" required>
    <label>Contingut:</label><textarea name="contenido" rows="10" required></textarea>
    <label>Autor:</label>
    <select name="autor_id">
        <option value="">Selecciona...</option>
        @foreach($admins as $a)
        <option value="{{ $a->id_admin }}">{{ $a->nombre }} {{ $a->apellidos }}</option>
        @endforeach
    </select>
    <label>Tractament relacionat:</label>
    <select name="id_tratamiento">
        <option value="">Cap</option>
        @foreach($tratamientos ?? [] as $t)
        <option value="{{ $t->id_tratamiento }}">{{ $t->nombre_tratamiento }}</option>
        @endforeach
    </select>
    <label>Enllaç a reserva de cita:</label>
    <select name="enlace_cita">
        <option value="1">Sí</option>
        <option value="0">No</option>
    </select>
    <button type="submit">Publicar</button>
</form>
@endsection
