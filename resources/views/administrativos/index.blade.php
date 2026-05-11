@extends('layouts.admin-crud')
@section('title', 'Administradores')
@section('contenido')
<h1>Administradores</h1>
<a class="btn" href="{{ route('administrativos.create') }}" style="margin-bottom:20px;">Nuevo administrador</a>
<table>
    <tr><th>Nom</th><th>Email</th><th>Autenticación</th><th>Rol</th><th>Acciones</th></tr>
    @foreach($admins as $a)
    <tr>
        <td>{{ $a->nombre }} {{ $a->apellidos }}</td>
        <td>{{ $a->email }}</td>
        <td>{{ $a->autenticacion_segura }}</td>
        <td>{{ $a->rol }}</td>
        <td>
            <a class="btn" href="{{ route('administrativos.show', $a->id_admin) }}">Ver</a>
            <a class="btn" href="{{ route('administrativos.edit', $a->id_admin) }}">Editar</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection
