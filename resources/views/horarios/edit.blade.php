@extends('layouts.admin-crud')
@section('title', 'Editar horario')
@section('contenido')
<h1>Editar horario</h1>
<form action="{{ route('horarios.update', $horario->id_horario) }}" method="POST">
    @csrf @method('PUT')

    <label>Doctor:</label>
    <select name="id_doctor" required>
        @foreach($doctores as $d)
        <option value="{{ $d->id_doctor }}" {{ $horario->id_doctor == $d->id_doctor ? 'selected' : '' }}>{{ $d->nombre }} {{ $d->apellidos }}</option>
        @endforeach
    </select>

    <label>Fecha:</label><input type="date" name="fecha" value="{{ $horario->fecha }}" required>

    <label>Hora inicio:</label><input type="time" name="hora_inicio" value="{{ $horario->hora_inicio }}" required>

    <label>Hora fin:</label><input type="time" name="hora_fin" value="{{ $horario->hora_fin }}" required>

    <label>Disponible:</label>
    <select name="disponible" id="disponible" onchange="toggleBloqueig()">
        <option value="1" {{ $horario->disponible ? 'selected' : '' }}>Sí</option>
        <option value="0" {{ !$horario->disponible ? 'selected' : '' }}>No (bloqueado)</option>
    </select>

    <div id="bloqueig-fields" style="{{ $horario->disponible ? 'display:none;' : '' }}">
        <label>Tipo de bloqueo:</label>
        <select name="tipus_bloqueig">
            <option value="">Selecciona un motivo</option>
            <option value="vacaciones" {{ $horario->tipus_bloqueig == 'vacaciones' ? 'selected' : '' }}>Vacaciones</option>
            <option value="tancament" {{ $horario->tipus_bloqueig == 'tancament' ? 'selected' : '' }}>Cierre</option>
            <option value="mantenimiento" {{ $horario->tipus_bloqueig == 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
        </select>

        <label>Motivo (descripción):</label>
        <input type="text" name="motivo_bloqueo" value="{{ $horario->motivo_bloqueo }}" placeholder="Descripción del bloqueo">
    </div>

    <button type="submit">Actualizar</button>
</form>

<script>
function toggleBloqueig() {
    var val = document.getElementById('disponible').value;
    document.getElementById('bloqueig-fields').style.display = val === '0' ? 'block' : 'none';
}
</script>
@endsection
