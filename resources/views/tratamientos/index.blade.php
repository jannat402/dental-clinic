@extends('layouts.admin-crud')
@section('title', 'Tratamientos')
@section('contenido')
<h1>Tratamientos</h1>
<a class="btn" href="{{ route('tratamientos.create') }}" style="margin-bottom:20px;">Nuevo tratamiento</a>
<table>
    <tr><th>Nom</th><th>Durada</th><th>Precio</th><th>Descripción</th><th>Acciones</th></tr>
    @foreach($tratamientos as $t)
    <tr>
        <td>{{ $t->nombre_tratamiento }}</td>
        <td>{{ $t->duracion_minutos }} min</td>
        <td>{{ $t->precio }}€</td>
        <td>{{ Str::limit($t->descripcion, 50) }}</td>
        <td>
            <a class="btn" href="{{ route('tratamientos.show', $t->id_tratamiento) }}">Ver</a>
            <a class="btn" href="{{ route('tratamientos.edit', $t->id_tratamiento) }}">Editar</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection
