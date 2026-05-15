@extends('layouts.admin-crud')
@section('title', 'Gestión de Doctores')
@section('contenido')

<a href="{{ route('iniciadministrativo') }}" class="back-link">&larr; Volver al dashboard</a>

<div class="section-header">
    <h1>Gestión de Doctores</h1>
    <p>Administre los doctores del sistema: altas, bajas y modificación de datos.</p>
</div>

<div class="nav-grid">
    <a href="{{ route('doctores.index') }}" class="nav-card">
        <span class="nav-icon-lg"><x-admin-icons icon="doctor" :size="36" /></span>
        <span class="nav-label">Ver doctores</span>
    </a>
    <a href="{{ route('doctores.create') }}" class="nav-card">
        <span class="nav-icon-lg"><x-admin-icons icon="plus" :size="36" /></span>
        <span class="nav-label">Añadir doctor</span>
    </a>
    <a href="{{ route('horarios.index') }}" class="nav-card">
        <span class="nav-icon-lg"><x-admin-icons icon="schedule" :size="36" /></span>
        <span class="nav-label">Gestionar horarios</span>
    </a>
</div>

@endsection