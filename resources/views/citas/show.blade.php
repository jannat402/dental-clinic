@extends('layouts.admin-crud')
@section('title', 'Detalle cita')
@section('contenido')
<h1>Cita #{{ $cita->id_cita }}</h1>
<p><strong>Cliente:</strong> {{ $cita->cliente->nombre }} {{ $cita->cliente->apellidos }}</p>
<p><strong>Doctor:</strong> {{ $cita->doctor->nombre }} {{ $cita->doctor->apellidos }}</p>
<p><strong>Tratamiento:</strong> {{ $cita->tratamiento->nombre_tratamiento }}</p>
<p><strong>Fecha:</strong> {{ $cita->fecha }}</p>
<p><strong>Hora:</strong> {{ $cita->hora_inicio }} - {{ $cita->hora_fin }}</p>
<p><strong>Estado:</strong> {{ $cita->estado }}</p>
<p><strong>Tipo:</strong> {{ $cita->tipo_reserva }}</p>
<a class="btn" href="{{ route('citas.index') }}">Volver</a>
@endsection
