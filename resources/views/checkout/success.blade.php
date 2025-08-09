@extends('layouts.app')

@section('title', 'Order Successful')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-yellow-50 via-amber-50 to-yellow-100 flex items-center justify-center">
    <div class="container mx-auto px-6 py-12">
        <div class="max-w-4xl mx-auto text-center">
             <!-- Success Animation  -->
            <div class="mb-12">
                <div class="w-32 h-32 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-8 shadow-2xl animate-bounce">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                
                <h1 class="text-6xl font-black text-green-950 mb-6">Order Successful!</h1>
                <p class="text-2xl text-green-800 mb-8">Thank you for your purchase. Your order has been confirmed!</p>
                <div class="w-32 h-1 bg-gradient-to-r from-green-600 to-green-800 mx-auto rounded-full"></div>
            </div>

             <!-- Order Details  -->
            <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border-2 border-green-100 overflow-hidden mb-12">
                <div class="bg-gradient-to-r from-green-950 to-green-900 p-8">
                    <h2 class="text-3xl font-bold text-yellow-50 mb-2">Order Details</h2>
                    <p class="text-yellow-200">Order #{{ $order->id }} - {{ $order->created_at->format('F d, Y') }}</p>
                </div>
                
                <div class="p-8">
                     <!-- Order Items  -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        @foreach($order->items as $item)
                        <div class="bg-gradient-to-r from-yellow-50 to-amber-50 p-6 rounded-2xl border border-green-200">
                           @php
    $images = json_decode($item->product->images, true); // decode JSON string to array
@endphp

@if(is_array($images) && count($images) > 0)
    <img src="{{ Storage::url($images[0]['image_path']) }}" 
         alt="{{ $item->product->name }}" 
         class="w-full h-32 object-cover rounded-xl mb-4 shadow-lg">
@else
    <div class="w-full h-32 bg-gradient-to-br from-green-200 to-green-300 rounded-xl flex items-center justify-center mb-4 shadow-lg">
        <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
    </div>
@endif

                            
                            <h3 class="font-bold text-green-950 mb-2">{{ $item->product->name }}</h3>
                            <p class="text-green-700 mb-2">Quantity: {{ $item->quantity }}</p>
                            <p class="text-xl font-bold text-green-800">${{ number_format($item->total, 2) }}</p>
                        </div>
                        @endforeach
                    </div>

                     <!-- Order Summary  -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-8 rounded-2xl border-2 border-green-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <h3 class="text-2xl font-bold text-green-950 mb-4">Shipping Address</h3>
                                <div class="bg-white p-4 rounded-xl border border-green-200">
                                    <p class="text-green-800 font-semibold">{{ $order->shipping_address }}</p>
                                </div>
                            </div>
                            
                            <div>
                                <h3 class="text-2xl font-bold text-green-950 mb-4">Order Total</h3>
                                <div class="space-y-2">
                                    <div class="flex justify-between text-green-800">
                                        <span>Subtotal:</span>
                                        <span class="font-bold">${{ number_format($order->subtotal, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between text-green-800">
                                        <span>Shipping:</span>
                                        <span class="font-bold">${{ number_format($order->shipping_cost, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between text-green-800">
                                        <span>Tax:</span>
                                        <span class="font-bold">${{ number_format($order->tax_amount, 2) }}</span>
                                    </div>
                                    <div class="border-t-2 border-green-300 pt-2">
                                        <div class="flex justify-between text-green-950">
                                            <span class="text-xl font-black">Total:</span>
                                            <span class="text-2xl font-black">${{ number_format($order->total_amount, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <!-- Action Buttons  -->
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="{{ route('orders.index', $order) }}" 
                   class="px-12 py-4 bg-gradient-to-r from-green-600 to-green-700 text-white font-bold rounded-2xl hover:from-green-700 hover:to-green-800 transition-all duration-300 transform hover:scale-105 shadow-lg text-lg">
                    View Order Details
                </a>
                
                <a href="{{ route('products.index') }}" 
                   class="px-12 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-2xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 transform hover:scale-105 shadow-lg text-lg">
                    Continue Shopping
                </a>
            </div>

             <!-- Email Confirmation Notice  -->
            <div class="mt-12 p-6 bg-gradient-to-r from-amber-50 to-yellow-100 rounded-2xl border-2 border-amber-200">
                <div class="flex items-center justify-center text-amber-800">
                    <svg class="w-8 h-8 mr-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-lg font-semibold">A confirmation email has been sent to {{ Auth::user()->email }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection