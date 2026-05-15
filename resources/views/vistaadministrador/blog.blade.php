@extends('layouts.admin-crud')
@section('title', 'Blog')
@section('contenido')

<a href="{{ route('iniciadministrativo') }}" class="back-link">&larr; Volver al dashboard</a>

<div class="section-header">
    <h1>Blog</h1>
    <p>Gestione las entradas y noticias de la clínica.</p>
</div>

<div class="nav-grid">
    <a href="{{ route('blog.index') }}" class="nav-card">
        <span class="nav-icon-lg"><x-admin-icons icon="document" :size="36" /></span>
        <span class="nav-label">Ver entradas</span>
    </a>
    <a href="{{ route('blog.create') }}" class="nav-card">
        <span class="nav-icon-lg"><x-admin-icons icon="plus" :size="36" /></span>
        <span class="nav-label">Crear entrada</span>
    </a>
</div>

@endsection