<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les meves cites - Dental Clinic</title>
    <link rel="stylesheet" href="{{asset('css/panelcitas.css')}}">
</head>
<body>

    @if(session('success'))
        <div class="alerta-exito" style="position:fixed;top:20px;left:50%;transform:translateX(-50%);z-index:1000;background:#22c55e;color:white;padding:15px 30px;border-radius:12px;font-weight:bold;box-shadow:0 4px 12px rgba(0,0,0,0.2);">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alerta-error" style="position:fixed;top:20px;left:50%;transform:translateX(-50%);z-index:1000;background:#ef4444;color:white;padding:15px 30px;border-radius:12px;font-weight:bold;box-shadow:0 4px 12px rgba(0,0,0,0.2);">
            {{ session('error') }}
        </div>
    @endif

    <main>

        <h1 class="titulo">Les meves cites</h1>

        <a href="{{ route('iniciusuario') }}" class="btn-volver">← Tornar al panel</a>

        <div id="tabla-container" class="contenedor-glass">
            <table>
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Tractament</th>
                        <th>Dia i hora</th>
                        <th>Estat</th>
                        <th>Accions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($citas as $cita)
                        <tr>
                            <td>{{ $cita->doctor->nombre }} {{ $cita->doctor->apellidos }}</td>
                            <td>{{ $cita->tratamiento->nombre_tratamiento }}</td>
                            <td>{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }} {{ substr($cita->hora_inicio, 0, 5) }}</td>
                            <td>
                                @if($cita->estado == 'reservada')
                                    <span style="color:#22c55e;font-weight:bold;">Confirmada</span>
                                @elseif($cita->estado == 'pendiente_pago')
                                    <span style="color:#eab308;font-weight:bold;">Pendent pagament</span>
                                @elseif($cita->estado == 'completada')
                                    <span style="color:#3b82f6;font-weight:bold;">Completada</span>
                                @else
                                    <span style="color:#ef4444;font-weight:bold;">Cancel·lada</span>
                                @endif
                            </td>
                            <td class="acciones">
                                @if($cita->estado != 'cancelada' && $cita->estado != 'completada')
                                    <a href="{{ route('modificar', $cita->id_cita) }}" class="btn modificar">Modificar</a>
                                    <form action="{{ route('citas.destroy', $cita->id_cita) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn eliminar" onclick="return confirm('Segur que vols cancel·lar aquesta cita?')">
                                            Cancel·lar
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="sin-cites">No tens cites registrades.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </main>
</body>
</html>
