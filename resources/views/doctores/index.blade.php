@extends('layouts.admin-crud')
@section('title', 'Doctores')
@section('contenido')
<h1>Doctores</h1>
<a class="btn" href="{{ route('doctores.create') }}" style="margin-bottom:20px;">Nuevo doctor</a>
<table>
    <tr><th>Nom</th><th>Email</th><th>Especialidad</th><th>Estado</th><th>2FA</th><th>Acciones</th></tr>
    @foreach($doctores as $d)
    <tr>
        <td>{{ $d->nombre }} {{ $d->apellidos }}</td>
        <td>{{ $d->email }}</td>
        <td>{{ $d->especialidad }}</td>
        <td>{{ $d->estado }}</td>
        <td>{{ $d->doble_factor ? 'Sí' : 'No' }}</td>
        <td>
            <a class="btn" href="{{ route('doctores.show', $d->id_doctor) }}">Ver</a>
            <a class="btn" href="{{ route('doctores.edit', $d->id_doctor) }}">Editar</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection
