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
        <td>{{ $cita->hora_inicio }}</td>
        <td>{{ $cita->cliente->nombre }} {{ $cita->cliente->apellidos }}</td>
        <td>{{ $cita->tratamiento->nombre_tratamiento }}</td>
        <td>
            <a class="btn" href="{{ route('doctor.notas', $cita->id_cita) }}">Notas</a>
            <a class="btn" href="{{ route('doctor.historial.ver', $cita->id_cliente) }}">Historial</a>
            <a class="btn" href="{{ route('doctor.cita.editar', $cita->id_cita) }}">Modificar</a>
            <form action="{{ route('doctor.cita.cancelar', $cita->id_cita) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Cancelar esta cita?')">
                @csrf
                <button type="submit" class="btn btn-danger">Cancelar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection
