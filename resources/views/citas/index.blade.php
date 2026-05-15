@extends('layouts.admin-crud')
@section('title', 'Citas')
@section('contenido')
<h1>Todas las citas</h1>
<a class="btn" href="{{ route('citas.create') }}" style="margin-bottom:20px;">Nueva cita</a>
<table>
    <tr>
        <th>Paciente</th><th>Doctor</th><th>Tratamiento</th><th>Fecha</th><th>Inicio</th><th>Fin</th><th>Estado</th><th>Acciones</th>
    </tr>
    @foreach($citas as $c)
    <tr>
        <td>{{ $c->cliente->nombre ?? '—' }} {{ $c->cliente->apellidos ?? '' }}</td>
        <td>{{ $c->doctor->nombre ?? '—' }}</td>
        <td>{{ $c->tratamiento->nombre_tratamiento ?? '—' }}</td>
        <td>{{ \Carbon\Carbon::parse($c->fecha)->format('d/m/Y') }}</td>
        <td>{{ substr($c->hora_inicio, 0, 5) }}</td>
        <td>{{ substr($c->hora_fin, 0, 5) }}</td>
        <td>
            @php
                $map = ['reservada' => 'Reservada', 'cancelada' => 'Cancelada', 'completada' => 'Completada', 'pendiente_pago' => 'Pendiente pago'];
                $colors = ['reservada' => '#126b9d', 'cancelada' => '#dc2626', 'completada' => '#16a34a', 'pendiente_pago' => '#f59e0b'];
            @endphp
            <span style="color:{{ $colors[$c->estado] ?? '#666' }};font-weight:600;">{{ $map[$c->estado] ?? $c->estado }}</span>
        </td>
        <td>
            <a class="btn" href="{{ route('citas.show', $c->id_cita) }}">Ver</a>
            @if(in_array($c->estado, ['reservada', 'pendiente_pago']))
            <form action="{{ route('citas.destroy', $c->id_cita) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Cancelar esta cita?');">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Cancelar</button>
            </form>
            @endif
        </td>
    </tr>
    @endforeach
</table>
@endsection