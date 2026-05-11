@extends('layouts.admin-crud')
@section('title', 'Nou horari')
@section('contenido')
<h1>Nou horari</h1>
<form action="{{ route('horarios.store') }}" method="POST">
    @csrf
    <label>Doctor:</label>
    <select name="id_doctor" required>
        @foreach($doctores as $d)
        <option value="{{ $d->id_doctor }}">{{ $d->nombre }} {{ $d->apellidos }}</option>
        @endforeach
    </select>

    <label>Data:</label><input type="date" name="fecha" required>

    <label>Hora inici:</label><input type="time" name="hora_inicio" required>

    <label>Hora fi:</label><input type="time" name="hora_fin" required>

    <label>Disponible:</label>
    <select name="disponible" id="disponible" onchange="toggleBloqueig()">
        <option value="1">Sí</option>
        <option value="0">No (bloquejat)</option>
    </select>

    <div id="bloqueig-fields" style="display:none;">
        <label>Tipus de bloqueig:</label>
        <select name="tipus_bloqueig">
            <option value="">Selecciona un motiu</option>
            <option value="vacaciones">Vacances</option>
            <option value="tancament">Tancament</option>
            <option value="mantenimiento">Manteniment</option>
        </select>

        <label>Motiu (descripció):</label>
        <input type="text" name="motivo_bloqueo" placeholder="Descripció del bloqueig">
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
