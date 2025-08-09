@extends('layouts.app')

@section('title', 'My Reviews')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-yellow-50 via-amber-50 to-yellow-100">
    <div class="container mx-auto px-6 py-12">
         <!-- Header  -->
        <div class="text-center mb-16">
            <h1 class="text-6xl font-black text-green-950 mb-6">My Reviews</h1>
            <p class="text-xl text-green-800 max-w-2xl mx-auto leading-relaxed">
                Your thoughts and feedback on purchased products
            </p>
            <div class="w-32 h-1 bg-gradient-to-r from-green-600 to-green-800 mx-auto mt-8 rounded-full"></div>
        </div>

        @if($reviews->count() > 0)
             <!-- Reviews Grid  -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @foreach($reviews as $review)
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border-2 border-green-100 hover:shadow-3xl transition-all duration-500 overflow-hidden group">
                     <!-- Review Header  -->
                    <div class="bg-gradient-to-r from-green-950 to-green-900 p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                 <!-- Rating Stars  -->
                                <div class="flex items-center space-x-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-6 h-6 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-yellow-100 font-bold text-lg">{{ $review->rating }}/5</span>
                            </div>
                            <div class="text-right">
                                <p class="text-yellow-100 text-sm">{{ $review->created_at->format('M d, Y') }}</p>
                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                    @if($review->is_approved) bg-green-500 text-white @else bg-yellow-500 text-white @endif">
                                    @if($review->is_approved) Approved @else Pending @endif
                                </span>
                            </div>
                        </div>
                    </div>

                     <!-- Product Info  -->
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-6 p-4 bg-gradient-to-r from-yellow-50 to-amber-50 rounded-2xl border border-green-200">
                            @php
    $images = json_decode($review->product->images) ?? [];
@endphp

@if(count($images) > 0)
    <img src="{{ Storage::url($images[0]) }}" alt="{{ $review->product->name }}" class="w-20 h-20 object-cover rounded-2xl shadow-lg">
                            @else
                                <div class="w-20 h-20 bg-gradient-to-br from-green-200 to-green-300 rounded-2xl flex items-center justify-center shadow-lg">
                                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-green-950 mb-2">{{ $review->product->name }}</h3>
                                <p class="text-green-700 font-semibold">${{ number_format($review->product->price, 2) }}</p>
                            </div>
                        </div>

                         <!-- Review Content  -->
                        <div class="mb-6">
                            <h4 class="text-lg font-bold text-green-950 mb-3">My Review:</h4>
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-2xl border-l-4 border-green-600">
                                <p class="text-green-800 leading-relaxed text-lg">{{ $review->content }}</p>
                            </div>
                        </div>

                         <!-- Actions  -->
                        <div class="flex justify-between items-center pt-4 border-t-2 border-green-100">
                            <div class="flex items-center space-x-2">
                                @if($review->helpful_count > 0)
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
                                    {{ $review->helpful_count }} found helpful
                                </span>
                                @endif
                            </div>
                            
                            <div class="flex space-x-3">
                                <button class="px-6 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                    Edit Review
                                </button>
                                <button class="px-6 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white font-bold rounded-xl hover:from-red-600 hover:to-red-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

             <!-- Pagination  -->
            <div class="mt-16">
                {{ $reviews->links() }}
            </div>
        @else
             <!-- Empty State  -->
            <div class="text-center py-20">
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border-2 border-green-100 p-16 max-w-2xl mx-auto">
                    <div class="w-32 h-32 bg-gradient-to-br from-green-200 to-green-300 rounded-full flex items-center justify-center mx-auto mb-8">
                        <svg class="w-16 h-16 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-green-950 mb-4">No Reviews Yet</h3>
                    <p class="text-xl text-green-700 mb-8">You haven't written any reviews yet. Purchase products and share your experience!</p>
                    <a href="{{ route('products.index') }}" 
                       class="inline-block px-12 py-4 bg-gradient-to-r from-green-600 to-green-700 text-white font-bold rounded-2xl hover:from-green-700 hover:to-green-800 transition-all duration-300 transform hover:scale-105 shadow-lg text-lg">
                        Shop Now
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection