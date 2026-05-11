@extends('layouts.admin-crud')
@section('title', 'Blog')
@section('contenido')
<h1>Blog</h1>
<a class="btn" href="{{ route('blog.create') }}" style="margin-bottom:20px;">Nuevo artículo</a>
<table>
    <tr><th>Título</th><th>Autor</th><th>Fecha</th><th>Enlace cita</th><th>Acciones</th></tr>
    @foreach($posts as $p)
    <tr>
        <td>{{ $p->titulo }}</td>
        <td>{{ $p->autor->nombre ?? '—' }}</td>
        <td>{{ $p->fecha_publicacion }}</td>
        <td>{{ $p->enlace_cita ? 'Sí' : 'No' }}</td>
        <td>
            <a class="btn" href="{{ route('blog.show', $p->id_post) }}">Ver</a>
            <a class="btn" href="{{ route('blog.edit', $p->id_post) }}">Editar</a>
            <form action="{{ route('blog.destroy', $p->id_post) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button class="btn-danger" type="submit">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
