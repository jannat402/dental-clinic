@extends('layouts.admin-crud')
@section('title', 'Detalle cliente')
@section('contenido')
<h1>Client: {{ $cliente->nombre }} {{ $cliente->apellidos }}</h1>
<p><strong>Email:</strong> {{ $cliente->email }}</p>
<p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
<p><strong>Estado:</strong> {{ $cliente->estat ?? 'actiu' }}</p>
<a class="btn" href="{{ route('clientes.edit', $cliente->id_cliente) }}">Editar</a>
<a class="btn" href="{{ route('clientes.index') }}">Volver</a>
@endsection
