<?php

namespace App\Http\Controllers;

use App\Models\DoctorHistorial;
use App\Models\Doctor;
use App\Models\HistorialClinico;
use Illuminate\Http\Request;

class DoctorHistorialController extends Controller
{
    public function index()
    {
        $asignaciones = DoctorHistorial::with(['doctor', 'historial.cliente'])->get();
        return view('doctor_historial.index', compact('asignaciones'));
    }

    public function create()
    {
        return view('doctor_historial.create', [
            'doctores' => Doctor::all(),
            'historiales' => HistorialClinico::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_doctor' => 'required|exists:doctor,id_doctor',
            'id_historial' => 'required|exists:historial_clinico,id_historial'
        ]);

        DoctorHistorial::create($request->all());

        return redirect()->route('doctor_historial.index')->with('success', 'Asignación creada correctamente');
    }

    public function destroy($id)
    {
        DoctorHistorial::destroy($id);
        return redirect()->route('doctor_historial.index')->with('success', 'Asignación eliminada');
    }
}
