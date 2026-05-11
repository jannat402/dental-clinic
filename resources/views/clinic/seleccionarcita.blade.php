<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar cita - Dental Clinic</title>
    <link rel="stylesheet" href="{{asset('css/seleccionarcita.css')}}">
</head>
<body>
    <main>
        <h1>Reserva la teva cita</h1>
        <p>Selecciona el doctor, tractament, dia i hora. Si tens dubtes, truca al 931 23 45 67</p>

        @if(session('error'))
            <div style="background:rgba(239,68,68,0.2);padding:12px 20px;border-radius:10px;margin-bottom:20px;">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div style="background:rgba(239,68,68,0.2);padding:12px 20px;border-radius:10px;margin-bottom:20px;">
                @foreach($errors->all() as $e) {{ $e }}<br> @endforeach
            </div>
        @endif

        <form id="formReserva" method="POST" action="{{ route('citaseleccionada') }}">
            @csrf
            <fieldset>
                <h2>Selecciona</h2>

                <label for="doctor">Doctor</label>
                <select name="id_doctor" id="doctor" required>
                    <option value="">Trieu un doctor</option>
                    @foreach($doctores as $d)
                        <option value="{{ $d->id_doctor }}">{{ $d->nombre }} {{ $d->apellidos }} ({{ $d->especialidad }})</option>
                    @endforeach
                </select>

                <label for="tratamiento">Tractament</label>
                <select name="id_tratamiento" id="tratamiento" required>
                    <option value="">Trieu un tractament</option>
                    @foreach($tratamientos as $t)
                        <option value="{{ $t->id_tratamiento }}">{{ $t->nombre_tratamiento }} ({{ $t->duracion_minutos }}min - {{ $t->precio }}€)</option>
                    @endforeach
                </select>

                <p style="font-size:0.9rem;opacity:0.8;">Si no sabeu què necessiteu, seleccioneu "Primera Visita" i us assessorarem.</p>
            </fieldset>

            <fieldset>
                <h2>Calendari</h2>
                <div id="calendario-dias" class="calendario-grid">
                    <div class="dia-placeholder">Selecciona un doctor primer</div>
                </div>

                <section id="horas" style="display:none;">
                    <h2>Seleccioneu una hora</h2>
                    <div id="listadohoras" class="horas-grid"></div>
                </section>

                <input type="hidden" name="fecha" id="fecha">
                <input type="hidden" name="hora_inicio" id="hora">

                <div id="botonReservar" style="display:none;">
                    <input type="submit" value="Reservar cita">
                </div>
            </fieldset>
        </form>

        <div style="margin-top:20px;">
            <a href="{{ route('mostrar') }}" style="color:rgba(255,255,255,0.7);">Tornar al panel</a>
        </div>
    </main>

    <script src="{{ asset('js/seleccionarcita.js') }}"></script>
</body>
</html>
