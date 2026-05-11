@extends('layouts.admin-crud')
@section('title', $post->titulo)
@section('contenido')
<h1>{{ $post->titulo }}</h1>
<p><strong>Autor:</strong> {{ $post->autor->nombre ?? '—' }}</p>
<p><strong>Data:</strong> {{ $post->fecha_publicacion }}</p>
<hr>
<div>{{ nl2br($post->contenido) }}</div>
<hr>
@if($post->enlace_cita)
    <a class="btn" href="{{ route('pedircita') }}">Reserva la teva cita</a>
@endif
<br><br>
<a class="btn" href="{{ route('blog.edit', $post->id_post) }}">Editar</a>
<a class="btn" href="{{ route('blog.index') }}">Tornar</a>
@endsection
