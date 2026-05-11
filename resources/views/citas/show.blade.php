@extends('layouts.admin-crud')
@section('title', 'Detall cita')
@section('contenido')
<h1>Cita #{{ $cita->id_cita }}</h1>
<p><strong>Client:</strong> {{ $cita->cliente->nombre }} {{ $cita->cliente->apellidos }}</p>
<p><strong>Doctor:</strong> {{ $cita->doctor->nombre }} {{ $cita->doctor->apellidos }}</p>
<p><strong>Tractament:</strong> {{ $cita->tratamiento->nombre_tratamiento }}</p>
<p><strong>Data:</strong> {{ $cita->fecha }}</p>
<p><strong>Hora:</strong> {{ $cita->hora_inicio }} - {{ $cita->hora_fin }}</p>
<p><strong>Estat:</strong> {{ $cita->estado }}</p>
<p><strong>Tipus:</strong> {{ $cita->tipo_reserva }}</p>
<a class="btn" href="{{ route('citas.index') }}">Tornar</a>
@endsection
