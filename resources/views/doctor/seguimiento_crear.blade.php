@extends('doctor.layout')

@section('contenido')

<h1>Crear Cita de Seguimiento</h1>

<div class="box">
    <p><strong>Paciente:</strong> {{ $cliente->nombre }} {{ $cliente->apellidos }}</p>
</div>

<form action="{{ route('doctor.seguimiento.guardar', $cliente->id_cliente) }}" method="POST">
    @csrf

    <label for="id_tratamiento">Tratamiento:</label>
    <select name="id_tratamiento" id="id_tratamiento" required>
        <option value="">Seleccione un tratamiento</option>
        @foreach($tratamientos as $t)
            <option value="{{ $t->id_tratamiento }}">{{ $t->nombre_tratamiento }} ({{ $t->duracion_minutos }} min - {{ $t->precio }}€)</option>
        @endforeach
    </select>

    <label for="fecha">Fecha:</label>
    <input type="date" name="fecha" id="fecha" required>

    <label for="hora_inicio">Hora de inicio:</label>
    <input type="time" name="hora_inicio" id="hora_inicio" required>

    <button class="btn" type="submit">Crear cita de seguimiento</button>
</form>

<a class="btn" href="{{ route('doctor.seguimiento') }}" style="margin-top:20px;">Volver</a>

@endsection
