@extends('layouts.admin-crud')
@section('title', 'Nou pagament')
@section('contenido')
<h1>Nou pagament</h1>
<form action="{{ route('pagos.store') }}" method="POST">
    @csrf
    <label>Cita:</label>
    <select name="id_cita" required>
        @foreach($citas as $c)
        <option value="{{ $c->id_cita }}">#{{ $c->id_cita }} - {{ $c->cliente->nombre ?? 'N/A' }}</option>
        @endforeach
    </select>
    <label>Import (€):</label><input type="number" name="monto" step="0.01" required>
    <label>Mètode:</label>
    <select name="metodo_pago">
        <option value="tarjeta">Targeta</option>
        <option value="efectivo">Efectiu</option>
        <option value="transferencia">Transferència</option>
    </select>
    <label>Estat:</label>
    <select name="estado_pago">
        <option value="pendiente">Pendent</option>
        <option value="pagado">Pagat</option>
    </select>
    <button type="submit">Crear</button>
</form>
@endsection
