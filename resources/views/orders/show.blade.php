@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-yellow-50 via-amber-50 to-yellow-100">
    <div class="container mx-auto px-6 py-12">
         <!-- Header  -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-black text-green-950 mb-4">Order Details</h1>
            <p class="text-xl text-green-800">Order #{{ $order->id }}</p>
            <div class="w-32 h-1 bg-gradient-to-r from-green-600 to-green-800 mx-auto mt-4 rounded-full"></div>
        </div>

        <div class="max-w-6xl mx-auto">
             <!-- Order Status  -->
            <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border-2 border-green-100 overflow-hidden mb-8">
                <div class="bg-gradient-to-r from-green-950 to-green-900 p-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h2 class="text-3xl font-bold text-yellow-50 mb-2">Order #{{ $order->id }}</h2>
                            <p class="text-yellow-200">Placed on {{ $order->created_at->format('F d, Y \a\t g:i A') }}</p>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <span class="px-6 py-3 rounded-full text-lg font-bold
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
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                 <!-- Order Items  -->
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border-2 border-green-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-900 to-green-950 p-6">
                        <h3 class="text-2xl font-bold text-yellow-50">Order Items</h3>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-6">
                            @foreach($order->items as $item)
                            <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-yellow-50 to-amber-50 rounded-2xl border border-green-200">
                                <div class="w-20 h-20 bg-gradient-to-br from-green-200 to-green-300 rounded-xl flex items-center justify-center flex-shrink-0">
                                    @if($item->product->primary_image)
                                        <img src="{{ asset('storage/' . $item->product->primary_image) }}" 
                                             alt="{{ $item->product->name }}" 
                                             class="w-full h-full object-cover rounded-xl">
                                    @else
                                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    @endif
                                </div>
                                
                                <div class="flex-1">
                                    <h4 class="font-bold text-green-950 mb-1">{{ $item->product->name }}</h4>
                                    <p class="text-green-700 mb-2">Quantity: {{ $item->quantity }}</p>
                                    <p class="text-green-700 mb-2">Price: ${{ number_format($item->price, 2) }}</p>
                                    <p class="text-xl font-bold text-green-800">Total: ${{ number_format($item->total, 2) }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                 <!-- Order Summary & Shipping  -->
                <div class="space-y-8">
                     <!-- Order Summary  -->
                    <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border-2 border-green-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-green-900 to-green-950 p-6">
                            <h3 class="text-2xl font-bold text-yellow-50">Order Summary</h3>
                        </div>
                        
                        <div class="p-6">
                            <div class="space-y-3">
                                <div class="flex justify-between text-green-800">
                                    <span class="font-semibold">Subtotal:</span>
                                    <span class="font-bold">${{ number_format($order->subtotal, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-green-800">
                                    <span class="font-semibold">Shipping:</span>
                                    <span class="font-bold">${{ number_format($order->shipping_cost, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-green-800">
                                    <span class="font-semibold">Tax:</span>
                                    <span class="font-bold">${{ number_format($order->tax_amount, 2) }}</span>
                                </div>
                                <div class="border-t-2 border-green-300 pt-3">
                                    <div class="flex justify-between text-green-950">
                                        <span class="text-xl font-black">Total:</span>
                                        <span class="text-2xl font-black">${{ number_format($order->total_amount, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                     <!-- Shipping Information  -->
                    <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border-2 border-green-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-green-900 to-green-950 p-6">
                            <h3 class="text-2xl font-bold text-yellow-50">Shipping Information</h3>
                        </div>
                        
                        <div class="p-6 space-y-4">
                            <div>
                                <h4 class="font-bold text-green-950 mb-2">Phone Number</h4>
                                <p class="text-green-800">{{ $order->phone }}</p>
                            </div>
                            
                            <div>
                                <h4 class="font-bold text-green-950 mb-2">Shipping Address</h4>
                                <p class="text-green-800">{{ $order->shipping_address }}</p>
                            </div>
                            
                            <div>
                                <h4 class="font-bold text-green-950 mb-2">Billing Address</h4>
                                <p class="text-green-800">{{ $order->billing_address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <!-- Action Buttons  -->
            <div class="mt-12 text-center">
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('user.orders.index') }}" 
                       class="px-8 py-4 bg-gradient-to-r from-gray-600 to-gray-700 text-white font-bold rounded-2xl hover:from-gray-700 hover:to-gray-800 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Back to Orders
                    </a>
                    
                    @if($order->status !== 'delivered' && $order->status !== 'cancelled')
                    <a href="{{ route('user.orders.track', $order) }}" 
                       class="px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-2xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Track Order
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection