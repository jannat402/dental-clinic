<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar cita</title>
    <link rel="stylesheet" href="{{asset('css/seleccionarcita.css')}}">
</head>
<body>
    <main>

        <h1>Reservar cita</h1>

        <a href="{{ route('iniciusuario') }}" class="btn-volver">← Volver al panel</a>

        <p>Seleccione doctor, tratamiento, día y hora disponible.</p>

        <form action="{{ route('citaseleccionada') }}" method="POST">
            @csrf
            <div class="contenedor-flex">
                <!-- SELECTORES -->
                <fieldset class="selector">
                    <label for="doctor">Doctor disponible</label>
                    <select name="id_doctor" id="doctor">
                        @foreach($doctores as $doctor)
                            <option value="{{ $doctor->id_doctor }}">
                                {{ $doctor->nombre }} {{ $doctor->apellidos }}
                            </option>
                        @endforeach
                    </select>

                    <label for="tratamiento">Tratamiento</label>
                    <select name="id_tratamiento" id="tratamiento">
                        @foreach($tratamientos as $tratamiento)
                            <option value="{{ $tratamiento->id_tratamiento }}">
                                {{ $tratamiento->nombre }}
                            </option>
                        @endforeach
                    </select>

                    <p class="info">
                        Si no sabe qué necesita, puede solicitar consulta inicial y se le asesorará en clínica.
                    </p>
                </fieldset>

                <!-- CALENDARIO -->
                <fieldset class="calendario">
                    <h2>Seleccione un día</h2>

                    <div id="calendario-dias" class="grid-dias">
                        <!-- Se llena dinámicamente -->
                    </div>

                    <h2>Horas disponibles</h2>
                    <div id="horas" class="grid-horas">
                        <!-- Se llena dinámicamente -->
                    </div>

                    <input type="hidden" name="fecha" id="fecha">
                    <input type="hidden" name="hora_inicio" id="hora">
                </fieldset>
            </div>
            <input type="submit" value="Confirmar cita" class="btn-confirmar">
        </form>

    </main>

    <script src="{{asset('js/seleccionarcita.js')}}"></script>
</body>
</html>
