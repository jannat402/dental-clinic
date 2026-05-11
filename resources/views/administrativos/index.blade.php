@extends('layouts.admin-crud')
@section('title', 'Administradors')
@section('contenido')
<h1>Administradors</h1>
<a class="btn" href="{{ route('administrativos.create') }}" style="margin-bottom:20px;">Nou administrador</a>
<table>
    <tr><th>Nom</th><th>Email</th><th>Autenticació</th><th>Rol</th><th>Accions</th></tr>
    @foreach($admins as $a)
    <tr>
        <td>{{ $a->nombre }} {{ $a->apellidos }}</td>
        <td>{{ $a->email }}</td>
        <td>{{ $a->autenticacion_segura }}</td>
        <td>{{ $a->rol }}</td>
        <td>
            <a class="btn" href="{{ route('administrativos.show', $a->id_admin) }}">Veure</a>
            <a class="btn" href="{{ route('administrativos.edit', $a->id_admin) }}">Editar</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection
