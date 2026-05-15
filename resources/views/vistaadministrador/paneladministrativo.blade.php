@extends('layouts.admin-crud')
@section('title', 'Dashboard')
@section('contenido')

<div class="section-header">
    <p>Bienvenido, {{ session('admin_nombre') }}. Seleccione una sección para gestionar.</p>
</div>

<div class="nav-grid">
    <a href="{{ route('doctores.index') }}" class="nav-card">
        <span class="nav-icon-lg"><x-admin-icons icon="doctor" :size="36" /></span>
        <span class="nav-label">Doctores</span>
    </a>
    <a href="{{ route('clientes.index') }}" class="nav-card">
        <span class="nav-icon-lg"><x-admin-icons icon="client" :size="36" /></span>
        <span class="nav-label">Clientes</span>
    </a>
    <a href="{{ route('tratamientos.index') }}" class="nav-card">
        <span class="nav-icon-lg"><x-admin-icons icon="treatment" :size="36" /></span>
        <span class="nav-label">Tratamientos</span>
    </a>
    <a href="{{ route('administrativos.index') }}" class="nav-card">
        <span class="nav-icon-lg"><x-admin-icons icon="admin" :size="36" /></span>
        <span class="nav-label">Administradores</span>
    </a>
    <a href="{{ route('horarios.index') }}" class="nav-card">
        <span class="nav-icon-lg"><x-admin-icons icon="schedule" :size="36" /></span>
        <span class="nav-label">Horarios</span>
    </a>
    <a href="{{ route('citas.index') }}" class="nav-card">
        <span class="nav-icon-lg"><x-admin-icons icon="appointment" :size="36" /></span>
        <span class="nav-label">Citas</span>
    </a>
    <a href="{{ route('pagos.index') }}" class="nav-card">
        <span class="nav-icon-lg"><x-admin-icons icon="payment" :size="36" /></span>
        <span class="nav-label">Pagos</span>
    </a>
</div>

@endsection