@extends('doctor.layout')

@section('contenido')

<h1>Modificar Cita</h1>

<div class="box">
    <p><strong>Paciente:</strong> {{ $cita->cliente->nombre }} {{ $cita->cliente->apellidos }}</p>
    <p><strong>Tratamiento:</strong> {{ $cita->tratamiento->nombre_tratamiento }}</p>
    <p><strong>Fecha actual:</strong> {{ $cita->fecha }}</p>
    <p><strong>Hora actual:</strong> {{ $cita->hora_inicio }}</p>
    <p><strong>Estado:</strong> {{ $cita->estado }}</p>
</div>

<form action="{{ route('doctor.cita.modificar', $cita->id_cita) }}" method="POST">
    @csrf

    <label for="fecha">Nueva fecha:</label>
    <input type="date" name="fecha" id="fecha" value="{{ $cita->fecha }}" required>

    <label for="hora_inicio">Nueva hora de inicio:</label>
    <input type="time" name="hora_inicio" id="hora_inicio" value="{{ $cita->hora_inicio }}" required>

    <button class="btn" type="submit">Guardar cambios</button>
</form>

<a class="btn" href="{{ route('doctor.citas') }}" style="margin-top:20px;">Volver a mis citas</a>

@endsection
