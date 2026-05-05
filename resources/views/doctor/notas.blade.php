@extends('doctor.layout')

@section('contenido')

<h1>Añadir Notas Clínicas</h1>

<div class="box">
    <p><strong>Paciente:</strong> {{ $cita->cliente->nombre }} {{ $cita->cliente->apellidos }}</p>
</div>

<form action="{{ route('doctor.notas.guardar', $cita->id_cita) }}" method="POST">
    @csrf

    <textarea name="nota" rows="6" placeholder="Escriba aquí la nota clínica..." required></textarea>

    <button class="btn" type="submit">Guardar nota</button>
</form>

@endsection
