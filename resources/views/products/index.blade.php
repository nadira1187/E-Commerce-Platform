@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-100 px-4 md:px-8 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold bg-gradient-to-r from-green-800 to-green-900 bg-clip-text text-transparent mb-4">
            Our Products
        </h1>
        <p class="text-gray-600 text-lg">Discover our curated collection of fashion items</p>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @forelse($products as $product)
            <div class="backdrop-blur-sm bg-white/90 rounded-2xl shadow-lg border-0 overflow-hidden group hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                <div class="relative overflow-hidden">
                    <img src="{{ $product->images }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                    
                    @if($product->original_price && $product->original_price > $product->price)
                        <div class="absolute top-4 left-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                            {{ round((($product->original_price - $product->price) / $product->original_price) * 100) }}% OFF
                        </div>
                    @endif
                </div>
                
                <div class="p-6">
                    <h3 class="font-bold text-xl text-gray-900 mb-2 group-hover:text-green-800 transition-colors">
                        {{ $product->name }}
                    </h3>
                    
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        {{ Str::limit($product->description, 100) }}
                    </p>
                    
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            <span class="text-2xl font-bold text-green-800">${{ $product->price }}</span>
                            @if($product->original_price && $product->original_price > $product->price)
                                <span class="text-lg text-gray-500 line-through">${{ $product->original_price }}</span>
                            @endif
                        </div>
                        
                        @if($product->in_stock)
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">In Stock</span>
                        @else
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-semibold">Out of Stock</span>
                        @endif
                    </div>
                    
                    <a href="{{ route('products.show', $product->id) }}" 
                       class="block w-full bg-gradient-to-r from-green-800 to-green-900 hover:from-green-700 hover:to-green-800 text-white py-3 rounded-xl font-semibold text-center transition-all duration-300 transform hover:scale-105">
                        View Details
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-20">
                <div class="backdrop-blur-sm bg-white/90 rounded-2xl shadow-2xl border-0 p-12 max-w-md mx-auto">
                    <svg class="w-32 h-32 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">No products found</h2>
                    <p class="text-gray-600 mb-8 text-lg">We're working on adding new products. Check back soon!</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
