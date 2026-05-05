<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctores = Doctor::all();
        return view('doctores.index', compact('doctores'));
    }

    public function create()
    {
        return view('doctores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'especialidad' => 'nullable',
            'estado' => 'required|in:activo,vacaciones,baja'
        ]);

        Doctor::create($request->all());

        return redirect()->route('doctores.index')->with('success', 'Doctor creado correctamente');
    }

    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('doctores.show', compact('doctor'));
    }

    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('doctores.edit', compact('doctor'));
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);

        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'especialidad' => 'nullable',
            'estado' => 'required|in:activo,vacaciones,baja'
        ]);

        $doctor->update($request->all());

        return redirect()->route('doctores.index')->with('success', 'Doctor actualizado correctamente');
    }

    public function destroy($id)
    {
        Doctor::destroy($id);
        return redirect()->route('doctores.index')->with('success', 'Doctor eliminado');
    }

    public function listar()
    {
        $doctores = Doctor::where('estado', 'activo')->get();
        return response()->json($doctores);
    }
}
