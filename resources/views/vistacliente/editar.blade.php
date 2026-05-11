<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Cita - Dental Clinic</title>
    <link rel="stylesheet" href="{{ asset('css/editarcitaUsuario.css') }}">
</head>
<body>

<main>

    <h1>Modificar Cita</h1>

    <a href="{{ route('mostrar') }}" class="btn-volver">← Volver</a>

    <div class="card">

        <form action="{{ route('citas.update', $cita->id_cita) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="campo">
                <label>Doctor</label>
                <select name="id_doctor" required>
                    @foreach($doctores as $doctor)
                        <option value="{{ $doctor->id_doctor }}" 
                            {{ $doctor->id_doctor == $cita->id_doctor ? 'selected' : '' }}>
                            {{ $doctor->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="campo">
                <label>Tratamiento</label>
                <select name="id_tratamiento" required>
                    @foreach($tratamientos as $tratamiento)
                        <option value="{{ $tratamiento->id_tratamiento }}" 
                            {{ $tratamiento->id_tratamiento == $cita->id_tratamiento ? 'selected' : '' }}>
                            {{ $tratamiento->nombre_tratamiento }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="campo">
                <label>Fecha</label>
                <input type="date" name="fecha" value="{{ $cita->fecha }}" required>
            </div>

            <div class="campo">
                <label>Hora inicio</label>
                <input type="time" name="hora_inicio" value="{{ $cita->hora_inicio }}" required>
            </div>

            <div class="campo">
                <label>Hora fin</label>
                <input type="time" name="hora_fin" value="{{ $cita->hora_fin }}" required>
            </div>

            <button class="btn-guardar">Guardar cambios</button>

        </form>

    </div>

</main>

</body>
</html>
