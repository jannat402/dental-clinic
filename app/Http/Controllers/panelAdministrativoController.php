<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\Doctor;
use App\Models\Cliente;
use App\Models\Administrativo;
use Illuminate\Http\Request;

class PanelAdministrativoController extends Controller
{
    public function index()
    {
        $totalDoctores = Doctor::count();
        $totalClientes = Cliente::count();
        $citasHoy = Cita::whereDate('fecha', today())->count();
        $citasPendientes = Cita::where('estado', 'pendiente_pago')->count();
        $totalAdmins = Administrativo::count();

        return view("vistaadministrador.paneladministrativo", compact(
            'totalDoctores', 'totalClientes', 'citasHoy', 'citasPendientes', 'totalAdmins'
        ));
    }

    public function manejarDisponibilidad()
    {
        return view("vistaadministrador.manejodisponibilidad");
    }

    public function manejarAgenda()
    {
        return view("vistaadministrador.manejoagenda");
    }

    public function manejarBlog()
    {
        return view("vistaadministrador.blog");
    }

    public function manejarDoctores()
    {
        return view("vistaadministrador.manejodoctores");
    }
}
