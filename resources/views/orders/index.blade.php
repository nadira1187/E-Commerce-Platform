@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-yellow-50 via-amber-50 to-yellow-100">
    <div class="container mx-auto px-6 py-12">
         <!-- Header  -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-black text-green-950 mb-4">My Orders</h1>
            <p class="text-xl text-green-800">Track and manage your orders</p>
            <div class="w-32 h-1 bg-gradient-to-r from-green-600 to-green-800 mx-auto mt-4 rounded-full"></div>
        </div>

        <div class="max-w-6xl mx-auto">
            @if($orders->count() > 0)
                <div class="space-y-8">
                    @foreach($orders as $order)
                    <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border-2 border-green-100 overflow-hidden">
                         <!-- Order Header  -->
                        <div class="bg-gradient-to-r from-green-950 to-green-900 p-6">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                <div>
                                    <h2 class="text-2xl font-bold text-yellow-50 mb-2">Order #{{ $order->id }}</h2>
                                    <p class="text-yellow-200">Placed on {{ $order->created_at->format('F d, Y') }}</p>
                                </div>
                                <div class="mt-4 md:mt-0">
                                    <span class="px-4 py-2 rounded-full text-sm font-bold
                                        @if($order->status === 'pending') bg-yellow-500 text-yellow-900
                                        @elseif($order->status === 'processing') bg-blue-500 text-white
                                        @elseif($order->status === 'shipped') bg-purple-500 text-white
                                        @elseif($order->status === 'delivered') bg-green-500 text-white
                                        @else bg-red-500 text-white
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                         <!-- Order Content  -->
                        <div class="p-6">
                             <!-- Order Items  -->
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                                @foreach($order->items as $item)
                                <div class="bg-gradient-to-r from-yellow-50 to-amber-50 p-4 rounded-2xl border border-green-200">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-16 h-16 bg-gradient-to-br from-green-200 to-green-300 rounded-xl flex items-center justify-center flex-shrink-0">
                                            @if($item->product->primary_image)
                                                <img src="{{ asset('storage/' . $item->product->primary_image) }}" 
                                                     alt="{{ $item->product->name }}" 
                                                     class="w-full h-full object-cover rounded-xl">
                                            @else
                                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="font-bold text-green-950 text-sm">{{ $item->product->name }}</h3>
                                            <p class="text-green-700 text-sm">Qty: {{ $item->quantity }}</p>
                                            <p class="text-lg font-bold text-green-800">${{ number_format($item->total, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                             <!-- Order Summary  -->
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between bg-gradient-to-r from-green-50 to-emerald-50 p-4 rounded-2xl border border-green-200">
                                <div class="mb-4 md:mb-0">
                                    <p class="text-green-800 font-semibold">Total Amount</p>
                                    <p class="text-2xl font-black text-green-950">${{ number_format($order->total_amount, 2) }}</p>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row gap-3">
                                    <a href="{{ route('orders.show', $order) }}" 
                                       class="px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white font-bold rounded-xl hover:from-green-700 hover:to-green-800 transition-all duration-300 text-center">
                                        View Details
                                    </a>
                                    
                                    @if($order->status !== 'delivered' && $order->status !== 'cancelled')
                                    <a href="{{ route('orders.track', $order) }}" 
                                       class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 text-center">
                                        Track Order
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                 <!-- Pagination  -->
                <div class="mt-12">
                    {{ $orders->links() }}
                </div>
            @else
                 <!-- Empty State  -->
                <div class="text-center py-16">
                    <div class="w-32 h-32 bg-gradient-to-br from-green-200 to-green-300 rounded-full flex items-center justify-center mx-auto mb-8">
                        <svg class="w-16 h-16 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-green-950 mb-4">No Orders Yet</h2>
                    <p class="text-xl text-green-800 mb-8">You haven't placed any orders yet. Start shopping to see your orders here!</p>
                    <a href="{{ route('products.index') }}" 
                       class="px-8 py-4 bg-gradient-to-r from-green-600 to-green-700 text-white font-bold rounded-2xl hover:from-green-700 hover:to-green-800 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection