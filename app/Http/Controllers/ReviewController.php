<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::with(['user', 'product']);

        // Filter by product if specified
        if ($request->has('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        // Filter by rating
        if ($request->has('rating') && $request->rating !== 'all') {
            $query->where('rating', $request->rating);
        }

        // Search in reviews
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        // Sort reviews
        $sortBy = $request->get('sort', 'created_at');
        switch ($sortBy) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'highest':
                $query->orderBy('rating', 'desc');
                break;
            case 'lowest':
                $query->orderBy('rating', 'asc');
                break;
            case 'helpful':
                $query->orderBy('helpful_count', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $reviews = $query->paginate(10);

        // Get rating distribution if viewing product reviews
        $ratingDistribution = [];
        if ($request->has('product_id')) {
            $product = Product::findOrFail($request->product_id);
            $ratingDistribution = Review::where('product_id', $request->product_id)
                ->selectRaw('rating, COUNT(*) as count')
                ->groupBy('rating')
                ->orderBy('rating', 'desc')
                ->get()
                ->pluck('count', 'rating')
                ->toArray();
        }

        return view('reviews.index', compact('reviews', 'ratingDistribution'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'size' => 'nullable|string',
            'color' => 'nullable|string',
            'images.*' => 'nullable|image|max:2048',
        ]);

        // Check if user has purchased this product
        $hasPurchased = Auth::user()->orders()
            ->whereHas('items', function ($query) use ($request) {
                $query->where('product_id', $request->product_id);
            })
            ->where('status', 'delivered')
            ->exists();

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('reviews', 'public');
                $images[] = $path;
            }
        }

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'title' => $request->title,
            'content' => $request->content,
            'size' => $request->size,
            'color' => $request->color,
            'images' => $images,
            'verified_purchase' => $hasPurchased,
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }

    public function vote(Request $request, Review $review)
    {
        $request->validate([
            'type' => 'required|in:helpful,not_helpful',
        ]);

        // Check if user already voted
        $existingVote = $review->helpfulVotes()
            ->where('user_id', Auth::id())
            ->first();

        if ($existingVote) {
            return response()->json([
                'success' => false,
                'message' => 'You have already voted on this review.'
            ]);
        }

        // Create vote record
        $review->helpfulVotes()->create([
            'user_id' => Auth::id(),
            'vote_type' => $request->type,
        ]);

        // Update counters
        if ($request->type === 'helpful') {
            $review->increment('helpful_count');
        } else {
            $review->increment('not_helpful_count');
        }

        return response()->json([
            'success' => true,
            'message' => 'Vote recorded successfully!',
            'helpful_count' => $review->helpful_count,
            'not_helpful_count' => $review->not_helpful_count,
        ]);
    }
}
