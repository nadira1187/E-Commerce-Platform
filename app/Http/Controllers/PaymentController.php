<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Order;
use App\Models\Cart;

class PaymentController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function checkout()
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        $total = $cartItems->sum(function($item) {
            return $item->quantity * $item->product->price;
        });

        return view('checkout', compact('cartItems', 'total'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_method_id' => 'required',
            'shipping_address' => 'required|string',
            'billing_address' => 'required|string',
        ]);

        try {
            $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
            $total = $cartItems->sum(function($item) {
                return $item->quantity * $item->product->price;
            });

            // Create payment intent
            $paymentIntent = PaymentIntent::create([
                'amount' => $total * 100, // Convert to cents
                'currency' => 'usd',
                'payment_method' => $request->payment_method_id,
                'confirmation_method' => 'manual',
                'confirm' => true,
                'return_url' => route('payment.success'),
            ]);

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $total,
                'status' => 'pending',
                'shipping_address' => $request->shipping_address,
                'billing_address' => $request->billing_address,
                'payment_intent_id' => $paymentIntent->id,
            ]);

            // Add order items
            foreach ($cartItems as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            // Clear cart
            Cart::where('user_id', auth()->id())->delete();

            return response()->json([
                'success' => true,
                'redirect' => route('payment.success', $order->id)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function success(Order $order)
    {
        return view('payment.success', compact('order'));
    }
}