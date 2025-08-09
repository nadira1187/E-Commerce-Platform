<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem; // Using CartItem as per your controller
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $subtotal = $cartItems->sum(function($item) {
            return $item->quantity * $item->product->price;
        });

        $shipping = 15.00;
        $tax = $subtotal * 0.08;
        $total = $subtotal + $shipping + $tax;

        return view('checkout.index', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total'));
    }

    public function createPaymentIntent(Request $request)
    {
        try {
            $cartItems = CartItem::where('user_id', Auth::id())
                ->with('product')
                ->get();

            if ($cartItems->isEmpty()) {
                return response()->json(['error' => 'Cart is empty'], 400);
            }

            $subtotal = $cartItems->sum(function($item) {
                return $item->quantity * $item->product->price;
            });

            $shipping = 15.00;
            $tax = $subtotal * 0.08;
            $total = $subtotal + $shipping + $tax;

            // Create payment intent
            $paymentIntent = PaymentIntent::create([
                'amount' => round($total * 100), // Amount in cents
                'currency' => 'usd',
                'metadata' => [
                    'user_id' => Auth::id(),
                    'cart_items' => $cartItems->count(),
                ],
            ]);

            return response()->json([
                'client_secret' => $paymentIntent->client_secret,
                'payment_intent_id' => $paymentIntent->id
            ]);

        } catch (\Exception $e) {
            \Log::error('Stripe Payment Intent Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_intent_id' => 'required|string',
            'phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
            'billing_address' => 'required|string|max:500',
        ]);

        try {
            DB::beginTransaction();

            // Get cart items
            $cartItems = CartItem::where('user_id', Auth::id())
                ->with('product')
                ->get();

            if ($cartItems->isEmpty()) {
                return response()->json(['error' => 'Cart is empty'], 400);
            }

            // Calculate totals
            $subtotal = $cartItems->sum(function($item) {
                return $item->quantity * $item->product->price;
            });

            $shipping = 15.00;
            $tax = $subtotal * 0.08;
            $total = $subtotal + $shipping + $tax;

            // Verify payment intent
            $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id);
            
            if ($paymentIntent->status !== 'succeeded') {
                return response()->json(['error' => 'Payment not completed'], 400);
            }

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $total,
                'subtotal' => $subtotal,
                'shipping_cost' => $shipping,
                'tax_amount' => $tax,
                'status' => 'processing',
                'payment_status' => 'completed',
                'shipping_address' => $request->shipping_address,
                'billing_address' => $request->billing_address,
                'phone' => $request->phone,
                'payment_intent_id' => $request->payment_intent_id,
            ]);

            // Create order items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                    'total' => $cartItem->quantity * $cartItem->product->price,
                ]);

                // Update product stock
                $cartItem->product->decrement('stock_quantity', $cartItem->quantity);
            }

            // Clear cart
            CartItem::where('user_id', Auth::id())->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'order_id' => $order->id,
                'redirect_url' => route('checkout.success', $order)
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Order Processing Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function success(Order $order)
    {
        // Ensure user can only view their own order
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this order.');
        }

        $order->load(['items.product', 'user']);
        return view('checkout.success', compact('order'));
    }
}