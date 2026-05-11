@extends('layouts.admin-crud')
@section('title', 'Nuevo pago')
@section('contenido')
<h1>Nuevo pago</h1>
<form action="{{ route('pagos.store') }}" method="POST">
    @csrf
    <label>Cita:</label>
    <select name="id_cita" required>
        @foreach($citas as $c)
        <option value="{{ $c->id_cita }}">#{{ $c->id_cita }} - {{ $c->cliente->nombre ?? 'N/A' }}</option>
        @endforeach
    </select>
    <label>Import (€):</label><input type="number" name="monto" step="0.01" required>
    <label>Método:</label>
    <select name="metodo_pago">
        <option value="tarjeta">Tarjeta</option>
        <option value="efectivo">Efectivo</option>
        <option value="transferencia">Transferencia</option>
    </select>
    <label>Estado:</label>
    <select name="estado_pago">
        <option value="pendiente">Pendiente</option>
        <option value="pagado">Pagado</option>
    </select>
    <button type="submit">Crear</button>
</form>
@endsection
