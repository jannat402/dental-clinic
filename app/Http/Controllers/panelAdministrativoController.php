<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class panelAdministrativoController extends Controller
{   
    //
    public function index(){
        return view("vistaadministrador.paneladministrativo");
    }
    
    public function manejarDisponibilidad(){
        return view("vistaadministrador.manejodisponibilidad");
    }
    public function manejarAgenda(){
        return view("vistaadministrador.manejoagenda");
    }
    public function manejarBlog(){
        return view("vistaadministrador.blog");
    }
    public function manejarDoctores(){
        return view("vistaadministrador.manejodoctores");
    }
}
