<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Cliente;
use App\Models\Doctor;
use App\Models\Tratamiento;
use App\Models\Administrativo;
use Illuminate\Http\Request;
use App\Models\Horario;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::with(['cliente', 'doctor', 'tratamiento', 'administrativo'])->get();
        return view('citas.index', compact('citas'));
    }

    public function pedir(){
        $doctores = Doctor::all();
        $tratamientos = Tratamiento::all();
        return view("clinic.seleccionarcita", compact('doctores', 'tratamientos'));
    }
    public function confirmar(){
        return view("clinic.citaseleccionada");
    }

    public function create()
    {
        return view('citas.create', [
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
            'tipo_reserva' => 'required|in:online,presencial'
        ]);

        Cita::create($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita creada correctamente');
    }

    public function show($id)
    {
        $cita = Cita::with(['cliente', 'doctor', 'tratamiento', 'administrativo'])->findOrFail($id);
        return view('citas.show', compact('cita'));
    }

    public function edit($id)
    {
        $cita = Cita::findOrFail($id);

        return view('citas.edit', [
            'cita' => $cita,
            'clientes' => Cliente::all(),
            'doctores' => Doctor::all(),
            'tratamientos' => Tratamiento::all(),
            'admins' => Administrativo::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $cita = Cita::findOrFail($id);

        $request->validate([
            'id_cliente' => 'required|exists:cliente,id_cliente',
            'id_doctor' => 'required|exists:doctor,id_doctor',
            'id_tratamiento' => 'required|exists:tratamiento,id_tratamiento',
            'id_admin' => 'nullable|exists:administrativo,id_admin',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
            'estado' => 'required|in:reservada,cancelada,completada,pendiente_pago',
            'tipo_reserva' => 'required|in:online,presencial'
        ]);

        $cita->update($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita actualizada correctamente');
    }

    public function destroy($id)
    {
        Cita::destroy($id);
        return redirect()->route('citas.index')->with('success', 'Cita eliminada');
    }

    // para obtener los dias en los que los doctores estan diponibles
    public function obtenerDias($idDoctor)
    {
        $dias = Horario::where('id_doctor', $idDoctor)
                    ->select('fecha')
                    ->distinct()
                    ->orderBy('fecha')
                    ->get();

        return response()->json($dias);
    }

    // para obtener las horas en los que los doctores estan diponibles
    public function obtenerHoras($idDoctor, $fecha)
    {
        $horarios = Horario::where('id_doctor', $idDoctor)
                        ->where('fecha', $fecha)
                        ->get();

        $ocupadas = Cita::where('id_doctor', $idDoctor)
                        ->where('fecha', $fecha)
                        ->pluck('hora_inicio');

        return response()->json([
            'horarios' => $horarios,
            'ocupadas' => $ocupadas
        ]);
    }
}
