@extends('layouts.admin-crud')
@section('title', 'Editar pagament')
@section('contenido')
<h1>Editar pagament</h1>
<form action="{{ route('pagos.update', $pago->id_pago) }}" method="POST">
    @csrf @method('PUT')
    <label>Cita:</label>
    <select name="id_cita" required>
        @foreach($citas as $c)
        <option value="{{ $c->id_cita }}" {{ $pago->id_cita == $c->id_cita ? 'selected' : '' }}>#{{ $c->id_cita }}</option>
        @endforeach
    </select>
    <label>Import (€):</label><input type="number" name="monto" step="0.01" value="{{ $pago->monto }}" required>
    <label>Mètode:</label>
    <select name="metodo_pago">
        <option value="tarjeta" {{ $pago->metodo_pago == 'tarjeta' ? 'selected' : '' }}>Targeta</option>
        <option value="efectivo" {{ $pago->metodo_pago == 'efectivo' ? 'selected' : '' }}>Efectiu</option>
        <option value="transferencia" {{ $pago->metodo_pago == 'transferencia' ? 'selected' : '' }}>Transferència</option>
    </select>
    <label>Estat:</label>
    <select name="estado_pago">
        <option value="pendiente" {{ $pago->estado_pago == 'pendiente' ? 'selected' : '' }}>Pendent</option>
        <option value="pagado" {{ $pago->estado_pago == 'pagado' ? 'selected' : '' }}>Pagat</option>
        <option value="fallido" {{ $pago->estado_pago == 'fallido' ? 'selected' : '' }}>Fallit</option>
    </select>
    <button type="submit">Actualitzar</button>
</form>
@endsection
