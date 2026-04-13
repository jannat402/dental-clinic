<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Doctor;            
use App\Models\Administrativo;    
use Illuminate\Support\Facades\Hash;

class autenticarseController extends Controller
{
    // Mostrar login
    public function index()
    {
        return view('vistacliente.iniciarsession');
    }

    // Procesar login
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'contrasenya' => 'required',
        ]);

        $login = $request->login;
        $contrasenya = $request->contrasenya;

        // CLIENTE
        $user = Cliente::where('email', $login)
            ->orWhere('telefono', $login)
            ->first();

        if ($user && Hash::check($contrasenya, $user->contrasenya)) {

            session([
                'cliente_id' => $user->id_cliente,
                'cliente_nombre' => $user->nombre,
            ]);

            return redirect()->route('iniciusuario');
        }

        // DOCTOR
        $doctor = Doctor::where('email', $login)->first();

        if ($doctor && Hash::check($contrasenya, $doctor->contrasenya)) {

            session([
                'doctor_id' => $doctor->id_doctor,
                'doctor_nombre' => $doctor->nombre,
            ]);

            return redirect()->route('agenda'); // Panel del doctor
        }

        // ADMINISTRADOR
        $admin = Administrativo::where('email', $login)->first();

        if ($admin && Hash::check($contrasenya, $admin->contrasenya)) {

            session([
                'admin_id' => $admin->id_admin,
                'admin_nombre' => $admin->nombre,
            ]);

            return redirect()->route('paneladministrativo'); // Panel admin
        }

        // SI NINGUNO COINCIDE
        return back()->withErrors(['login' => 'Credenciales incorrectas']);
    }

    // Mostrar registro
    public function registrar()
    {
        return view('registro');
    }

    // Procesar registro
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'email' => 'required|email|unique:cliente,email',
            'telefono' => 'required|digits:9',
            'contrasenya' => 'required|confirmed|min:4',
        ]);

        Cliente::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'contrasenya' => Hash::make($request->contrasenya),
            'metodo_autenticacion' => 'email',
            'fecha_dato' => now(),
            'fecha_carga' => now(),
        ]);

        return redirect()->route('paginainici')->with('success', 'Registro completado');
    }

    // Logout
    public function logout()
    {
        session()->flush();
        return redirect()->route('paginainici');
    }
}
