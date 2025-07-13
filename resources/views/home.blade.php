@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-purple-600 to-blue-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-6xl font-bold mb-4">Fashion That Speaks</h1>
        <p class="text-xl md:text-2xl mb-8 opacity-90">
            Discover the latest trends in clothing for men, women, and kids
        </p>
        <a href="#products" class="bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
            Shop Now
        </a>
    </div>
</section>

<!-- Category Filter -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" id="products">
    <div class="flex flex-wrap gap-4 items-center justify-between mb-8">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('home') }}" 
               class="px-4 py-2 rounded-full {{ !request('category') ? 'bg-purple-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                All Categories
            </a>
            @foreach(['men', 'women', 'kids'] as $category)
                <a href="{{ route('home', ['category' => $category]) }}" 
                   class="px-4 py-2 rounded-full {{ request('category') === $category ? 'bg-purple-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    {{ ucfirst($category) }}
                </a>
            @endforeach
        </div>
        
        <div class="flex items-center space-x-4">
            <select onchange="window.location.href=this.value" class="border border-gray-300 rounded-lg px-3 py-2">
                <option value="{{ route('home', array_merge(request()->all(), ['sort' => 'created_at'])) }}" 
                        {{ request('sort') === 'created_at' ? 'selected' : '' }}>Newest</option>
                <option value="{{ route('home', array_merge(request()->all(), ['sort' => 'price_low'])) }}" 
                        {{ request('sort') === 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                <option value="{{ route('home', array_merge(request()->all(), ['sort' => 'price_high'])) }}" 
                        {{ request('sort') === 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                <option value="{{ route('home', array_merge(request()->all(), ['sort' => 'rating'])) }}" 
                        {{ request('sort') === 'rating' ? 'selected' : '' }}>Highest Rated</option>
            </select>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($products as $product)
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 group">
                <div class="relative overflow-hidden rounded-t-lg">
                    <img src="{{ $product->images }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                    
                    @if($product->discount_percentage > 0)
                        <span class="absolute top-2 left-2 bg-red-500 text-white px-2 py-1 rounded text-sm font-semibold">
                            -{{ $product->discount_percentage }}%
                        </span>
                    @endif
                    
                    @auth
                        <button onclick="toggleWishlist({{ $product->id }})" 
                                class="absolute top-2 right-2 p-2 bg-white rounded-full shadow-md hover:bg-gray-50">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.682l-1.318-1.364a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </button>
                    @endauth
                </div>
                
                <div class="p-4">
                    <h3 class="font-semibold text-lg mb-2 line-clamp-2">{{ $product->name }}</h3>
                    
                    <div class="flex items-center mb-2">
                        <div class="flex items-center">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $product->average_rating ? 'text-yellow-400 fill-current' : 'text-gray-300' }}" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            @endfor
                        </div>
                        <span class="text-sm text-gray-600 ml-2">({{ $product->total_reviews }})</span>
                    </div>
                    
                    <div class="flex items-center space-x-2 mb-3">
                        <span class="text-xl font-bold text-gray-900">${{ $product->price }}</span>
                        @if($product->original_price && $product->original_price > $product->price)
                            <span class="text-sm text-gray-500 line-through">${{ $product->original_price }}</span>
                        @endif
                    </div>
                    
                    <div class="flex flex-wrap gap-1 mb-3">
                        @foreach(array_slice($product->sizes, 0, 3) as $size)
                            <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded">{{ $size }}</span>
                        @endforeach
                        @if(count($product->sizes) > 3)
                            <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded">+{{ count($product->sizes) - 3 }}</span>
                        @endif
                    </div>
                    
                    <div class="flex space-x-2">
                        <a href="{{ route('product.show', $product->id) }}" 
                           class="flex-1 bg-purple-600 text-white text-center py-2 rounded-lg hover:bg-purple-700 transition duration-300">
                            View Details
                        </a>
                        @auth
                            <button onclick="addToCart({{ $product->id }})" 
                                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9m-9 0V19a2 2 0 002 2h7a2 2 0 002-2v-4"></path>
                                </svg>
                            </button>
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <div class="text-gray-400 mb-4">
                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No products found</h3>
                <p class="text-gray-600">Try adjusting your search or filter criteria.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $products->appends(request()->query())->links() }}
    </div>
</section>

<!-- Features Section -->
<section class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Why Choose StyleHub?</h2>
            <p class="text-lg text-gray-600">Experience the best in online fashion shopping</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9m-9 0V19a2 2 0 002 2h7a2 2 0 002-2v-4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Secure Shopping</h3>
                <p class="text-gray-600">Safe and secure payment processing with multiple payment options</p>
            </div>
            <div class="text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Quality Products</h3>
                <p class="text-gray-600">Curated collection of high-quality clothing from trusted brands</p>
            </div>
            <div class="text-center">
                <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Customer Support</h3>
                <p class="text-gray-600">24/7 customer support to help you with any questions or concerns</p>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    function addToCart(productId) {
        // This would typically open a modal to select size/color
        // For now, we'll use default values
        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: 1,
                size: 'M',
                color: 'Default'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateCartCount();
                alert('Product added to cart!');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function toggleWishlist(productId) {
        // Wishlist functionality would be implemented here
        alert('Wishlist feature coming soon!');
    }
</script>
@endpush
