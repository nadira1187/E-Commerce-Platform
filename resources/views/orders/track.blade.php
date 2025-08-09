@extends('layouts.app')

@section('title', 'Track Order')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-yellow-50 via-amber-50 to-yellow-100">
    <div class="container mx-auto px-6 py-12">
         Header 
        <div class="text-center mb-12">
            <h1 class="text-5xl font-black text-green-950 mb-4">Track Your Order</h1>
            <p class="text-xl text-green-800">Order #{{ $order->id }}</p>
            <div class="w-32 h-1 bg-gradient-to-r from-green-600 to-green-800 mx-auto mt-4 rounded-full"></div>
        </div>

        <div class="max-w-4xl mx-auto">
             Order Status Timeline 
            <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border-2 border-green-100 overflow-hidden">
                <div class="bg-gradient-to-r from-green-950 to-green-900 p-8">
                    <h2 class="text-3xl font-bold text-yellow-50 mb-2">Order Status</h2>
                    <p class="text-yellow-200">Current status: {{ ucfirst($order->status) }}</p>
                </div>
                
                <div class="p-8">
                     Simple Status Display 
                    <div class="space-y-6">
                        @php
                            $statuses = [
                                'pending' => 'Order Placed',
                                'processing' => 'Processing',
                                'shipped' => 'Shipped',
                                'delivered' => 'Delivered'
                            ];
                            $currentStatusIndex = array_search($order->status, array_keys($statuses));
                        @endphp

                        @foreach($statuses as $status => $label)
                        <div class="flex items-center space-x-4">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center
                                @if(array_search($status, array_keys($statuses)) <= $currentStatusIndex)
                                    bg-green-500 text-white
                                @else
                                    bg-gray-300 text-gray-600
                                @endif">
                                @if(array_search($status, array_keys($statuses)) <= $currentStatusIndex)
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                @else
                                    {{ array_search($status, array_keys($statuses)) + 1 }}
                                @endif
                            </div>
                            
                            <div class="flex-1">
                                <h3 class="text-lg font-bold 
                                    @if(array_search($status, array_keys($statuses)) <= $currentStatusIndex)
                                        text-green-950
                                    @else
                                        text-gray-500
                                    @endif">
                                    {{ $label }}
                                </h3>
                                @if($status === $order->status)
                                    <p class="text-green-700">{{ $order->updated_at->format('F d, Y \a\t g:i A') }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>

                     Order Information 
                    <div class="mt-8 pt-8 border-t border-green-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-xl font-bold text-green-950 mb-4">Order Information</h3>
                                <div class="space-y-2">
                                    <p class="text-green-800"><span class="font-semibold">Order Date:</span> {{ $order->created_at->format('F d, Y') }}</p>
                                    <p class="text-green-800"><span class="font-semibold">Total Amount:</span> ${{ number_format($order->total_amount, 2) }}</p>
                                    <p class="text-green-800"><span class="font-semibold">Payment Status:</span> {{ ucfirst($order->payment_status) }}</p>
                                </div>
                            </div>
                            
                            <div>
                                <h3 class="text-xl font-bold text-green-950 mb-4">Shipping Address</h3>
                                <p class="text-green-800">{{ $order->shipping_address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             Action Buttons 
            <div class="mt-8 text-center">
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('orders.show', $order) }}" 
                       class="px-8 py-4 bg-gradient-to-r from-green-600 to-green-700 text-white font-bold rounded-2xl hover:from-green-700 hover:to-green-800 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        View Order Details
                    </a>
                    
                    <a href="{{ route('orders.index') }}" 
                       class="px-8 py-4 bg-gradient-to-r from-gray-600 to-gray-700 text-white font-bold rounded-2xl hover:from-gray-700 hover:to-gray-800 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Back to Orders
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection