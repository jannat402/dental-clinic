@extends('layouts.admin-crud')
@section('title', 'Detalle doctor')
@section('contenido')
<h1>Doctor: {{ $doctor->nombre }} {{ $doctor->apellidos }}</h1>
<div class="box">
    <div class="detail-group">
        <label>Email</label>
        <div class="detail-value">{{ $doctor->email }}</div>
    </div>
    <div class="detail-group">
        <label>Especialidad</label>
        <div class="detail-value">{{ $doctor->especialidad ?? '—' }}</div>
    </div>
    <div class="detail-group">
        <label>Estado</label>
        <div class="detail-value">{{ $doctor->estado }}</div>
    </div>
    <div class="detail-group">
        <label>2FA</label>
        <div class="detail-value">{{ $doctor->doble_factor ? 'Activado' : 'Desactivado' }}</div>
    </div>
</div>
<a class="btn" href="{{ route('doctores.edit', $doctor->id_doctor) }}">Editar</a>
<a class="btn" href="{{ route('doctores.index') }}">Volver</a>
@endsection