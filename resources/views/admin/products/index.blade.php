@extends('layouts.admin')

@section('title', 'All Products')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
    <div class="container mx-auto px-6 py-8">
         Header 
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-gray-800 mb-2">All Products</h1>
                <p class="text-gray-600">Manage your product inventory</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all transform hover:scale-105 shadow-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add New Product
            </a>
        </div>

         Products Grid 
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition-all transform hover:scale-105 overflow-hidden">
                <div class="relative">
                    @if($product->images->count() > 0)
                        <img src="{{ Storage::url($product->images->first()->image_path) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    
                    <div class="absolute top-3 right-3">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                            @if($product->stock_quantity > 10) bg-green-100 text-green-800
                            @elseif($product->stock_quantity > 0) bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 @endif">
                            @if($product->stock_quantity > 0) {{ $product->stock_quantity }} in stock @else Out of stock @endif
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2 truncate">{{ $product->name }}</h3>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ Str::limit($product->description, 80) }}</p>
                    
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-2xl font-bold text-blue-600">${{ number_format($product->price, 2) }}</span>
                        <span class="text-sm text-gray-500">{{ $product->category->name ?? 'No Category' }}</span>
                    </div>

                    <div class="flex space-x-2">
                        <a href="{{ route('admin.products.edit', $product) }}" class="flex-1 bg-blue-50 text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-100 transition-colors text-center text-sm font-medium">
                            Edit
                        </a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-50 text-red-600 px-4 py-2 rounded-lg hover:bg-red-100 transition-colors text-sm font-medium">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

         Pagination 
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection