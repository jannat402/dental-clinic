<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Exception\ApiErrorException;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $citaId = $request->query('cita');
        $cita = null;
        $monto = 1000;

        if ($citaId) {
            $cita = Cita::with('tratamiento')->find($citaId);
            if ($cita && $cita->tratamiento) {
                $monto = (int)($cita->tratamiento->precio * 100);
            }
        }

        return view('payment.payment', [
            'citaId' => $citaId,
            'monto' => $monto
        ]);
    }

    public function createPayment(Request $request)
    {
        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            $amount = $request->input('amount', 1000);
            $citaId = $request->input('cita_id');

            $intent = PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'eur',
                'automatic_payment_methods' => ['enabled' => true],
                'metadata' => ['cita_id' => $citaId ?? ''],
            ]);

            return response()->json([
                'clientSecret' => $intent->client_secret,
                'cita_id' => $citaId,
            ]);
        } catch (ApiErrorException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function success(Request $request)
    {
        $status = $request->query('status', 'canceled');
        $paymentIntent = $request->query('payment_intent', '');
        $message = $request->query('message', '');
        $citaId = $request->query('cita_id');

        if ($status === 'succeeded' && $citaId) {
            $cita = Cita::find($citaId);
            if ($cita) {
                $cita->update(['estado' => 'reservada']);
            }
        }

        return view('payment.success', [
            'status' => $status,
            'paymentIntent' => $paymentIntent,
            'message' => $message,
        ]);
    }
}


