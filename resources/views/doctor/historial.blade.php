@extends('doctor.layout')

@section('contenido')

<h1>Historiales Clínicos</h1>

<p>Seleccione un paciente para ver su historial.</p>

<table>
    <tr>
        <th>Paciente</th>
        <th>Acciones</th>
    </tr>

    @foreach($pacientes as $cliente)
    <tr>
        <td>{{ $cliente->nombre }} {{ $cliente->apellidos }}</td>
        <td>
            <a class="btn" href="{{ route('doctor.historial.ver', $cliente->id_cliente) }}">Ver historial</a>
        </td>
    </tr>
    @endforeach
</table>

@endsection
