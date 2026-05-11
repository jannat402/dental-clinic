<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Doctor;
use App\Models\Tratamiento;

class PanelUsuarioController extends Controller
{
    public function index()
    {
        if (!session()->has('cliente_id')) {
            return redirect()->route('paginainici');
        }
        return view("vistacliente.panelusuario");
    }

    public function mostrar()
    {
        $idCliente = session('cliente_id');

        $citas = Cita::where('id_cliente', $idCliente)
            ->with(['doctor', 'tratamiento'])
            ->orderBy('fecha', 'asc')
            ->orderBy('hora_inicio', 'asc')
            ->get();

        return view("vistacliente.panelcitas", compact('citas'));
    }

    public function edit($id_cita)
    {
        $cita = Cita::findOrFail($id_cita);

        if ($cita->id_cliente != session('cliente_id')) {
            abort(403, 'No tens permís per modificar aquesta cita.');
        }

        return view('vistacliente.editar', [
            'cita' => $cita,
            'doctores' => Doctor::all(),
            'tratamientos' => Tratamiento::all()
        ]);
    }
}
