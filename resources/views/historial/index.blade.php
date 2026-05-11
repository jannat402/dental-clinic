@extends('layouts.admin-crud')
@section('title', 'Historials clínics')
@section('contenido')
<h1>Historials clínics</h1>
<a class="btn" href="{{ route('historial.create') }}" style="margin-bottom:20px;">Nou registre</a>
<table>
    <tr><th>Client</th><th>Notes</th><th>Última actualització</th><th>Accions</th></tr>
    @foreach($historiales as $h)
    <tr>
        <td>{{ $h->cliente->nombre }} {{ $h->cliente->apellidos }}</td>
        <td>{{ Str::limit($h->notas_diagnostico, 50) }}</td>
        <td>{{ $h->fecha_ultima_actualizacion }}</td>
        <td>
            <a class="btn" href="{{ route('historial.show', $h->id_historial) }}">Veure</a>
            <a class="btn" href="{{ route('historial.edit', $h->id_historial) }}">Editar</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection
