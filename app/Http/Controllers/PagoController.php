<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Cita;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function index()
    {
        $pagos = Pago::with('cita')->get();
        return view('pagos.index', compact('pagos'));
    }

    public function create()
    {
        $citas = Cita::all();
        return view('pagos.create', compact('citas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cita' => 'required|exists:cita,id_cita',
            'monto' => 'required|numeric|min:0.01',
            'metodo_pago' => 'required|in:tarjeta,efectivo,transferencia',
            'estado_pago' => 'required|in:pendiente,pagado,fallido'
        ]);

        Pago::create($request->all());

        return redirect()->route('pagos.index')->with('success', 'Pago registrado correctamente');
    }

    public function show($id)
    {
        $pago = Pago::with('cita')->findOrFail($id);
        return view('pagos.show', compact('pago'));
    }

    public function edit($id)
    {
        $pago = Pago::findOrFail($id);
        $citas = Cita::all();
        return view('pagos.edit', compact('pago', 'citas'));
    }

    public function update(Request $request, $id)
    {
        $pago = Pago::findOrFail($id);

        $request->validate([
            'id_cita' => 'required|exists:cita,id_cita',
            'monto' => 'required|numeric|min:0.01',
            'metodo_pago' => 'required|in:tarjeta,efectivo,transferencia',
            'estado_pago' => 'required|in:pendiente,pagado,fallido'
        ]);

        $pago->update($request->all());

        return redirect()->route('pagos.index')->with('success', 'Pago actualizado correctamente');
    }

    public function destroy($id)
    {
        Pago::destroy($id);
        return redirect()->route('pagos.index')->with('success', 'Pago eliminado');
    }
}
