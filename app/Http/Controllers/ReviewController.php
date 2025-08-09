<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\ReviewLike;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
{
    $reviews = Review::with('user', 'product')->latest()->paginate(10);
    return view('reviews.index', compact('reviews'));
}


    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to submit a review',
                'redirect' => route('login')
            ], 401);
        }

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

        // Check if user purchased this product (optional - you'll need to implement OrderItem model)
        $verifiedPurchase = false; // Set to false for now since we don't have orders implemented

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
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to like reviews',
                'redirect' => route('login')
            ], 401);
        }

        $review = Review::findOrFail($id);
        
        // Toggle like (simple implementation)
        $like = ReviewLike::where('user_id', Auth::id())
            ->where('review_id', $id)
            ->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            ReviewLike::create([
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
