<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Cliente;
use App\Models\Doctor;
use App\Models\Tratamiento;
use App\Models\Administrativo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::with(['cliente', 'doctor', 'tratamiento', 'administrativo'])->get();
        return view('citas.index', compact('citas'));
    }

    public function pedir(){
        $mesNumero = Carbon::now()->month; // 1–12  
        $mesNombre = '';

        switch ($mesNumero) {
            case 1:  $mesNombre = 'Enero'; break;
            case 2:  $mesNombre = 'Febrero'; break;
            case 3:  $mesNombre = 'Marzo'; break;
            case 4:  $mesNombre = 'Abril'; break;
            case 5:  $mesNombre = 'Mayo'; break;
            case 6:  $mesNombre = 'Junio'; break;
            case 7:  $mesNombre = 'Julio'; break;
            case 8:  $mesNombre = 'Agosto'; break;
            case 9:  $mesNombre = 'Septiembre'; break;
            case 10: $mesNombre = 'Octubre'; break;
            case 11: $mesNombre = 'Noviembre'; break;
            case 12: $mesNombre = 'Diciembre'; break;
        }
        return view("clinic.seleccionarcita",['mesNombre'=>$mesNombre]);
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

public function horariosDisponibles(Request $request)
{
    return response()->json([
        'ok' => true,
        'doctor' => $request->doctor_id,
        'fecha' => $request->fecha
    ]);
}



     
    }


}
