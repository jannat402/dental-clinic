@extends('layouts.admin-crud')
@section('title', 'Editar article')
@section('contenido')
<h1>Editar article</h1>
<form action="{{ route('blog.update', $post->id_post) }}" method="POST">
    @csrf @method('PUT')
    <label>Títol:</label><input type="text" name="titulo" value="{{ $post->titulo }}" required>
    <label>Contingut:</label><textarea name="contenido" rows="10" required>{{ $post->contenido }}</textarea>
    <label>Autor:</label>
    <select name="autor_id">
        <option value="">Selecciona...</option>
        @foreach($admins as $a)
        <option value="{{ $a->id_admin }}" {{ $post->autor_id == $a->id_admin ? 'selected' : '' }}>{{ $a->nombre }} {{ $a->apellidos }}</option>
        @endforeach
    </select>
    <label>Tractament relacionat:</label>
    <select name="id_tratamiento">
        <option value="">Cap</option>
        @foreach($tratamientos ?? [] as $t)
        <option value="{{ $t->id_tratamiento }}" {{ $post->id_tratamiento == $t->id_tratamiento ? 'selected' : '' }}>{{ $t->nombre_tratamiento }}</option>
        @endforeach
    </select>
    <label>Enllaç a reserva de cita:</label>
    <select name="enlace_cita">
        <option value="1" {{ $post->enlace_cita ? 'selected' : '' }}>Sí</option>
        <option value="0" {{ !$post->enlace_cita ? 'selected' : '' }}>No</option>
    </select>
    <button type="submit">Actualitzar</button>
</form>
@endsection
