@extends('doctor.layout')

@section('contenido')

<h1>Agenda del Doctor</h1>

<div class="box">
    <p>Aquí puede consultar su agenda diaria y semanal.</p>
</div>

<table>
    <tr>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Paciente</th>
        <th>Tratamiento</th>
        <th>Acciones</th>
    </tr>

    @foreach($citas as $cita)
    <tr>
        <td>{{ $cita->fecha }}</td>
        <td>{{ $cita->hora }}</td>
        <td>{{ $cita->cliente->nombre }} {{ $cita->cliente->apellidos }}</td>
        <td>{{ $cita->tratamiento->nombre }}</td>
        <td>
            <a class="btn" href="{{ route('doctor.cita.editar', $cita->id_cita) }}">Modificar</a>
            <a class="btn btn-danger" href="{{ route('doctor.cita.cancelar', $cita->id_cita) }}">Cancelar</a>
        </td>
    </tr>
    @endforeach
</table>

@endsection
