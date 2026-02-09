<?php

namespace App\Http\Controllers;

use App\Models\Administrativo;
use Illuminate\Http\Request;

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
            'autenticacion_segura' => 'required|in:2FA,certificado',
            'rol' => 'required'
        ]);

        Administrativo::create($request->all());

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

        $admin->update($request->all());

        return redirect()->route('administrativos.index')->with('success', 'Administrativo actualizado correctamente');
    }

    public function destroy($id)
    {
        Administrativo::destroy($id);
        return redirect()->route('administrativos.index')->with('success', 'Administrativo eliminado');
    }
}
