<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Citas - Dental Clinic</title>
    <link rel="stylesheet" href="{{asset('css/panelcitas.css')}}">
</head>
<body>
    <main>

        <h1>Mis citas programadas</h1>

        <a href="{{ route('iniciusuario') }}" class="btn-volver">← Volver al panel</a>

        <p>Aquí puede ver, modificar o eliminar sus citas.</p>

        <div id="tabla-container">
            <table>
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Tratamiento</th>
                        <th>Día y hora</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($citas as $cita)
                        <tr>
                            <td>{{ $cita->doctor->nombre ?? 'Sin asignar' }}</td>
                            <td>{{ $cita->tratamiento->nombre ?? 'Sin asignar' }}</td>
                            <td>{{ $cita->fecha }} {{ $cita->hora }}</td>
                            <td>
                                <a href="#" class="btn eliminar">Eliminar</a>
                                <a href="#" class="btn modificar">Modificar</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="sin-citas">No tienes citas registradas.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </main>
</body>
</html>
