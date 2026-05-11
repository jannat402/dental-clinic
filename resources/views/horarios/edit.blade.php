@extends('layouts.admin-crud')
@section('title', 'Editar horari')
@section('contenido')
<h1>Editar horari</h1>
<form action="{{ route('horarios.update', $horario->id_horario) }}" method="POST">
    @csrf @method('PUT')

    <label>Doctor:</label>
    <select name="id_doctor" required>
        @foreach($doctores as $d)
        <option value="{{ $d->id_doctor }}" {{ $horario->id_doctor == $d->id_doctor ? 'selected' : '' }}>{{ $d->nombre }} {{ $d->apellidos }}</option>
        @endforeach
    </select>

    <label>Data:</label><input type="date" name="fecha" value="{{ $horario->fecha }}" required>

    <label>Hora inici:</label><input type="time" name="hora_inicio" value="{{ $horario->hora_inicio }}" required>

    <label>Hora fi:</label><input type="time" name="hora_fin" value="{{ $horario->hora_fin }}" required>

    <label>Disponible:</label>
    <select name="disponible" id="disponible" onchange="toggleBloqueig()">
        <option value="1" {{ $horario->disponible ? 'selected' : '' }}>Sí</option>
        <option value="0" {{ !$horario->disponible ? 'selected' : '' }}>No (bloquejat)</option>
    </select>

    <div id="bloqueig-fields" style="{{ $horario->disponible ? 'display:none;' : '' }}">
        <label>Tipus de bloqueig:</label>
        <select name="tipus_bloqueig">
            <option value="">Selecciona un motiu</option>
            <option value="vacaciones" {{ $horario->tipus_bloqueig == 'vacaciones' ? 'selected' : '' }}>Vacances</option>
            <option value="tancament" {{ $horario->tipus_bloqueig == 'tancament' ? 'selected' : '' }}>Tancament</option>
            <option value="mantenimiento" {{ $horario->tipus_bloqueig == 'mantenimiento' ? 'selected' : '' }}>Manteniment</option>
        </select>

        <label>Motiu (descripció):</label>
        <input type="text" name="motivo_bloqueo" value="{{ $horario->motivo_bloqueo }}" placeholder="Descripció del bloqueig">
    </div>

    <button type="submit">Actualitzar</button>
</form>

<script>
function toggleBloqueig() {
    var val = document.getElementById('disponible').value;
    document.getElementById('bloqueig-fields').style.display = val === '0' ? 'block' : 'none';
}
</script>
@endsection
