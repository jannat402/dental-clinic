<?php

namespace App\Http\Controllers;

use App\Models\Administrativo;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TwoFactorController extends Controller
{
    // Mostrar formulario 2FA
    public function index()
    {
        $tipus = session('2fa_pending_type');
        $id = session('2fa_pending_id');

        if (!$tipus || !$id) {
            return redirect()->route('paginainici');
        }

        return view('auth.verify-2fa', compact('tipus'));
    }

    // Generar y enviar código 2FA, mostrar formulario
    public function enviarCodi()
    {
        $tipus = session('2fa_pending_type');
        $id = session('2fa_pending_id');

        if (!$tipus || !$id) {
            return redirect()->route('paginainici');
        }

        $codi = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        session(['2fa_codi' => $codi, '2fa_expira' => now()->addMinutes(5)]);

        if ($tipus === 'admin') {
            $admin = Administrativo::find($id);
            if ($admin) {
                Mail::raw("El teu codi de verificació 2FA és: {$codi}", function ($msg) use ($admin) {
                    $msg->to($admin->email)->subject('Codi 2FA - Dental Clinic');
                });
            }
        } else {
            $doctor = Doctor::find($id);
            if ($doctor) {
                Mail::raw("El teu codi de verificació 2FA és: {$codi}", function ($msg) use ($doctor) {
                    $msg->to($doctor->email)->subject('Codi 2FA - Dental Clinic');
                });
            }
        }

        return redirect()->route('2fa.form')->with('success', 'Codi enviat al teu correu.');
    }

    // Verificar código 2FA
    public function verificar(Request $request)
    {
        $request->validate(['codi' => 'required|string|size:6']);

        $codiSession = session('2fa_codi');
        $expira = session('2fa_expira');
        $tipus = session('2fa_pending_type');

        if (!$codiSession || !$expira || !$tipus) {
            return redirect()->route('paginainici');
        }

        if (now()->gt($expira)) {
            session()->forget(['2fa_codi', '2fa_expira']);
            return back()->withErrors(['codi' => 'El codi ha caducat. Torna a enviar-lo.']);
        }

        if ($request->codi !== $codiSession) {
            return back()->withErrors(['codi' => 'Codi incorrecte.']);
        }

        session()->forget(['2fa_codi', '2fa_expira']);

        if ($tipus === 'admin') {
            $admin = Administrativo::find(session('2fa_pending_id'));
            session([
                'rol' => 'admin',
                'admin_id' => $admin->id_admin,
                'admin_nombre' => $admin->nombre,
            ]);
            session()->forget(['2fa_pending_type', '2fa_pending_id']);
            return redirect()->route('iniciadministrativo');
        }

        $doctor = Doctor::find(session('2fa_pending_id'));
        session([
            'rol' => 'doctor',
            'doctor_id' => $doctor->id_doctor,
            'doctor_nombre' => $doctor->nombre,
        ]);
        session()->forget(['2fa_pending_type', '2fa_pending_id']);

        if ($doctor->estado === 'baja') {
            session()->flush();
            return redirect()->route('paginainici')->withErrors(['login' => 'Aquest compte de doctor està donat de baixa.']);
        }

        return redirect()->route('doctor.agenda');
    }
}
