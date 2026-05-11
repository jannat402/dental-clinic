@extends('layouts.admin-crud')
@section('title', 'Nuevo horario')
@section('contenido')
<h1>Nuevo horario</h1>
<form action="{{ route('horarios.store') }}" method="POST">
    @csrf
    <label>Doctor:</label>
    <select name="id_doctor" required>
        @foreach($doctores as $d)
        <option value="{{ $d->id_doctor }}">{{ $d->nombre }} {{ $d->apellidos }}</option>
        @endforeach
    </select>

    <label>Fecha:</label><input type="date" name="fecha" required>

    <label>Hora inicio:</label><input type="time" name="hora_inicio" required>

    <label>Hora fin:</label><input type="time" name="hora_fin" required>

    <label>Disponible:</label>
    <select name="disponible" id="disponible" onchange="toggleBloqueig()">
        <option value="1">Sí</option>
        <option value="0">No (bloqueado)</option>
    </select>

    <div id="bloqueig-fields" style="display:none;">
        <label>Tipo de bloqueo:</label>
        <select name="tipus_bloqueig">
            <option value="">Selecciona un motivo</option>
            <option value="vacaciones">Vacaciones</option>
            <option value="tancament">Cierre</option>
            <option value="mantenimiento">Mantenimiento</option>
        </select>

        <label>Motivo (descripción):</label>
        <input type="text" name="motivo_bloqueo" placeholder="Descripción del bloqueo">
    </div>

    <button type="submit">Crear</button>
</form>

<script>
function toggleBloqueig() {
    var val = document.getElementById('disponible').value;
    document.getElementById('bloqueig-fields').style.display = val === '0' ? 'block' : 'none';
}
</script>
@endsection
