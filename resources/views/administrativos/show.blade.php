@extends('layouts.admin-crud')
@section('title', 'Detall administrador')
@section('contenido')
<h1>Administrador: {{ $admin->nombre }} {{ $admin->apellidos }}</h1>
<p><strong>Email:</strong> {{ $admin->email }}</p>
<p><strong>Autenticació:</strong> {{ $admin->autenticacion_segura }}</p>
<p><strong>Rol:</strong> {{ $admin->rol }}</p>
<a class="btn" href="{{ route('administrativos.edit', $admin->id_admin) }}">Editar</a>
<a class="btn" href="{{ route('administrativos.index') }}">Tornar</a>
@endsection
