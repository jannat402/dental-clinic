@extends('layouts.admin-crud')
@section('title', 'Pagos')
@section('contenido')
<h1>Pagos</h1>
<a class="btn" href="{{ route('pagos.create') }}" style="margin-bottom:20px;">Nuevo pago</a>
<table>
    <tr><th>Cita</th><th>Cliente</th><th>Import</th><th>Método</th><th>Estado</th><th>Fecha</th><th>Acciones</th></tr>
    @foreach($pagos as $p)
    <tr>
        <td>#{{ $p->id_cita }}</td>
        <td>{{ $p->cita->cliente->nombre ?? '—' }}</td>
        <td>{{ $p->monto }}€</td>
        <td>{{ $p->metodo_pago }}</td>
        <td>{{ $p->estado_pago }}</td>
        <td>{{ $p->fecha_pago }}</td>
        <td>
            <a class="btn" href="{{ route('pagos.show', $p->id_pago) }}">Ver</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection
