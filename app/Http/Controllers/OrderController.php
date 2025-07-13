<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Models\OrderTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Order::with(['items.product', 'trackingUpdates'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);

        $order->load(['items.product', 'trackingUpdates']);

        return view('orders.show', compact('order'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|array',
            'billing_address' => 'required|array',
            'payment_method' => 'required|string',
        ]);

        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty!');
        }

        DB::transaction(function () use ($request, $cartItems) {
            $subtotal = $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            $shipping = $subtotal > 100 ? 0 : 9.99;
            $tax = $subtotal * 0.08;
            $total = $subtotal + $shipping + $tax;

            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => 'pending',
                'subtotal' => $subtotal,
                'shipping_amount' => $shipping,
                'tax_amount' => $tax,
                'total_amount' => $total,
                'payment_method' => $request->payment_method,
                'shipping_address' => $request->shipping_address,
                'billing_address' => $request->billing_address,
                'payment_status' => 'pending',
            ]);

            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                    'size' => $cartItem->size,
                    'color' => $cartItem->color,
                ]);

                // Update product stock
                $cartItem->product->decrement('stock_quantity', $cartItem->quantity);
            }

            // Clear cart
            CartItem::where('user_id', Auth::id())->delete();

            // Create initial tracking
            OrderTracking::create([
                'order_id' => $order->id,
                'status' => 'Order placed',
                'location' => 'StyleHub Fulfillment Center',
                'description' => 'Your order has been received and is being processed.',
                'tracked_at' => now(),
            ]);
        });

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }

    public function updateTracking(Request $request, Order $order)
    {
        $this->authorize('update', $order);

        $request->validate([
            'status' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
        ]);

        OrderTracking::create([
            'order_id' => $order->id,
            'status' => $request->status,
            'location' => $request->location,
            'description' => $request->description,
            'tracked_at' => now(),
        ]);

        // Update order status if needed
        if (in_array($request->status, ['shipped', 'delivered', 'cancelled'])) {
            $order->update(['status' => $request->status]);
            
            if ($request->status === 'shipped') {
                $order->update(['shipped_at' => now()]);
            } elseif ($request->status === 'delivered') {
                $order->update(['delivered_at' => now()]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Tracking updated successfully!'
        ]);
    }
}
