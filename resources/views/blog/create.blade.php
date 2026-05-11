@extends('layouts.admin-crud')
@section('title', 'Nuevo artículo')
@section('contenido')
<h1>Nuevo artículo de blog</h1>
<form action="{{ route('blog.store') }}" method="POST">
    @csrf
    <label>Título:</label><input type="text" name="titulo" required>
    <label>Contenido:</label><textarea name="contenido" rows="10" required></textarea>
    <label>Autor:</label>
    <select name="autor_id">
        <option value="">Seleccionar...</option>
        @foreach($admins as $a)
        <option value="{{ $a->id_admin }}">{{ $a->nombre }} {{ $a->apellidos }}</option>
        @endforeach
    </select>
    <label>Tratamiento relacionado:</label>
    <select name="id_tratamiento">
        <option value="">Ninguno</option>
        @foreach($tratamientos ?? [] as $t)
        <option value="{{ $t->id_tratamiento }}">{{ $t->nombre_tratamiento }}</option>
        @endforeach
    </select>
    <label>Enlace a reserva de cita:</label>
    <select name="enlace_cita">
        <option value="1">Sí</option>
        <option value="0">No</option>
    </select>
    <button type="submit">Publicar</button>
</form>
@endsection
