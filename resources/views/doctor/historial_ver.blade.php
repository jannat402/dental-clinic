@extends('doctor.layout')

@section('contenido')

<h1>Historial Clínico de {{ $cliente->nombre }} {{ $cliente->apellidos }}</h1>

@if($historial->isEmpty())
    <div class="box">
        <p>Este paciente no tiene historial clínico registrado.</p>
    </div>
@else
    <table>
        <tr>
            <th>Fecha</th>
            <th>Notas</th>
            <th>Documentos</th>
        </tr>
        @foreach($historial as $registro)
        <tr>
            <td>{{ $registro->fecha_ultima_actualizacion }}</td>
            <td>{{ $registro->notas_diagnostico }}</td>
            <td>{{ $registro->documentos_adjuntos ?? '—' }}</td>
        </tr>
        @endforeach
    </table>
@endif

<a class="btn" href="{{ route('doctor.historial') }}" style="margin-top:20px;">Volver</a>

@endsection
