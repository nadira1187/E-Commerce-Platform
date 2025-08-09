<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Please login to view your cart.');
        }

        // Remove ->with(['product.images']) since images are now in the product table
        $cartItems = CartItem::where('user_id', Auth::id())
            ->with('product')
            ->get();

        $subtotal = $cartItems->sum(function($item) {
            return $item->quantity * $item->product->price;
        });

        $shipping = 15.00;
        $tax = $subtotal * 0.08;
        $total = $subtotal + $shipping + $tax;

        return view('cart.index', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total'));
    }

    public function count()
    {
        if (!Auth::check()) {
            return response()->json(['count' => 0]);
        }

        $count = CartItem::where('user_id', Auth::id())->sum('quantity');
        
        return response()->json(['count' => $count]);
    }

    public function add(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to add items to cart',
                'redirect' => route('login')
            ], 401);
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:10',
            'size' => 'nullable|string',
            'color' => 'nullable|string'
        ]);

        try {
            $product = Product::findOrFail($request->product_id);

            // Check if product is out of stock based on stock_quantity
            if ($product->stock_quantity <= 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product is out of stock'
                ]);
            }

            // Check if item already exists in cart
            $existingItem = CartItem::where('user_id', Auth::id())
                ->where('product_id', $request->product_id)
                ->where('size', $request->size)
                ->where('color', $request->color)
                ->first();

            if ($existingItem) {
                $existingItem->quantity += $request->quantity;
                $existingItem->save();
            } else {
                CartItem::create([
                    'user_id' => Auth::id(),
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                    'size' => $request->size,
                    'color' => $request->color
                ]);
            }

            // Get updated cart count
            $cartCount = CartItem::where('user_id', Auth::id())->sum('quantity');

            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully!',
                'cart_count' => $cartCount
            ]);

        } catch (\Exception $e) {
            \Log::error('Cart add error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while adding to cart'
            ], 500);
        }
    }

    public function update(Request $request, $itemId)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 401);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1|max:99'
        ]);

        $cartItem = CartItem::with('product')
            ->where('id', $itemId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$cartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Cart item not found'
            ], 404);
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        // Calculate new totals
        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $shipping = $subtotal >= 100 ? 0 : 10;
        $tax = $subtotal * 0.08;
        $total = $subtotal + $shipping + $tax;

        return response()->json([
            'success' => true,
            'item_total' => number_format($cartItem->product->price * $cartItem->quantity, 2),
            'cart_summary' => [
                'subtotal' => number_format($subtotal, 2),
                'shipping' => number_format($shipping, 2),
                'tax' => number_format($tax, 2),
                'total' => number_format($total, 2)
            ]
        ]);
    }

    public function remove($itemId)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 401);
        }

        $cartItem = CartItem::where('id', $itemId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$cartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Cart item not found'
            ], 404);
        }

        $cartItem->delete();

        // Calculate new totals
        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $shipping = $subtotal >= 100 ? 0 : 10;
        $tax = $subtotal * 0.08;
        $total = $subtotal + $shipping + $tax;

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart',
            'cart_summary' => [
                'subtotal' => number_format($subtotal, 2),
                'shipping' => number_format($shipping, 2),
                'tax' => number_format($tax, 2),
                'total' => number_format($total, 2)
            ]
        ]);
    }

    public function applyPromo(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 401);
        }

        $request->validate([
            'promo_code' => 'required|string'
        ]);

        $promoCode = strtoupper($request->promo_code);
        
        // Define available promo codes
        $promoCodes = [
            'SAVE10' => ['discount' => 10, 'type' => 'percentage'],
            'SAVE20' => ['discount' => 20, 'type' => 'percentage'],
            'FLAT5' => ['discount' => 5, 'type' => 'fixed'],
            'WELCOME15' => ['discount' => 15, 'type' => 'percentage'],
        ];

        if (!isset($promoCodes[$promoCode])) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid promo code'
            ]);
        }

        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $promo = $promoCodes[$promoCode];
        $discountAmount = 0;

        if ($promo['type'] === 'percentage') {
            $discountAmount = $subtotal * ($promo['discount'] / 100);
        } else {
            $discountAmount = $promo['discount'];
        }

        // Don't let discount exceed subtotal
        $discountAmount = min($discountAmount, $subtotal);

        $newSubtotal = $subtotal - $discountAmount;
        $shipping = $newSubtotal >= 100 ? 0 : 10;
        $tax = $newSubtotal * 0.08;
        $total = $newSubtotal + $shipping + $tax;

        // Store promo code in session
        session(['applied_promo' => $promoCode, 'discount_amount' => $discountAmount]);

        return response()->json([
            'success' => true,
            'message' => "Promo code applied! You saved $" . number_format($discountAmount, 2),
            'discount_amount' => number_format($discountAmount, 2),
            'cart_summary' => [
                'subtotal' => number_format($subtotal, 2),
                'shipping' => number_format($shipping, 2),
                'tax' => number_format($tax, 2),
                'total' => number_format($total, 2)
            ]
        ]);
    }

    public function saveForLater()
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'message' => 'Cart saved for later!'
        ]);
    }

    public function addToWishlist(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to add items to wishlist',
                'redirect' => route('login')
            ], 401);
        }

        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        // For now, just return success (you can implement wishlist table later)
        return response()->json([
            'success' => true,
            'message' => 'Product added to wishlist!'
        ]);
    }
}
