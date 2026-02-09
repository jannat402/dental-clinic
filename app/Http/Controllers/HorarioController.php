<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Doctor;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function index()
    {
        $horarios = Horario::with('doctor')->get();
        return view('horarios.index', compact('horarios'));
    }

    public function create()
    {
        $doctores = Doctor::all();
        return view('horarios.create', compact('doctores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_doctor' => 'required|exists:doctor,id_doctor',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
            'disponible' => 'required|boolean'
        ]);

        Horario::create($request->all());

        return redirect()->route('horarios.index')->with('success', 'Horario creado correctamente');
    }

    public function show($id)
    {
        $horario = Horario::with('doctor')->findOrFail($id);
        return view('horarios.show', compact('horario'));
    }

    public function edit($id)
    {
        $horario = Horario::findOrFail($id);
        $doctores = Doctor::all();
        return view('horarios.edit', compact('horario', 'doctores'));
    }

    public function update(Request $request, $id)
    {
        $horario = Horario::findOrFail($id);

        $request->validate([
            'id_doctor' => 'required|exists:doctor,id_doctor',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
            'disponible' => 'required|boolean'
        ]);

        $horario->update($request->all());

        return redirect()->route('horarios.index')->with('success', 'Horario actualizado correctamente');
    }

    public function destroy($id)
    {
        Horario::destroy($id);
        return redirect()->route('horarios.index')->with('success', 'Horario eliminado');
    }
}
