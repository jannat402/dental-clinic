@extends('layouts.admin-crud')
@section('title', 'Nova assignació')
@section('contenido')
<h1>Assignar doctor a historial</h1>
<form action="{{ route('doctor-historial.store') }}" method="POST">
    @csrf
    <label>Doctor:</label>
    <select name="id_doctor" required>
        @foreach($doctores as $d)
        <option value="{{ $d->id_doctor }}">{{ $d->nombre }} {{ $d->apellidos }}</option>
        @endforeach
    </select>
    <label>Historial clínic:</label>
    <select name="id_historial" required>
        @foreach($historiales as $h)
        <option value="{{ $h->id_historial }}">#{{ $h->id_historial }} - {{ $h->cliente->nombre ?? 'N/A' }}</option>
        @endforeach
    </select>
    <button type="submit">Assignar</button>
</form>
@endsection
