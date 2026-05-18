<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Doctor;
use App\Models\Administrativo;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AutenticarseController extends Controller
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
            'password' => 'required',
            'rol' => 'required|in:cliente,doctor,admin',
        ]);

        $login = $request->login;
        $password = $request->password;
        $rol = $request->rol;

        if ($rol === 'cliente') {
            $cliente = Cliente::where('email', $login)
                ->orWhere('telefono', $login)
                ->first();

            if ($cliente && Hash::check($password, $cliente->contrasenya)) {

                if ($cliente->estat === 'arxivat') {
                    return back()->withErrors(['login' => 'Esta cuenta está archivada. Contacta con el administrador.']);
                }

                $cliente->update(['ultima_actividad' => Carbon::now()]);

                session([
                    'rol' => 'cliente',
                    'cliente_id' => $cliente->id_cliente,
                    'cliente_nombre' => $cliente->nombre,
                ]);

                return redirect()->route('iniciusuario');
            }
        }

        if ($rol === 'doctor') {
            $doctor = Doctor::where('email', $login)->first();

            if ($doctor && Hash::check($password, $doctor->contrasenya)) {

                if ($doctor->estado === 'baja') {
                    return back()->withErrors(['login' => 'Este doctor está dado de baja.']);
                }

                session([
                    'rol' => 'doctor',
                    'doctor_id' => $doctor->id_doctor,
                    'doctor_nombre' => $doctor->nombre,
                ]);

                return redirect()->route('doctor.agenda');
            }
        }

        if ($rol === 'admin') {
            $admin = Administrativo::where('email', $login)->first();

            if ($admin && Hash::check($password, $admin->contrasenya)) {

                session()->forget(['2fa_codi', '2fa_expira']);

                if ($admin->autenticacion_segura === '2FA') {
                    session([
                        '2fa_pending_type' => 'admin',
                        '2fa_pending_id' => $admin->id_admin,
                    ]);
                    app(\App\Http\Controllers\TwoFactorController::class)->generarCodi('admin', $admin->id_admin);
                    return redirect()->route('2fa.form')->with('success', 'Codi enviat al teu correu.');
                }

                session([
                    'rol' => 'admin',
                    'admin_id' => $admin->id_admin,
                    'admin_nombre' => $admin->nombre,
                ]);

                return redirect()->route('iniciadministrativo');
            }
        }

        return back()->withErrors(['login' => 'Credenciales incorrectas']);
    }

    // Mostrar registro cliente
    public function registrar()
    {
        return view('vistacliente.registro');
    }

    // Procesar registro cliente
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'email' => 'required|email|unique:cliente,email',
            'telefono' => 'required|digits:9',
            'contrasenya' => 'required|confirmed|min:4',
        ]);

        $cliente = Cliente::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'contrasenya' => Hash::make($request->contrasenya),
            'metodo_autenticacion' => 'email',
            'fecha_dato' => now(),
            'fecha_carga' => now(),
        ]);

        session([
            'rol' => 'cliente',
            'cliente_id' => $cliente->id_cliente,
            'cliente_nombre' => $cliente->nombre,
        ]);

        return redirect()->route('pedircita');
    }

    // Logout
    public function logout()
    {
        session()->flush();
        return redirect()->route('paginainici');
    }
}
