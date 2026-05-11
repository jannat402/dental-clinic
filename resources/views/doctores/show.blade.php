@extends('layouts.admin-crud')
@section('title', 'Detalle doctor')
@section('contenido')
<h1>Doctor: {{ $doctor->nombre }} {{ $doctor->apellidos }}</h1>
<p><strong>Email:</strong> {{ $doctor->email }}</p>
<p><strong>Especialidad:</strong> {{ $doctor->especialidad }}</p>
<p><strong>Estado:</strong> {{ $doctor->estado }}</p>
<p><strong>2FA:</strong> {{ $doctor->doble_factor ? 'Activado' : 'Desactivado' }}</p>
<a class="btn" href="{{ route('doctores.edit', $doctor->id_doctor) }}">Editar</a>
<a class="btn" href="{{ route('doctores.index') }}">Volver</a>
@endsection
