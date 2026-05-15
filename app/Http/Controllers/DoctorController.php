<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'email' => 'required|email|unique:doctor,email',
            'especialidad' => 'nullable',
            'contrasenya' => 'required|min:4',
            'doble_factor' => 'required|in:0,1',
        ]);

        Doctor::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'especialidad' => $request->especialidad,
            'contrasenya' => Hash::make($request->contrasenya),
            'estado' => 'activo',
            'doble_factor' => $request->doble_factor,
            'user_id' => 1,
        ]);

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
            'email' => 'required|email|unique:doctor,email,' . $id . ',id_doctor',
            'especialidad' => 'nullable',
            'estado' => 'required|in:activo,vacaciones,baja',
            'doble_factor' => 'required|in:0,1',
        ]);

        $data = [
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'especialidad' => $request->especialidad,
            'estado' => $request->estado,
            'doble_factor' => $request->doble_factor,
        ];

        if ($request->filled('contrasenya')) {
            $data['contrasenya'] = Hash::make($request->contrasenya);
        }

        $doctor->update($data);

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