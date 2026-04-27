<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Cliente;
use App\Models\Cita;
use App\Models\HistorialClinico;
use App\Models\Tratamiento;

class DoctorPanelController extends Controller
{
    // AGENDA DEL DOCTOR
    public function agenda()
    {
        if (!session()->has('doctor_id')) {
            return redirect()->route('paginainici');
        }

        $doctorId = session('doctor_id');

        $citas = Cita::where('id_doctor', $doctorId)
            ->orderBy('fecha')
            ->orderBy('hora')
            ->get();

        return view('doctor.agenda', compact('citas'));
    }

    // LISTADO DE CITAS
    public function citas()
    {
        if (!session()->has('doctor_id')) {
            return redirect()->route('paginainici');
        }

        $doctorId = session('doctor_id');

        $citas = Cita::where('id_doctor', $doctorId)
            ->orderBy('fecha')
            ->get();

        return view('doctor.citas', compact('citas'));
    }

    // LISTADO DE PACIENTES PARA HISTORIAL
    public function historial()
    {
        if (!session()->has('doctor_id')) {
            return redirect()->route('paginainici');
        }

        $doctorId = session('doctor_id');

        // Pacientes que han tenido citas con este doctor
        $pacientes = Cliente::whereHas('citas', function ($q) use ($doctorId) {
            $q->where('id_doctor', $doctorId);
        })->get();

        return view('doctor.historial', compact('pacientes'));
    }

    // VER HISTORIAL DE UN PACIENTE
    public function verHistorial($id_cliente)
    {
        if (!session()->has('doctor_id')) {
            return redirect()->route('paginainici');
        }

        $historial = HistorialClinico::where('id_cliente', $id_cliente)->get();
        $cliente = Cliente::find($id_cliente);

        return view('doctor.historial_ver', compact('historial', 'cliente'));
    }

    // AÑADIR NOTAS CLÍNICAS
    public function notas($id_cita)
    {
        if (!session()->has('doctor_id')) {
            return redirect()->route('paginainici');
        }

        $cita = Cita::findOrFail($id_cita);

        return view('doctor.notas', compact('cita'));
    }

    public function guardarNotas(Request $request, $id_cita)
    {
        if (!session()->has('doctor_id')) {
            return redirect()->route('paginainici');
        }

        $request->validate([
            'nota' => 'required|string'
        ]);

        HistorialClinico::create([
            'id_cliente' => Cita::find($id_cita)->id_cliente,
            'id_doctor' => session('doctor_id'),
            'descripcion' => $request->nota,
            'fecha' => now(),
        ]);

        return redirect()->route('doctor.citas')->with('success', 'Nota añadida correctamente');
    }

    // CITAS DE SEGUIMIENTO
    public function seguimiento()
    {
        if (!session()->has('doctor_id')) {
            return redirect()->route('paginainici');
        }

        $doctorId = session('doctor_id');

        $pacientes = Cliente::whereHas('citas', function ($q) use ($doctorId) {
            $q->where('id_doctor', $doctorId);
        })->get();

        return view('doctor.seguimiento', compact('pacientes'));
    }

    public function crearSeguimiento($id_cliente)
    {
        if (!session()->has('doctor_id')) {
            return redirect()->route('paginainici');
        }

        $cliente = Cliente::find($id_cliente);
        $tratamientos = Tratamiento::all();

        return view('doctor.seguimiento_crear', compact('cliente', 'tratamientos'));
    }

    public function guardarSeguimiento(Request $request, $id_cliente)
    {
        if (!session()->has('doctor_id')) {
            return redirect()->route('paginainici');
        }

        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'id_tratamiento' => 'required'
        ]);

        Cita::create([
            'id_cliente' => $id_cliente,
            'id_doctor' => session('doctor_id'),
            'id_tratamiento' => $request->id_tratamiento,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'estado' => 'pendiente',
        ]);

        return redirect()->route('doctor.seguimiento')->with('success', 'Cita de seguimiento creada');
    }
}
