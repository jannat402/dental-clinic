@extends('layouts.admin-crud')
@section('title', 'Historiales clínicos')
@section('contenido')
<h1>Historiales clínicos</h1>
<a class="btn" href="{{ route('historial.create') }}" style="margin-bottom:20px;">Nuevo registro</a>
<table>
    <tr><th>Cliente</th><th>Notas</th><th>Última actualización</th><th>Acciones</th></tr>
    @foreach($historiales as $h)
    <tr>
        <td>{{ $h->cliente->nombre }} {{ $h->cliente->apellidos }}</td>
        <td>{{ Str::limit($h->notas_diagnostico, 50) }}</td>
        <td>{{ $h->fecha_ultima_actualizacion }}</td>
        <td>
            <a class="btn" href="{{ route('historial.show', $h->id_historial) }}">Ver</a>
            <a class="btn" href="{{ route('historial.edit', $h->id_historial) }}">Editar</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection
