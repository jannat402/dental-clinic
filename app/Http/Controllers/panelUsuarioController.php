<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class panelUsuarioController extends Controller
{
    //
    public function index(){
        return view("vistacliente.panelusuario");
    }
    public function mostrar(){
        return view("vistacliente.panelcitas");
    }
    public function cambiar(){
        return view("vistacliente.panelcitas");
    }
    //Así nadie entra sin login
    public function __construct()
    {
        if (!session()->has('cliente_id')) {
            return redirect()->route('paginainici')->send();
        }
    }

}
