<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function dashboard()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'total_customers' => User::where('role', 'customer')->count(),
            'total_revenue' => Order::where('status', 'completed')->sum('total_amount'),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'recent_orders' => Order::with('user')->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function products()
    {
        $products = Product::with('category')->paginate(12);
        return view('admin.products.index', compact('products'));
    }

    public function createProduct()
    {
        return view('admin.products.create');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::create($request->only([
            'name', 'description', 'price', 'stock_quantity', 'category_id'
        ]));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $product->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('admin.products')->with('success', 'Product created successfully!');
    }

    public function orders()
    {
        $orders = Order::with(['user', 'items.product'])->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Order status updated successfully!');
    }

    public function reviews()
    {
        $reviews = Review::with(['user', 'product'])->latest()->paginate(15);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function deleteReview(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Review deleted successfully!');
    }
}