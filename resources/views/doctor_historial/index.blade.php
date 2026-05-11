@extends('layouts.admin-crud')
@section('title', 'Assignacions doctor-historial')
@section('contenido')
<h1>Assignacions Doctor - Historial</h1>
<a class="btn" href="{{ route('doctor-historial.create') }}" style="margin-bottom:20px;">Nova assignació</a>
<table>
    <tr><th>Doctor</th><th>Historial</th><th>Client</th><th>Accions</th></tr>
    @foreach($asignaciones as $a)
    <tr>
        <td>{{ $a->doctor->nombre }} {{ $a->doctor->apellidos }}</td>
        <td>#{{ $a->id_historial }}</td>
        <td>{{ $a->historial->cliente->nombre ?? '—' }} {{ $a->historial->cliente->apellidos ?? '' }}</td>
        <td>
            <form action="{{ route('doctor-historial.destroy', $a->id_doctor_historial) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button class="btn-danger" type="submit">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
