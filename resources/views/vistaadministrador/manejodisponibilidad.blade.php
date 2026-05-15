@extends('layouts.admin-crud')
@section('title', 'Gestión de Disponibilidad')
@section('contenido')

<a href="{{ route('iniciadministrativo') }}" class="back-link">&larr; Volver al dashboard</a>

<div class="section-header">
    <h1>Gestión de Disponibilidad</h1>
    <p>Administre los horarios de los doctores, franjas laborales y días no laborables.</p>
</div>

<div class="nav-grid">
    <a href="{{ route('horarios.index') }}" class="nav-card">
        <span class="nav-icon-lg"><x-admin-icons icon="schedule" :size="36" /></span>
        <span class="nav-label">Ver horarios</span>
    </a>
    <a href="{{ route('horarios.create') }}" class="nav-card">
        <span class="nav-icon-lg"><x-admin-icons icon="plus" :size="36" /></span>
        <span class="nav-label">Añadir horario</span>
    </a>
    <a href="{{ route('tratamientos.index') }}" class="nav-card">
        <span class="nav-icon-lg"><x-admin-icons icon="treatment" :size="36" /></span>
        <span class="nav-label">Tratamientos</span>
    </a>
</div>

@endsection