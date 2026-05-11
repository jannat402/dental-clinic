@extends('layouts.admin-crud')
@section('title', 'Pagaments')
@section('contenido')
<h1>Pagaments</h1>
<a class="btn" href="{{ route('pagos.create') }}" style="margin-bottom:20px;">Nou pagament</a>
<table>
    <tr><th>Cita</th><th>Client</th><th>Import</th><th>Mètode</th><th>Estat</th><th>Data</th><th>Accions</th></tr>
    @foreach($pagos as $p)
    <tr>
        <td>#{{ $p->id_cita }}</td>
        <td>{{ $p->cita->cliente->nombre ?? '—' }}</td>
        <td>{{ $p->monto }}€</td>
        <td>{{ $p->metodo_pago }}</td>
        <td>{{ $p->estado_pago }}</td>
        <td>{{ $p->fecha_pago }}</td>
        <td>
            <a class="btn" href="{{ route('pagos.show', $p->id_pago) }}">Veure</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection
