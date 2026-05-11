@extends('layouts.admin-crud')
@section('title', 'Detall pagament')
@section('contenido')
<h1>Pagament #{{ $pago->id_pago }}</h1>
<p><strong>Cita:</strong> #{{ $pago->id_cita }}</p>
<p><strong>Client:</strong> {{ $pago->cita->cliente->nombre ?? '—' }} {{ $pago->cita->cliente->apellidos ?? '' }}</p>
<p><strong>Import:</strong> {{ $pago->monto }}€</p>
<p><strong>Mètode:</strong> {{ $pago->metodo_pago }}</p>
<p><strong>Estat:</strong> {{ $pago->estado_pago }}</p>
<p><strong>Data:</strong> {{ $pago->fecha_pago }}</p>
<a class="btn" href="{{ route('pagos.index') }}">Tornar</a>
@endsection
