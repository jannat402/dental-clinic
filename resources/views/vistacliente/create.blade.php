@extends('layouts.admin-crud')
@section('title', 'Nova cita')
@section('contenido')
<h1>Crear cita (admin)</h1>
<form action="{{ route('citas.store') }}" method="POST">
    @csrf
    <label>Client:</label>
    <select name="id_cliente" required>
        @foreach($clientes as $c)
        <option value="{{ $c->id_cliente }}">{{ $c->nombre }} {{ $c->apellidos }}</option>
        @endforeach
    </select>
    <label>Doctor:</label>
    <select name="id_doctor" required>
        @foreach($doctores as $d)
        <option value="{{ $d->id_doctor }}">{{ $d->nombre }} {{ $d->apellidos }}</option>
        @endforeach
    </select>
    <label>Tractament:</label>
    <select name="id_tratamiento" required>
        @foreach($tratamientos as $t)
        <option value="{{ $t->id_tratamiento }}">{{ $t->nombre_tratamiento }}</option>
        @endforeach
    </select>
    <label>Admin:</label>
    <select name="id_admin">
        <option value="">Cap</option>
        @foreach($admins as $a)
        <option value="{{ $a->id_admin }}">{{ $a->nombre }} {{ $a->apellidos }}</option>
        @endforeach
    </select>
    <label>Data:</label><input type="date" name="fecha" required>
    <label>Hora inici:</label><input type="time" name="hora_inicio" required>
    <label>Hora fi:</label><input type="time" name="hora_fin" required>
    <label>Estat:</label>
    <select name="estado">
        <option value="reservada">Reservada</option>
        <option value="pendiente_pago">Pendent de pagament</option>
        <option value="completada">Completada</option>
        <option value="cancelada">Cancel·lada</option>
    </select>
    <label>Tipus:</label>
    <select name="tipo_reserva">
        <option value="online">Online</option>
        <option value="presencial">Presencial</option>
    </select>
    <button type="submit">Crear cita</button>
</form>
@endsection
