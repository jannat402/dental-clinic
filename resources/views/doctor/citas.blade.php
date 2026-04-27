@extends('doctor.layout')

@section('contenido')

<h1>Mis Citas</h1>

<table>
    <tr>
        <th>Paciente</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Tratamiento</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tr>

    @foreach($citas as $cita)
    <tr>
        <td>{{ $cita->cliente->nombre }} {{ $cita->cliente->apellidos }}</td>
        <td>{{ $cita->fecha }}</td>
        <td>{{ $cita->hora }}</td>
        <td>{{ $cita->tratamiento->nombre }}</td>
        <td>{{ $cita->estado }}</td>
        <td>
            <a class="btn" href="{{ route('doctor.notas', $cita->id_cita) }}">Añadir notas</a>
        </td>
    </tr>
    @endforeach
</table>

@endsection
