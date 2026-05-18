<?php

namespace App\Http\Controllers;

use App\Models\Administrativo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdministrativoController extends Controller
{
    public function index()
    {
        $admins = Administrativo::all();
        return view('administrativos.index', compact('admins'));
    }

    public function create()
    {
        return view('administrativos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'email' => 'required|email|unique:administrativo,email',
            'contrasenya' => 'required|min:4',
            'autenticacion_segura' => 'required|in:2FA,certificado',
            'rol' => 'required'
        ]);

        $data = $request->all();
        $data['contrasenya'] = Hash::make($data['contrasenya']);
        Administrativo::create($data);

        return redirect()->route('administrativos.index')->with('success', 'Administrativo creado correctamente');
    }

    public function show($id)
    {
        $admin = Administrativo::findOrFail($id);
        return view('administrativos.show', compact('admin'));
    }

    public function edit($id)
    {
        $admin = Administrativo::findOrFail($id);
        return view('administrativos.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Administrativo::findOrFail($id);

        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'email' => 'required|email|unique:administrativo,email,' . $id . ',id_admin',
            'autenticacion_segura' => 'required|in:2FA,certificado',
            'rol' => 'required'
        ]);

        $data = $request->except('contrasenya');
        if ($request->filled('contrasenya')) {
            $data['contrasenya'] = Hash::make($request->contrasenya);
        }
        $admin->update($data);

        return redirect()->route('administrativos.index')->with('success', 'Administrativo actualizado correctamente');
    }

    public function destroy($id)
    {
        Administrativo::destroy($id);
        return redirect()->route('administrativos.index')->with('success', 'Administrativo eliminado');
    }
}
