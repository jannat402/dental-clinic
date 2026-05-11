@extends('layouts.admin-crud')
@section('title', 'Detalle administrador')
@section('contenido')
<h1>Administrador: {{ $admin->nombre }} {{ $admin->apellidos }}</h1>
<p><strong>Email:</strong> {{ $admin->email }}</p>
<p><strong>Autenticación:</strong> {{ $admin->autenticacion_segura }}</p>
<p><strong>Rol:</strong> {{ $admin->rol }}</p>
<a class="btn" href="{{ route('administrativos.edit', $admin->id_admin) }}">Editar</a>
<a class="btn" href="{{ route('administrativos.index') }}">Volver</a>
@endsection
