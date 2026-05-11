<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index($id_cita)
    {
        $cita = Cita::with(['tratamiento', 'cliente', 'doctor'])->findOrFail($id_cita);
        return view('payment.payment', compact('cita'));
    }

    public function process($id_cita)
    {
        $cita = Cita::findOrFail($id_cita);
        $cita->update(['estado' => 'reservada']);

        app(NotificationService::class)->enviarConfirmacio($cita);
        session()->forget('pending_cita_id');

        return redirect()->route('payment.success', ['id_cita' => $cita->id_cita, 'status' => 'succeeded']);
    }

    public function success(Request $request, $id_cita)
    {
        $cita = Cita::with(['doctor', 'tratamiento'])->find($id_cita);

        return view('payment.success', [
            'status' => $request->query('status', 'canceled'),
            'cita' => $cita,
            'paymentIntent' => 'SIMULATED',
        ]);
    }
}
