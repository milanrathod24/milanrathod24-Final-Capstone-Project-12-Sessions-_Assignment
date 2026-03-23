<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Initiate a Stripe Checkout session for a one-time payment.
     */
    public function checkout(Request $request)
    {
        // Require the user to be authenticated
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Set Stripe API key
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        // Create a Checkout Session directly using the Stripe SDK
        $checkoutSession = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'mode' => 'payment',
            'customer_email' => $user->email,
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Test Payment',
                    ],
                    'unit_amount' => 1000, // $10.00
                ],
                'quantity' => 1,
            ]],
            'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('payment.cancel'),
        ]);

        return redirect()->away($checkoutSession->url);
    }

    /**
     * Handle successful payment.
     */
    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');
        
        return view('payment.success', ['sessionId' => $sessionId]);
    }

    /**
     * Handle cancelled payment.
     */
    public function cancel()
    {
        return view('payment.cancel');
    }
}
