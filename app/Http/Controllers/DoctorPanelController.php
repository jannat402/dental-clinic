<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Cliente;
use App\Models\Cita;
use App\Models\HistorialClinico;
use App\Models\Tratamiento;
use App\Services\AuditService;
use App\Services\AppointmentService;
use App\Services\NotificationService;
use Carbon\Carbon;

class DoctorPanelController extends Controller
{
    private function getDoctorId(): ?int
    {
        return session('doctor_id');
    }

    private function checkAuth(): bool
    {
        if (!$this->getDoctorId()) {
            return false;
        }
        return true;
    }

    // AGENDA DEL DOCTOR
    public function agenda()
    {
        if (!$this->checkAuth()) {
            return redirect()->route('paginainici');
        }

        $citas = Cita::where('id_doctor', $this->getDoctorId())
            ->orderBy('fecha')
            ->orderBy('hora_inicio')
            ->get();

        return view('doctor.agenda', compact('citas'));
    }

    // LISTADO DE CITAS
    public function citas()
    {
        if (!$this->checkAuth()) {
            return redirect()->route('paginainici');
        }

        $citas = Cita::where('id_doctor', $this->getDoctorId())
            ->orderBy('fecha')
            ->get();

        return view('doctor.citas', compact('citas'));
    }

    // LISTADO DE PACIENTES PARA HISTORIAL
    public function historial()
    {
        if (!$this->checkAuth()) {
            return redirect()->route('paginainici');
        }

        $pacientes = Cliente::whereHas('citas', function ($q) {
            $q->where('id_doctor', $this->getDoctorId());
        })->get();

        return view('doctor.historial', compact('pacientes'));
    }

    // VER HISTORIAL DE UN PACIENTE
    public function verHistorial($id_cliente)
    {
        if (!$this->checkAuth()) {
            return redirect()->route('paginainici');
        }

        $historial = HistorialClinico::where('id_cliente', $id_cliente)->get();
        $cliente = Cliente::find($id_cliente);

        app(AuditService::class)->registrarDoctor(
            $this->getDoctorId(),
            'viewed_historial',
            'cliente',
            $id_cliente
        );

        return view('doctor.historial_ver', compact('historial', 'cliente'));
    }

    // AÑADIR NOTAS CLÍNICAS
    public function notas($id_cita)
    {
        if (!$this->checkAuth()) {
            return redirect()->route('paginainici');
        }

        $cita = Cita::findOrFail($id_cita);

        return view('doctor.notas', compact('cita'));
    }

    public function guardarNotas(Request $request, $id_cita)
    {
        if (!$this->checkAuth()) {
            return redirect()->route('paginainici');
        }

        $request->validate([
            'nota' => 'required|string'
        ]);

        $cita = Cita::findOrFail($id_cita);

        $historial = HistorialClinico::create([
            'id_cliente' => $cita->id_cliente,
            'notas_diagnostico' => $request->nota,
            'fecha_ultima_actualizacion' => now(),
        ]);

        $historial->doctores()->attach($this->getDoctorId());

        app(AuditService::class)->registrarDoctor(
            $this->getDoctorId(),
            'added_notes',
            'historial_clinico',
            $historial->id_historial,
            null,
            ['id_cliente' => $cita->id_cliente, 'id_cita' => $id_cita]
        );

        return redirect()->route('doctor.citas')->with('success', 'Nota añadida correctamente');
    }

    // CITAS DE SEGUIMIENTO
    public function seguimiento()
    {
        if (!$this->checkAuth()) {
            return redirect()->route('paginainici');
        }

        $pacientes = Cliente::whereHas('citas', function ($q) {
            $q->where('id_doctor', $this->getDoctorId());
        })->get();

        return view('doctor.seguimiento', compact('pacientes'));
    }

    public function crearSeguimiento($id_cliente)
    {
        if (!$this->checkAuth()) {
            return redirect()->route('paginainici');
        }

        $cliente = Cliente::find($id_cliente);
        $tratamientos = Tratamiento::all();

        return view('doctor.seguimiento_crear', compact('cliente', 'tratamientos'));
    }

    public function guardarSeguimiento(Request $request, $id_cliente)
    {
        if (!$this->checkAuth()) {
            return redirect()->route('paginainici');
        }

        $request->validate([
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'id_tratamiento' => 'required|exists:tratamiento,id_tratamiento'
        ]);

        $tratamiento = Tratamiento::find($request->id_tratamiento);
        $horaFin = Carbon::parse($request->hora_inicio)->addMinutes($tratamiento->duracion_minutos)->format('H:i:s');

        $cita = Cita::create([
            'id_cliente' => $id_cliente,
            'id_doctor' => $this->getDoctorId(),
            'id_tratamiento' => $request->id_tratamiento,
            'fecha' => $request->fecha,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $horaFin,
            'estado' => 'pendiente_pago',
        ]);

        app(AuditService::class)->registrarDoctor(
            $this->getDoctorId(),
            'created_followup',
            'cita',
            $cita->id_cita,
            null,
            $request->all()
        );

        app(NotificationService::class)->enviarConfirmacio($cita);

        return redirect()->route('doctor.seguimiento')->with('success', 'Cita de seguimiento creada');
    }

    // FORMULARIO EDITAR CITA (doctor)
    public function editarCita($id_cita)
    {
        if (!$this->checkAuth()) {
            return redirect()->route('paginainici');
        }

        $cita = Cita::findOrFail($id_cita);

        if ($cita->id_doctor != $this->getDoctorId()) {
            abort(403, 'No pots modificar cites d\'un altre doctor.');
        }

        return view('doctor.cita-editar', compact('cita'));
    }

    // MODIFICAR CITA (doctor)
    public function modificarCita(Request $request, $id_cita)
    {
        if (!$this->checkAuth()) {
            return redirect()->route('paginainici');
        }

        $cita = Cita::findOrFail($id_cita);

        if ($cita->id_doctor != $this->getDoctorId()) {
            abort(403, 'No pots modificar cites d\'un altre doctor.');
        }

        $request->validate([
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
        ]);

        $oldValues = $cita->toArray();

        $tractament = Tratamiento::find($cita->id_tratamiento);
        $horaFi = Carbon::parse($request->hora_inicio)->addMinutes($tractament->duracion_minutos)->format('H:i:s');

        $cita->update([
            'fecha' => $request->fecha,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $horaFi,
        ]);

        app(AuditService::class)->registrarDoctor(
            $this->getDoctorId(),
            'modified_appointment',
            'cita',
            $cita->id_cita,
            $oldValues,
            $cita->toArray()
        );

        app(NotificationService::class)->enviarModificacio($cita);

        return redirect()->route('doctor.citas')->with('success', 'Cita modificada correctamente');
    }

    // CANCELAR CITA (doctor)
    public function cancelarCita($id_cita)
    {
        if (!$this->checkAuth()) {
            return redirect()->route('paginainici');
        }

        $cita = Cita::findOrFail($id_cita);

        if ($cita->id_doctor != $this->getDoctorId()) {
            abort(403, 'No pots cancel·lar cites d\'un altre doctor.');
        }

        $oldValues = $cita->toArray();
        $cita->update(['estado' => 'cancelada']);

        app(AuditService::class)->registrarDoctor(
            $this->getDoctorId(),
            'cancelled_appointment',
            'cita',
            $cita->id_cita,
            $oldValues,
            $cita->toArray()
        );

        app(NotificationService::class)->enviarCancelacio($cita);

        return redirect()->route('doctor.citas')->with('success', 'Cita cancel·lada correctamente');
    }
}
