@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center mb-8">
        <a href="{{ route('home') }}" class="flex items-center text-purple-600 hover:text-purple-800 mr-4">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Continue Shopping
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Shopping Cart</h1>
    </div>

    @if($cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-6">Cart Items ({{ $cartItems->count() }})</h2>
                    
                    <div class="space-y-6">
                        @foreach($cartItems as $item)
                            <div class="flex items-center space-x-4 p-4 border rounded-lg">
                                <img src="{{ $item->product->images[0] ?? 'https://via.placeholder.com/80x80' }}" 
                                     alt="{{ $item->product->name }}" 
                                     class="w-20 h-20 object-cover rounded-md">
                                
                                <div class="flex-1">
                                    <h3 class="font-semibold text-lg">{{ $item->product->name }}</h3>
                                    <div class="flex items-center space-x-4 mt-2">
                                        @if($item->size)
                                            <span class="px-2 py-1 bg-gray-100 text-gray-700 text-sm rounded">Size: {{ $item->size }}</span>
                                        @endif
                                        @if($item->color)
                                            <span class="px-2 py-1 bg-gray-100 text-gray-700 text-sm rounded">Color: {{ $item->color }}</span>
                                        @endif
                                    </div>
                                    <div class="flex items-center space-x-2 mt-2">
                                        <span class="text-lg font-bold">${{ $item->product->price }}</span>
                                        @if($item->product->original_price && $item->product->original_price > $item->product->price)
                                            <span class="text-sm text-gray-500 line-through">${{ $item->product->original_price }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-2">
                                    <button onclick="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})" 
                                            class="p-1 border rounded hover:bg-gray-50">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                        </svg>
                                    </button>
                                    <span class="w-8 text-center">{{ $item->quantity }}</span>
                                    <button onclick="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})" 
                                            class="p-1 border rounded hover:bg-gray-50">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </button>
                                </div>
                                
                                <div class="text-right">
                                    <div class="font-bold text-lg">${{ number_format($item->product->price * $item->quantity, 2) }}</div>
                                    <button onclick="removeItem({{ $item->id }})" 
                                            class="text-red-600 hover:text-red-800 text-sm mt-1">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Remove
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-8">
                    <h2 class="text-xl font-semibold mb-6">Order Summary</h2>
                    
                    <!-- Promo Code -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Promo Code</label>
                        <div class="flex space-x-2">
                            <input type="text" 
                                   id="promo-code"
                                   placeholder="Enter code" 
                                   class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            <button onclick="applyPromoCode()" 
                                    class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                                Apply
                            </button>
                        </div>
                    </div>

                    <div class="border-t pt-4 space-y-2">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Shipping</span>
                            <span>{{ $shipping == 0 ? 'Free' : '$' . number_format($shipping, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Tax</span>
                            <span>${{ number_format($tax, 2) }}</span>
                        </div>
                        <div class="border-t pt-2 flex justify-between text-lg font-bold">
                            <span>Total</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    @if($shipping > 0)
                        <div class="mt-4 text-sm text-gray-600 bg-blue-50 p-3 rounded-lg">
                            💡 Add ${{ number_format(100 - $subtotal, 2) }} more to get free shipping!
                        </div>
                    @endif

                    <div class="mt-6 space-y-2">
                        <button onclick="proceedToCheckout()" 
                                class="w-full bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700 transition duration-300">
                            Proceed to Checkout
                        </button>
                        <button class="w-full border border-gray-300 py-3 rounded-lg hover:bg-gray-50 transition duration-300">
                            Save for Later
                        </button>
                    </div>

                    <!-- Security Notice -->
                    <div class="mt-6 text-center text-sm text-gray-600">
                        <div class="flex items-center justify-center mb-2">
                            <svg class="w-4 h-4 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                            </svg>
                            Secure Checkout
                        </div>
                        <p>Your payment information is encrypted and secure</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-16">
            <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9m-9 0V19a2 2 0 002 2h7a2 2 0 002-2v-4"></path>
            </svg>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h2>
            <p class="text-gray-600 mb-8">Looks like you haven't added anything to your cart yet.</p>
            <a href="{{ route('home') }}" 
               class="bg-purple-600 text-white px-8 py-3 rounded-lg hover:bg-purple-700 transition duration-300">
                Continue Shopping
            </a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    function updateQuantity(itemId, newQuantity) {
        if (newQuantity < 1) {
            removeItem(itemId);
            return;
        }

        fetch(`/cart/${itemId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                quantity: newQuantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function removeItem(itemId) {
        if (confirm('Are you sure you want to remove this item?')) {
            fetch(`/cart/${itemId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }

    function applyPromoCode() {
        const code = document.getElementById('promo-code').value;
        // Implement promo code logic
        alert('Promo code functionality will be implemented with payment integration');
    }

    function proceedToCheckout() {
        // Redirect to checkout page (to be implemented)
        alert('Checkout functionality will be implemented with payment gateway integration');
    }
</script>
@endpush
