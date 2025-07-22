<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:1000'
        ]);

        // Check if user already reviewed this product
        $existingReview = Review::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingReview) {
            return response()->json([
                'success' => false,
                'message' => 'You have already reviewed this product'
            ]);
        }

        // Check if user purchased this product (optional)
        $verifiedPurchase = \App\Models\OrderItem::whereHas('order', function($query) {
            $query->where('user_id', Auth::id())
                  ->where('status', 'completed');
        })->where('product_id', $request->product_id)->exists();

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'title' => $request->title,
            'content' => $request->content,
            'verified_purchase' => $verifiedPurchase
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Review submitted successfully!'
        ]);
    }

    public function like($id)
    {
        $review = Review::findOrFail($id);
        
        // Toggle like (simple implementation)
        $like = \App\Models\ReviewLike::where('user_id', Auth::id())
            ->where('review_id', $id)
            ->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            \App\Models\ReviewLike::create([
                'user_id' => Auth::id(),
                'review_id' => $id
            ]);
            $liked = true;
        }

        $likesCount = $review->likes()->count();

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $likesCount
        ]);
    }
}
