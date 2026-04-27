@extends('doctor.layout')

@section('contenido')

<h1>Citas de Seguimiento</h1>

<p>Seleccione un paciente para crear una cita de seguimiento.</p>

<table>
    <tr>
        <th>Paciente</th>
        <th>Acciones</th>
    </tr>

    @foreach($pacientes as $cliente)
    <tr>
        <td>{{ $cliente->nombre }} {{ $cliente->apellidos }}</td>
        <td>
            <a class="btn" href="{{ route('doctor.seguimiento.crear', $cliente->id_cliente) }}">Crear cita</a>
        </td>
    </tr>
    @endforeach
</table>

@endsection
