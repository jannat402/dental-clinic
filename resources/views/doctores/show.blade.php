@extends('layouts.admin-crud')
@section('title', 'Detall doctor')
@section('contenido')
<h1>Doctor: {{ $doctor->nombre }} {{ $doctor->apellidos }}</h1>
<p><strong>Email:</strong> {{ $doctor->email }}</p>
<p><strong>Especialitat:</strong> {{ $doctor->especialidad }}</p>
<p><strong>Estat:</strong> {{ $doctor->estado }}</p>
<p><strong>2FA:</strong> {{ $doctor->doble_factor ? 'Activat' : 'Desactivat' }}</p>
<a class="btn" href="{{ route('doctores.edit', $doctor->id_doctor) }}">Editar</a>
<a class="btn" href="{{ route('doctores.index') }}">Tornar</a>
@endsection
