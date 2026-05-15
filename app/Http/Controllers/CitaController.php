<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Cliente;
use App\Models\Doctor;
use App\Models\Tratamiento;
use App\Models\Administrativo;
use App\Models\Horario;
use App\Services\AppointmentService;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::with(['cliente', 'doctor', 'tratamiento', 'administrativo'])->get();
        return view('vistacliente.panelcitas', compact('citas'));
    }

    public function pedir()
    {
        $doctores = Doctor::where('estado', 'activo')->get();
        $tratamientos = Tratamiento::all();
        return view('clinic.seleccionarcita', compact('doctores', 'tratamientos'));
    }

    public function confirmar(Request $request)
    {
        $request->validate([
            'id_doctor' => 'required|exists:doctor,id_doctor',
            'id_tratamiento' => 'required|exists:tratamiento,id_tratamiento',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
        ]);

        $appointmentService = app(AppointmentService::class);

        if (!$appointmentService->validarAntelacio($request->fecha)) {
            return back()->withErrors(['fecha' => 'Les cites s\'han de reservar amb almenys 24 hores d\'antelació.']);
        }

        $tractament = Tratamiento::findOrFail($request->id_tratamiento);
        $horaFi = Carbon::parse($request->hora_inicio)->addMinutes($tractament->duracion_minutos)->format('H:i:s');

        $ocupada = Cita::where('id_doctor', $request->id_doctor)
            ->where('fecha', $request->fecha)
            ->where('hora_inicio', $request->hora_inicio)
            ->whereIn('estado', ['reservada', 'pendiente_pago'])
            ->exists();

        if ($ocupada) {
            $alternatives = $appointmentService->obtenirAlternatives(
                $request->id_doctor,
                $request->fecha,
                $request->hora_inicio,
                $tractament->duracion_minutos
            );
            return back()->with([
                'error' => 'Aquesta franja ja està ocupada.',
                'alternatives' => $alternatives
            ]);
        }

        try {
            $clauBloqueig = $appointmentService->bloquejarTemporalment(
                $request->id_doctor,
                $request->fecha,
                $request->hora_inicio,
                $horaFi
            );
        } catch (\RuntimeException $e) {
            return back()->withErrors(['hora_inicio' => $e->getMessage()]);
        }

        return view('clinic.citaseleccionada', [
            'clau' => $clauBloqueig,
            'id_doctor' => $request->id_doctor,
            'id_tratamiento' => $request->id_tratamiento,
            'fecha' => $request->fecha,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $horaFi,
        ]);
    }

    public function create()
    {
        return view('vistacliente.create', [
            'clientes' => Cliente::all(),
            'doctores' => Doctor::all(),
            'tratamientos' => Tratamiento::all(),
            'admins' => Administrativo::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required|exists:cliente,id_cliente',
            'id_doctor' => 'required|exists:doctor,id_doctor',
            'id_tratamiento' => 'required|exists:tratamiento,id_tratamiento',
            'id_admin' => 'nullable|exists:administrativo,id_admin',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
            'estado' => 'required|in:reservada,cancelada,completada,pendiente_pago',
            'tipo_reserva' => 'required|in:online,presencial',
            'clau' => 'nullable|string'
        ]);

        if (!app(AppointmentService::class)->validarAntelacio($request->fecha)) {
            return back()->withErrors(['fecha' => 'Las citas se deben reservar con al menos 24 horas de antelación.']);
        }

        $cita = Cita::create($request->except('clau'));

        if (!empty($request->clau)) {
            app(AppointmentService::class)->alliberarBloqueig($request->clau);
        }

        session(['pending_cita_id' => $cita->id_cita]);

        return redirect()->route('payment.page', ['id_cita' => $cita->id_cita]);
    }

    public function show($id)
    {
        $cita = Cita::with(['cliente', 'doctor', 'tratamiento', 'administrativo'])->findOrFail($id);
        return view('citas.show', compact('cita'));
    }

    public function edit($id_cita)
    {
        $cita = Cita::findOrFail($id_cita);

        if ($cita->id_cliente != session('cliente_id')) {
            abort(403, 'No tienes permiso para modificar esta cita.');
        }

        if (!app(AppointmentService::class)->validarModificacio($cita->fecha)) {
            return back()->withErrors(['error' => 'Solo se pueden modificar citas con 48 horas de antelación.']);
        }

        return view('vistacliente.editar', [
            'cita' => $cita,
            'clientes' => Cliente::all(),
            'doctores' => Doctor::all(),
            'tratamientos' => Tratamiento::all(),
        ]);
    }

    public function update(Request $request, $id_cita)
    {
        $cita = Cita::findOrFail($id_cita);

        $request->validate([
            'id_doctor' => 'required|exists:doctor,id_doctor',
            'id_tratamiento' => 'required|exists:tratamiento,id_tratamiento',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
        ]);

        if (!app(AppointmentService::class)->validarModificacio($request->fecha)) {
            return back()->withErrors(['error' => 'Solo se pueden modificar citas con 48 horas de antelación.']);
        }

        $tractament = Tratamiento::findOrFail($request->id_tratamiento);
        $horaFi = Carbon::parse($request->hora_inicio)->addMinutes($tractament->duracion_minutos)->format('H:i:s');

        $cita->update([
            'id_doctor' => $request->id_doctor,
            'id_tratamiento' => $request->id_tratamiento,
            'fecha' => $request->fecha,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $horaFi,
        ]);

        app(NotificationService::class)->enviarModificacio($cita);

        return redirect()->route('mostrar')->with('success', 'Cita actualizada correctamente');
    }

    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);

        $esCliente = session('cliente_id') && $cita->id_cliente == session('cliente_id');
        $esAdmin = session('rol') === 'admin';
        $esDoctor = session('rol') === 'doctor' && $cita->id_doctor == session('doctor_id');

        if (!$esCliente && !$esAdmin && !$esDoctor) {
            abort(403, 'No tienes permiso para cancelar esta cita.');
        }

        if (!$esAdmin && !$esDoctor && !app(AppointmentService::class)->validarModificacio($cita->fecha)) {
            return back()->withErrors(['error' => 'Solo se pueden cancelar citas con 48 horas de antelación.']);
        }

        $cita->update(['estado' => 'cancelada']);

        app(NotificationService::class)->enviarCancelacio($cita);

        $ruta = $esAdmin ? route('citas.index') : route('mostrar');
        return redirect($ruta)->with('success', 'Cita cancelada correctamente.');
    }

    // AJAX: retorna els dies disponibles per a un doctor
    public function obtenerDias($idDoctor)
    {
        $horarios = Horario::where('id_doctor', $idDoctor)
            ->where('disponible', true)
            ->where('fecha', '>=', now()->toDateString())
            ->orderBy('fecha')
            ->get()
            ->map(function ($h) {
                return ['fecha' => $h->fecha];
            });

        return response()->json($horarios);
    }

    // AJAX: retorna els tractaments disponibles per a un doctor
    public function obtenerTratamientos($idDoctor)
    {
        $doctor = Doctor::with('tratamientos')->findOrFail($idDoctor);
        return response()->json($doctor->tratamientos);
    }

    // AJAX: retorna les hores disponibles per a un doctor en una data
    public function obtenerHoras($idDoctor, $fecha)
    {
        $horario = Horario::where('id_doctor', $idDoctor)
            ->where('fecha', $fecha)
            ->where('disponible', true)
            ->first();

        if (!$horario) {
            return response()->json(['horarios' => [], 'ocupadas' => []]);
        }

        $citesOcupades = Cita::where('id_doctor', $idDoctor)
            ->where('fecha', $fecha)
            ->whereIn('estado', ['reservada', 'pendiente_pago'])
            ->get(['hora_inicio', 'hora_fin']);

        $inici = \Carbon\Carbon::parse($horario->hora_inicio);
        $fi = \Carbon\Carbon::parse($horario->hora_fin);
        $horarios = [];

        while ($inici < $fi) {
            $horaStr = $inici->format('H:i:s');
            $ocupada = $citesOcupades->contains(function ($c) use ($horaStr) {
                return $c->hora_inicio <= $horaStr && $c->hora_fin > $horaStr
                    || $c->hora_inicio === $horaStr;
            });

            $horarios[] = [
                'hora_inicio' => $horaStr,
                'disponible' => $ocupada ? 0 : 1,
            ];

            $inici->addMinutes(30);
        }

        return response()->json([
            'horarios' => $horarios,
            'ocupadas' => $citesOcupades->pluck('hora_inicio'),
        ]);
    }
}
