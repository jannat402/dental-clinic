<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class autenticarseController extends Controller
{
    public function index(){
        return view("vistacliente.iniciarsession");
    }
    public function registrar(){
        return view("vistacliente.registro1");
    }
}
