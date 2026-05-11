@extends('layouts.admin-crud')
@section('title', 'Clientes')
@section('contenido')
<h1>Clientes</h1>
<a class="btn" href="{{ route('clientes.create') }}" style="margin-bottom:20px;">Nou client</a>
<table>
    <tr><th>Nom</th><th>Email</th><th>Teléfono</th><th>Estado</th><th>Acciones</th></tr>
    @foreach($clientes as $c)
    <tr>
        <td>{{ $c->nombre }} {{ $c->apellidos }}</td>
        <td>{{ $c->email }}</td>
        <td>{{ $c->telefono }}</td>
        <td>{{ $c->estat ?? 'actiu' }}</td>
        <td>
            <a class="btn" href="{{ route('clientes.show', $c->id_cliente) }}">Ver</a>
            <a class="btn" href="{{ route('clientes.edit', $c->id_cliente) }}">Editar</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection
