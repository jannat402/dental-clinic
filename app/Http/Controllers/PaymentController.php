<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Exception\ApiErrorException;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payment.payment');
    }

    public function createPayment(Request $request)
    {
        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            $amount = $request->input('amount', 1000);

            $intent = PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'eur',
                'automatic_payment_methods' => ['enabled' => true],
            ]);

            return response()->json([
                'clientSecret' => $intent->client_secret,
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

        return view('payment.success', [
            'status' => $status,
            'paymentIntent' => $paymentIntent,
            'message' => $message,
        ]);
    }
}


