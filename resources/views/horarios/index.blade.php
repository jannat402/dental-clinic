@extends('layouts.admin-crud')
@section('title', 'Horarios')
@section('contenido')

<div class="cal-header">
    <h1>Gestión de Horarios</h1>
    <div class="cal-nav">
        <a class="btn" href="{{ route('horarios.create') }}">Nuevo horario</a>
    </div>
</div>

<div class="cal-controls">
    <form method="GET" action="{{ route('horarios.index') }}" style="display:flex;gap:15px;align-items:center;flex-wrap:wrap;">
        <select name="doctor" onchange="this.form.submit()">
            <option value="">Todos los doctores</option>
            @foreach($doctores as $d)
                <option value="{{ $d->id_doctor }}" {{ $selectedDoctor == $d->id_doctor ? 'selected' : '' }}>
                    {{ $d->nombre }} {{ $d->apellidos }}
                </option>
            @endforeach
        </select>

        <a class="btn" href="{{ route('horarios.index', ['week' => $prevWeek, 'doctor' => $selectedDoctor]) }}">← Semana anterior</a>
        <span style="font-weight:700;color:#1565c0;">
            {{ \Carbon\Carbon::parse($selectedWeek)->locale('es')->startOfWeek()->format('d M') }} -
            {{ \Carbon\Carbon::parse($selectedWeek)->locale('es')->endOfWeek()->format('d M Y') }}
        </span>
        <a class="btn" href="{{ route('horarios.index', ['week' => $nextWeek, 'doctor' => $selectedDoctor]) }}">Semana siguiente →</a>
    </form>
</div>

<div class="cal-legend">
    <div class="legend-item"><div class="legend-color available"></div> Disponible</div>
    <div class="legend-item"><div class="legend-color blocked"></div> Bloqueado</div>
    <div class="legend-item"><div class="legend-color blocked-vacaciones"></div> Vacaciones</div>
    <div class="legend-item"><div class="legend-color blocked-tancament"></div> Cierre</div>
    <div class="legend-item"><div class="legend-color blocked-mantenimiento"></div> Mantenimiento</div>
</div>

@if(count($doctores) > 0)
    @php
        $selectedDoctorObj = $selectedDoctor ? $doctores->firstWhere('id_doctor', $selectedDoctor) : null;
        $doctoresMostrar = $selectedDoctorObj ? collect([$selectedDoctorObj]) : $doctores;
    @endphp

    @foreach($doctoresMostrar as $doctor)
        <h3 style="color:#1565c0;margin:25px 0 10px;">{{ $doctor->nombre }} {{ $doctor->apellidos }}</h3>

        <div class="week-grid">
            <div class="week-header">Hora</div>
            @foreach($weekDays as $wd)
                <div class="week-header" style="{{ $wd['isToday'] ? 'background:#0d47a1;' : '' }}">
                    {{ $wd['name'] }}<br><small>{{ $wd['day'] }}</small>
                </div>
            @endforeach

            @php
                $horaInici = \Carbon\Carbon::parse('08:00');
                $horaFi = \Carbon\Carbon::parse('20:00');
            @endphp

            @while($horaInici < $horaFi)
                <div class="time-slot">{{ $horaInici->format('H:i') }}</div>
                @foreach($weekDays as $wd)
                    @php
                        $diaHorarios = $grid[$doctor->id_doctor][$wd['dow']] ?? [];
                        $slot = collect($diaHorarios)->first(function($h) use ($horaInici) {
                            return \Carbon\Carbon::parse($h->hora_inicio)->format('H:i') === $horaInici->format('H:i');
                        });
                    @endphp
                    <div class="day-cell @if($slot) has-slot @endif">
                        @if($slot)
                            @php
                                $blockClass = 'blocked';
                                $blockLabel = $slot->motivo_bloqueo ?: 'Bloqueado';
                                if (!$slot->disponible && $slot->tipus_bloqueig) {
                                    $map = ['vacaciones' => 'Vacaciones', 'tancament' => 'Cierre', 'mantenimiento' => 'Mantenimiento'];
                                    $blockClass = 'blocked-' . $slot->tipus_bloqueig;
                                    $blockLabel = $map[$slot->tipus_bloqueig] ?? $blockLabel;
                                }
                            @endphp
                            <div class="slot-block {{ $slot->disponible ? 'available' : $blockClass }}">
                                {{ $slot->hora_inicio ? substr($slot->hora_inicio, 0, 5) . '-' . substr($slot->hora_fin, 0, 5) : '' }}
                                <span class="slot-time">{{ $slot->disponible ? 'Disponible' : $blockLabel }}</span>
                                @if(!$slot->disponible && ($slot->motivo_bloqueo || $slot->tipus_bloqueig))
                                    <div class="slot-tooltip">{{ $slot->motivo_bloqueo ?: $blockLabel }}</div>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
                @php $horaInici->addHours(1); @endphp
            @endwhile
        </div>
    @endforeach
@else
    <div class="empty-state">
        <h3>No hay horarios</h3>
        <p>Crea un nuevo horario para comenzar.</p>
        <a class="btn" href="{{ route('horarios.create') }}">Crear horario</a>
    </div>
@endif

<hr style="margin:40px 0;">

<h2>Todos los horarios</h2>
<table class="schedule-table">
    <tr>
        <th>Doctor</th><th>Fecha</th><th>Inicio</th><th>Fin</th><th>Estado</th><th>Tipo</th><th>Motivo</th><th>Acciones</th>
    </tr>
    @forelse($horarios as $h)
    <tr>
        <td>{{ $h->doctor->nombre }} {{ $h->doctor->apellidos }}</td>
        <td>{{ \Carbon\Carbon::parse($h->fecha)->format('d/m/Y') }}</td>
        <td>{{ substr($h->hora_inicio, 0, 5) }}</td>
        <td>{{ substr($h->hora_fin, 0, 5) }}</td>
        <td>
            <span class="badge {{ $h->disponible ? 'badge-available' : 'badge-blocked' }}">
                {{ $h->disponible ? 'Disponible' : 'Bloqueado' }}
            </span>
        </td>
        <td class="tipus-col">
            @if(!$h->disponible && $h->tipus_bloqueig)
                @php $map = ['vacaciones' => 'Vacaciones', 'tancament' => 'Cierre', 'mantenimiento' => 'Mantenimiento']; @endphp
                <span class="badge badge-{{ $h->tipus_bloqueig }}">{{ $map[$h->tipus_bloqueig] ?? $h->tipus_bloqueig }}</span>
            @else
                —
            @endif
        </td>
        <td>{{ $h->motivo_bloqueo ?? '—' }}</td>
        <td>
            <a class="btn" href="{{ route('horarios.show', $h->id_horario) }}">Ver</a>
            <a class="btn" href="{{ route('horarios.edit', $h->id_horario) }}">Editar</a>
        </td>
    </tr>
    @empty
    <tr><td colspan="8" style="text-align:center;padding:30px;">No hay horarios</td></tr>
    @endforelse
</table>

<link rel="stylesheet" href="{{ asset('css/horario.css') }}">
@endsection
