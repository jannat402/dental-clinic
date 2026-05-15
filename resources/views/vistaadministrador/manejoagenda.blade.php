@extends('layouts.admin-crud')
@section('title', 'Gestión de Agenda')
@section('contenido')

<a href="{{ route('iniciadministrativo') }}" class="back-link">&larr; Volver al dashboard</a>

<div class="section-header">
    <h1>Gestión de Agenda</h1>
    <p>Consulte y administre todas las citas del sistema.</p>
</div>

<div class="nav-grid">
    <a href="{{ route('citas.index') }}" class="nav-card">
        <span class="nav-icon-lg"><x-admin-icons icon="calendar" :size="36" /></span>
        <span class="nav-label">Consultar agenda</span>
    </a>
    <a href="{{ route('citas.create') }}" class="nav-card">
        <span class="nav-icon-lg"><x-admin-icons icon="plus" :size="36" /></span>
        <span class="nav-label">Dar cita</span>
    </a>
</div>

@endsection