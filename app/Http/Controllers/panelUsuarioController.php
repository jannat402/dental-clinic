<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cita;

class panelUsuarioController extends Controller
{
    public function __construct()
    {
        if (!session()->has('cliente_id')) {
            return redirect()->route('paginainici')->send();
        }
    }

    public function index()
    {
        return view("vistacliente.panelusuario");
    }

    public function mostrar()
    {
        // ID del cliente logueado
        $idCliente = session('cliente_id');

        // Obtener todas las citas del cliente (si no hay, devuelve colección vacía)
        $citas = Cita::where('id_cliente', $idCliente)->get();

        return view("vistacliente.panelcitas", compact('citas'));
    }

    public function cambiar()
    {
        // Puedes usar la misma lógica si también necesitas citas aquí
        $idCliente = session('cliente_id');
        $citas = Cita::where('id_cliente', $idCliente)->get();

        return view("vistacliente.panelcitas", compact('citas'));
    }
}
