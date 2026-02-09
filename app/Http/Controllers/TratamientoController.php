<?php

namespace App\Http\Controllers;

use App\Models\Tratamiento;
use Illuminate\Http\Request;

class TratamientoController extends Controller
{
    public function index()
    {
        $tratamientos = Tratamiento::all();
        return view('tratamientos.index', compact('tratamientos'));
    }

    public function create()
    {
        return view('tratamientos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_tratamiento' => 'required',
            'duracion_minutos' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0.01',
            'descripcion' => 'nullable'
        ]);

        Tratamiento::create($request->all());

        return redirect()->route('tratamientos.index')->with('success', 'Tratamiento creado correctamente');
    }

    public function show($id)
    {
        $tratamiento = Tratamiento::findOrFail($id);
        return view('tratamientos.show', compact('tratamiento'));
    }

    public function edit($id)
    {
        $tratamiento = Tratamiento::findOrFail($id);
        return view('tratamientos.edit', compact('tratamiento'));
    }

    public function update(Request $request, $id)
    {
        $tratamiento = Tratamiento::findOrFail($id);

        $request->validate([
            'nombre_tratamiento' => 'required',
            'duracion_minutos' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0.01',
            'descripcion' => 'nullable'
        ]);

        $tratamiento->update($request->all());

        return redirect()->route('tratamientos.index')->with('success', 'Tratamiento actualizado correctamente');
    }

    public function destroy($id)
    {
        Tratamiento::destroy($id);
        return redirect()->route('tratamientos.index')->with('success', 'Tratamiento eliminado');
    }
}
