@extends('layouts.admin')

@section('title', 'Reviews Management')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
    <div class="container mx-auto px-6 py-8">
         Header 
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Reviews Management</h1>
            <p class="text-gray-600">Monitor and manage customer reviews</p>
        </div>

         Reviews Grid 
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @foreach($reviews as $review)
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-shadow">
                 Review Header 
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-purple-400 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold">
                            {{ substr($review->user->name, 0, 1) }}
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $review->user->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $review->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    
                     Rating Stars 
                    <div class="flex items-center">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                        @endfor
                        <span class="ml-2 text-sm font-medium text-gray-600">{{ $review->rating }}/5</span>
                    </div>
                </div>

                 Product Info 
                <div class="flex items-center mb-4 p-3 bg-gray-50 rounded-xl">
                    @if($review->product->images->count() > 0)
                        <img src="{{ Storage::url($review->product->images->first()->image_path) }}" alt="{{ $review->product->name }}" class="w-12 h-12 object-cover rounded-lg">
                    @else
                        <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    <div class="ml-3">
                        <h4 class="font-medium text-gray-800">{{ $review->product->name }}</h4>
                        <p class="text-sm text-gray-500">${{ number_format($review->product->price, 2) }}</p>
                    </div>
                </div>

                 Review Content 
                <div class="mb-4">
                    <p class="text-gray-700 leading-relaxed">{{ $review->comment }}</p>
                </div>

                 Actions 
                <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 text-xs font-medium rounded-full 
                            @if($review->is_approved) bg-green-100 text-green-800 @else bg-yellow-100 text-yellow-800 @endif">
                            @if($review->is_approved) Approved @else Pending @endif
                        </span>
                    </div>
                    
                    <div class="flex space-x-2">
                        @if(!$review->is_approved)
                        <form action="{{ route('admin.reviews.approve', $review) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-green-50 text-green-600 px-3 py-1 rounded-lg hover:bg-green-100 transition-colors text-sm">
                                Approve
                            </button>
                        </form>
                        @endif
                        
                        <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-50 text-red-600 px-3 py-1 rounded-lg hover:bg-red-100 transition-colors text-sm">
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
            {{ $reviews->links() }}
        </div>
    </div>
</div>
@endsection