@extends('layouts.admin-crud')
@section('title', 'Nueva asignación')
@section('contenido')
<h1>Asignar doctor a historial</h1>
<form action="{{ route('doctor-historial.store') }}" method="POST">
    @csrf
    <label>Doctor:</label>
    <select name="id_doctor" required>
        @foreach($doctores as $d)
        <option value="{{ $d->id_doctor }}">{{ $d->nombre }} {{ $d->apellidos }}</option>
        @endforeach
    </select>
    <label>Historial clínico:</label>
    <select name="id_historial" required>
        @foreach($historiales as $h)
        <option value="{{ $h->id_historial }}">#{{ $h->id_historial }} - {{ $h->cliente->nombre ?? 'N/A' }}</option>
        @endforeach
    </select>
    <button type="submit">Asignar</button>
</form>
@endsection
