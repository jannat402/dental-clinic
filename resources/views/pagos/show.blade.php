@extends('layouts.admin-crud')
@section('title', 'Detalle pago')
@section('contenido')
<h1>Pago #{{ $pago->id_pago }}</h1>
<p><strong>Cita:</strong> #{{ $pago->id_cita }}</p>
<p><strong>Cliente:</strong> {{ $pago->cita->cliente->nombre ?? '—' }} {{ $pago->cita->cliente->apellidos ?? '' }}</p>
<p><strong>Import:</strong> {{ $pago->monto }}€</p>
<p><strong>Método:</strong> {{ $pago->metodo_pago }}</p>
<p><strong>Estado:</strong> {{ $pago->estado_pago }}</p>
<p><strong>Fecha:</strong> {{ $pago->fecha_pago }}</p>
<a class="btn" href="{{ route('pagos.index') }}">Volver</a>
@endsection
