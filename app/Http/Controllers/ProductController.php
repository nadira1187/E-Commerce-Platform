<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::with(['reviews.user', 'reviews' => function($query) {
            $query->orderBy('created_at', 'desc')->limit(5);
        }])->findOrFail($id);

        // Calculate average rating and reviews count
        $product->average_rating = $product->reviews()->avg('rating') ?? 0;
        $product->reviews_count = $product->reviews()->count();

        // Get related products
$relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:10',
            'size' => 'nullable|string',
            'color' => 'nullable|string'
        ]);

        $product = Product::findOrFail($request->product_id);

        if (!$product->in_stock) {
            return response()->json([
                'success' => false,
                'message' => 'Product is out of stock'
            ]);
        }

        // Check if item already exists in cart
        $existingItem = \App\Models\CartItem::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->where('size', $request->size)
            ->where('color', $request->color)
            ->first();

        if ($existingItem) {
            $existingItem->quantity += $request->quantity;
            $existingItem->save();
        } else {
            \App\Models\CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'size' => $request->size,
                'color' => $request->color
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully!'
        ]);
    }
}
