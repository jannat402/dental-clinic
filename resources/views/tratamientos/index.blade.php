@extends('layouts.admin-crud')
@section('title', 'Tractaments')
@section('contenido')
<h1>Tractaments</h1>
<a class="btn" href="{{ route('tratamientos.create') }}" style="margin-bottom:20px;">Nou tractament</a>
<table>
    <tr><th>Nom</th><th>Durada</th><th>Preu</th><th>Descripció</th><th>Accions</th></tr>
    @foreach($tratamientos as $t)
    <tr>
        <td>{{ $t->nombre_tratamiento }}</td>
        <td>{{ $t->duracion_minutos }} min</td>
        <td>{{ $t->precio }}€</td>
        <td>{{ Str::limit($t->descripcion, 50) }}</td>
        <td>
            <a class="btn" href="{{ route('tratamientos.show', $t->id_tratamiento) }}">Veure</a>
            <a class="btn" href="{{ route('tratamientos.edit', $t->id_tratamiento) }}">Editar</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection
