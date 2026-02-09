<?php

namespace App\Http\Controllers;

use App\Models\HistorialClinico;
use App\Models\Cliente;
use Illuminate\Http\Request;

class HistorialClinicoController extends Controller
{
    public function index()
    {
        $historiales = HistorialClinico::with('cliente')->get();
        return view('historial.index', compact('historiales'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        return view('historial.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required|exists:cliente,id_cliente',
            'notas_diagnostico' => 'nullable',
            'documentos_adjuntos' => 'nullable'
        ]);

        HistorialClinico::create($request->all());

        return redirect()->route('historial.index')->with('success', 'Historial creado correctamente');
    }

    public function show($id)
    {
        $historial = HistorialClinico::with('cliente')->findOrFail($id);
        return view('historial.show', compact('historial'));
    }

    public function edit($id)
    {
        $historial = HistorialClinico::findOrFail($id);
        $clientes = Cliente::all();
        return view('historial.edit', compact('historial', 'clientes'));
    }

    public function update(Request $request, $id)
    {
        $historial = HistorialClinico::findOrFail($id);

        $request->validate([
            'id_cliente' => 'required|exists:cliente,id_cliente',
            'notas_diagnostico' => 'nullable',
            'documentos_adjuntos' => 'nullable'
        ]);

        $historial->update($request->all());

        return redirect()->route('historial.index')->with('success', 'Historial actualizado correctamente');
    }

    public function destroy($id)
    {
        HistorialClinico::destroy($id);
        return redirect()->route('historial.index')->with('success', 'Historial eliminado');
    }
}
