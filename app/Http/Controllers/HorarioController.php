<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Doctor;
use App\Services\AppointmentService;
use App\Services\AuditService;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function index(Request $request)
    {
        $doctores = Doctor::all();
        $selectedDoctor = $request->get('doctor');
        $selectedWeek = $request->get('week', now()->startOfWeek()->toDateString());

        $startOfWeek = \Carbon\Carbon::parse($selectedWeek)->startOfWeek();
        $endOfWeek = $startOfWeek->copy()->endOfWeek();

        $query = Horario::with('doctor')->whereBetween('fecha', [$startOfWeek, $endOfWeek]);

        if ($selectedDoctor) {
            $query->where('id_doctor', $selectedDoctor);
        }

        $horarios = $query->orderBy('fecha')->get();

        // Agrupar por doctor y fecha para el grid semanal
        $grid = [];
        foreach ($horarios as $h) {
            $docId = $h->id_doctor;
            $dia = \Carbon\Carbon::parse($h->fecha)->dayOfWeek; // 0=domingo, 6=sabado
            $grid[$docId][$dia][] = $h;
        }

        $weekDays = [];
        for ($i = 0; $i < 7; $i++) {
            $day = $startOfWeek->copy()->addDays($i);
            $weekDays[] = [
                'date' => $day->toDateString(),
                'name' => $day->locale('ca')->dayName,
                'day' => $day->day,
                'dow' => $day->dayOfWeek, // 1=Monday, 7=Sunday (ISO)
                'isToday' => $day->isToday(),
            ];
        }

        $prevWeek = $startOfWeek->copy()->subWeek()->toDateString();
        $nextWeek = $startOfWeek->copy()->addWeek()->toDateString();

        return view('horarios.index', compact(
            'horarios', 'doctores', 'selectedDoctor', 'selectedWeek',
            'startOfWeek', 'endOfWeek', 'grid', 'weekDays',
            'prevWeek', 'nextWeek'
        ));
    }

    public function create()
    {
        $doctores = Doctor::all();
        return view('horarios.create', compact('doctores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_doctor' => 'required|exists:doctor,id_doctor',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
            'disponible' => 'required|boolean',
            'motivo_bloqueo' => 'nullable|string|max:255',
            'tipus_bloqueig' => 'nullable|in:vacaciones,tancament,mantenimiento'
        ]);

        $horario = Horario::create($request->all());

        app(AuditService::class)->registrarAdmin(
            session('admin_id'),
            'created',
            'horario',
            $horario->id_horario,
            null,
            $request->all()
        );

        return redirect()->route('horarios.index')->with('success', 'Horario creado correctamente');
    }

    public function show($id)
    {
        $horario = Horario::with('doctor')->findOrFail($id);
        return view('horarios.show', compact('horario'));
    }

    public function edit($id)
    {
        $horario = Horario::findOrFail($id);
        $doctores = Doctor::all();
        return view('horarios.edit', compact('horario', 'doctores'));
    }

    public function update(Request $request, $id)
    {
        $horario = Horario::findOrFail($id);

        $request->validate([
            'id_doctor' => 'required|exists:doctor,id_doctor',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
            'disponible' => 'required|boolean',
            'motivo_bloqueo' => 'nullable|string|max:255',
            'tipus_bloqueig' => 'nullable|in:vacaciones,tancament,mantenimiento'
        ]);

        $oldValues = $horario->toArray();
        $horario->update($request->all());

        app(AuditService::class)->registrarAdmin(
            session('admin_id'),
            'updated',
            'horario',
            $horario->id_horario,
            $oldValues,
            $request->all()
        );

        if (!$request->disponible) {
            $reubicades = app(AppointmentService::class)->reubicarCitesAfectades($horario->id_doctor, $horario->fecha);
            foreach ($reubicades as $cita) {
                app(NotificationService::class)->enviarModificacio($cita);
            }
        }

        return redirect()->route('horarios.index')->with('success', 'Horario actualizado correctamente');
    }

    public function destroy($id)
    {
        $horario = Horario::findOrFail($id);

        app(AuditService::class)->registrarAdmin(
            session('admin_id'),
            'deleted',
            'horario',
            $horario->id_horario,
            $horario->toArray(),
            null
        );

        if (!$horario->disponible) {
            $reubicades = app(AppointmentService::class)->reubicarCitesAfectades($horario->id_doctor, $horario->fecha);
            foreach ($reubicades as $cita) {
                app(NotificationService::class)->enviarModificacio($cita);
            }
        }

        $horario->delete();

        return redirect()->route('horarios.index')->with('success', 'Horario eliminado');
    }
}
