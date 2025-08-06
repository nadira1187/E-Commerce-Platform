@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-100 px-4 md:px-8 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center mb-8 gap-4">
        <a href="{{ route('home') }}" class="flex items-center text-green-800 hover:text-green-700 font-semibold transition-all duration-300 group">
            <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Continue Shopping
        </a>
        <h1 class="text-4xl font-bold bg-gradient-to-r from-green-800 to-green-900 bg-clip-text text-transparent">Shopping Cart</h1>
    </div>

    @if($cartItems->count() > 0)
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="backdrop-blur-sm bg-white/90 rounded-2xl shadow-2xl border-0 p-8 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/50 to-amber-50/50 pointer-events-none"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-8">
                            <h2 class="text-2xl font-bold text-gray-900">Cart Items</h2>
                            <span class="bg-green-800 text-white px-4 py-2 rounded-full text-sm font-semibold">
                                {{ $cartItems->count() }} {{ $cartItems->count() == 1 ? 'item' : 'items' }}
                            </span>
                        </div>
                        
                        <div class="space-y-6" id="cart-items">
                            @foreach($cartItems as $item)
                                <div class="cart-item flex flex-col sm:flex-row sm:items-center gap-6 p-6 border-2 border-gray-100 rounded-xl hover:border-green-200 transition-all duration-300 bg-white/70" data-item-id="{{ $item->id }}">
                                    <!-- Product Image -->
                                    <div class="flex-shrink-0">
                                        <img src="{{ $item->product->images }}" 
                                             alt="{{ $item->product->name }}" 
                                             class="w-24 h-24 object-cover rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
                                    </div>
                                    
                                    <!-- Product Details -->
                                    <div class="flex-1 space-y-3">
                                        <h3 class="font-bold text-xl text-gray-900 leading-tight">{{ $item->product->name }}</h3>
                                        
                                        <!-- Product Attributes -->
                                        <div class="flex flex-wrap items-center gap-2">
                                            @if($item->size)
                                                <span class="px-3 py-1 bg-gradient-to-r from-green-100 to-green-200 text-green-800 rounded-full text-sm font-medium">
                                                    Size: {{ $item->size }}
                                                </span>
                                            @endif
                                            @if($item->color)
                                                <span class="px-3 py-1 bg-gradient-to-r from-amber-100 to-amber-200 text-amber-800 rounded-full text-sm font-medium">
                                                    Color: {{ $item->color }}
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <!-- Price -->
                                        <div class="flex items-center space-x-3">
                                            <span class="text-2xl font-bold text-green-800">${{ $item->product->price }}</span>
                                            @if($item->product->original_price && $item->product->original_price > $item->product->price)
                                                <span class="text-lg text-gray-500 line-through">${{ $item->product->original_price }}</span>
                                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-semibold">
                                                    {{ round((($item->product->original_price - $item->product->price) / $item->product->original_price) * 100) }}% OFF
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Quantity Controls -->
                                    <div class="flex items-center justify-center gap-4">
                                        <div class="flex items-center bg-gray-100 rounded-xl p-1">
                                            <button onclick="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})" 
                                                    class="quantity-btn p-2 hover:bg-white rounded-lg transition-all duration-300 {{ $item->quantity <= 1 ? 'opacity-50 cursor-not-allowed' : 'hover:text-green-800' }}"
                                                    {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                                </svg>
                                            </button>
                                            <span class="quantity-display px-4 py-2 font-bold text-lg min-w-[3rem] text-center">{{ $item->quantity }}</span>
                                            <button onclick="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})" 
                                                    class="quantity-btn p-2 hover:bg-white hover:text-green-800 rounded-lg transition-all duration-300">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Item Total & Remove -->
                                    <div class="text-right space-y-3">
                                        <div class="item-total font-bold text-2xl text-green-800">
                                            ${{ number_format($item->product->price * $item->quantity, 2) }}
                                        </div>
                                        <button onclick="removeItem({{ $item->id }})" 
                                                class="remove-btn flex items-center text-red-600 hover:text-red-800 hover:bg-red-50 px-3 py-2 rounded-lg transition-all duration-300 group">
                                            <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="backdrop-blur-sm bg-white/90 rounded-2xl shadow-2xl border-0 p-8 sticky top-8 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/50 to-amber-50/50 pointer-events-none"></div>
                    
                    <div class="relative z-10">
                        <h2 class="text-2xl font-bold text-gray-900 mb-8">Order Summary</h2>
                        
                        <!-- Promo Code -->
                        <div class="mb-8">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Promo Code</label>
                            <div class="flex space-x-2">
                                <input type="text" 
                                       id="promo-code" 
                                       placeholder="Enter code" 
                                       class="flex-1 px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-800 focus:ring-2 focus:ring-green-800/20 transition-all duration-300 bg-white/70">
                                <button onclick="applyPromoCode()" 
                                        class="px-6 py-3 border-2 border-gray-200 rounded-xl hover:border-green-800 hover:bg-green-50 transition-all duration-300 font-semibold">
                                    Apply
                                </button>
                            </div>
                            <div id="promo-message" class="mt-2 text-sm hidden"></div>
                        </div>
                        
                        <!-- Order Totals -->
                        <div class="border-t-2 border-gray-100 pt-6 space-y-4">
                            <div class="flex justify-between text-lg">
                                <span class="font-medium">Subtotal</span>
                                <span id="subtotal" class="font-semibold">${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-lg">
                                <span class="font-medium">Shipping</span>
                                <span id="shipping" class="font-semibold">{{ $shipping == 0 ? 'Free' : '$' . number_format($shipping, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-lg">
                                <span class="font-medium">Tax</span>
                                <span id="tax" class="font-semibold">${{ number_format($tax, 2) }}</span>
                            </div>
                            <div id="discount-row" class="flex justify-between text-lg text-green-600 hidden">
                                <span class="font-medium">Discount</span>
                                <span id="discount" class="font-semibold">-$0.00</span>
                            </div>
                            <div class="border-t-2 border-gray-200 pt-4 flex justify-between text-2xl font-bold text-green-800">
                                <span>Total</span>
                                <span id="total">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                        
                        <!-- Free Shipping Notice -->
                        @if($shipping > 0)
                            <div class="mt-6 text-sm bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 p-4 rounded-xl">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-blue-800 font-medium">
                                        Add ${{ number_format(100 - $subtotal, 2) }} more to get free shipping!
                                    </span>
                                </div>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="mt-8 space-y-4">
                            <button onclick="proceedToCheckout()"
                                    class="w-full bg-gradient-to-r from-green-800 to-green-900 hover:from-green-700 hover:to-green-800 text-white py-4 rounded-xl font-semibold text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02]">
                                Proceed to Checkout
                            </button>
                            <button onclick="saveForLater()"
                                    class="w-full border-2 border-gray-200 hover:border-green-800 hover:bg-green-50 py-4 rounded-xl font-semibold text-lg transition-all duration-300">
                                Save for Later
                            </button>
                        </div>

                        <!-- Security Notice -->
                        <div class="mt-8 text-center">
                            <div class="flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-semibold text-green-800">Secure Checkout</span>
                            </div>
                            <p class="text-sm text-gray-600">Your payment information is encrypted and secure</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Cart -->
        <div class="text-center py-20">
            <div class="backdrop-blur-sm bg-white/90 rounded-2xl shadow-2xl border-0 p-12 max-w-md mx-auto relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-white/50 to-amber-50/50 pointer-events-none"></div>
                
                <div class="relative z-10">
                    <svg class="w-32 h-32 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9m-9 0V19a2 2 0 002 2h7a2 2 0 002-2v-4"/>
                    </svg>
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Your cart is empty</h2>
                    <p class="text-gray-600 mb-8 text-lg">Looks like you haven't added anything to your cart yet.</p>
                    <a href="{{ route('home') }}" 
                       class="inline-block bg-gradient-to-r from-green-800 to-green-900 hover:from-green-700 hover:to-green-800 text-white px-8 py-4 rounded-xl font-semibold text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Loading Overlay -->
<div id="loading-overlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl p-8 text-center">
        <div class="animate-spin w-12 h-12 border-4 border-green-800 border-t-transparent rounded-full mx-auto mb-4"></div>
        <p class="text-lg font-semibold text-gray-900">Updating cart...</p>
    </div>
</div>

<script>
// CSRF Token for Laravel
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Show loading overlay
function showLoading() {
    document.getElementById('loading-overlay').classList.remove('hidden');
    document.getElementById('loading-overlay').classList.add('flex');
}

// Hide loading overlay
function hideLoading() {
    document.getElementById('loading-overlay').classList.add('hidden');
    document.getElementById('loading-overlay').classList.remove('flex');
}

// Update quantity function
async function updateQuantity(itemId, newQuantity) {
    if (newQuantity < 1) {
        removeItem(itemId);
        return;
    }

    showLoading();

    try {
        const response = await fetch(`/cart/update/${itemId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                quantity: newQuantity
            })
        });

        const data = await response.json();

        if (data.success) {
            // Update the quantity display
            const cartItem = document.querySelector(`[data-item-id="${itemId}"]`);
            const quantityDisplay = cartItem.querySelector('.quantity-display');
            const itemTotal = cartItem.querySelector('.item-total');
            
            quantityDisplay.textContent = newQuantity;
            itemTotal.textContent = `$${data.item_total}`;

            // Update minus button state
            const minusBtn = cartItem.querySelector('.quantity-btn:first-child');
            if (newQuantity <= 1) {
                minusBtn.classList.add('opacity-50', 'cursor-not-allowed');
                minusBtn.disabled = true;
            } else {
                minusBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                minusBtn.disabled = false;
            }

            // Update order summary
            updateOrderSummary(data.cart_summary);

            // Show success message
            showNotification('Cart updated successfully!', 'success');
        } else {
            showNotification(data.message || 'Failed to update cart', 'error');
        }
    } catch (error) {
        console.error('Error updating quantity:', error);
        showNotification('An error occurred while updating the cart', 'error');
    } finally {
        hideLoading();
    }
}

// Remove item function
async function removeItem(itemId) {
    if (!confirm('Are you sure you want to remove this item from your cart?')) {
        return;
    }

    showLoading();

    try {
        const response = await fetch(`/cart/remove/${itemId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        });

        const data = await response.json();

        if (data.success) {
            // Remove the item from DOM with animation
            const cartItem = document.querySelector(`[data-item-id="${itemId}"]`);
            cartItem.style.transform = 'translateX(-100%)';
            cartItem.style.opacity = '0';
            
            setTimeout(() => {
                cartItem.remove();
                
                // Check if cart is empty
                const remainingItems = document.querySelectorAll('.cart-item');
                if (remainingItems.length === 0) {
                    location.reload(); // Reload to show empty cart state
                } else {
                    // Update order summary
                    updateOrderSummary(data.cart_summary);
                    
                    // Update cart count
                    const cartCount = document.querySelector('.bg-green-800.text-white');
                    if (cartCount) {
                        const newCount = remainingItems.length;
                        cartCount.textContent = `${newCount} ${newCount === 1 ? 'item' : 'items'}`;
                    }
                }
            }, 300);

            showNotification('Item removed from cart', 'success');
        } else {
            showNotification(data.message || 'Failed to remove item', 'error');
        }
    } catch (error) {
        console.error('Error removing item:', error);
        showNotification('An error occurred while removing the item', 'error');
    } finally {
        hideLoading();
    }
}

// Update order summary
function updateOrderSummary(summary) {
    document.getElementById('subtotal').textContent = `$${summary.subtotal}`;
    document.getElementById('shipping').textContent = summary.shipping === '0.00' ? 'Free' : `$${summary.shipping}`;
    document.getElementById('tax').textContent = `$${summary.tax}`;
    document.getElementById('total').textContent = `$${summary.total}`;
}

// Apply promo code function
async function applyPromoCode() {
    const promoCode = document.getElementById('promo-code').value.trim();
    const messageDiv = document.getElementById('promo-message');
    
    if (!promoCode) {
        showNotification('Please enter a promo code', 'error');
        return;
    }

    showLoading();

    try {
        const response = await fetch('/cart/apply-promo', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                promo_code: promoCode
            })
        });

        const data = await response.json();

        if (data.success) {
            // Show discount row
            const discountRow = document.getElementById('discount-row');
            const discountAmount = document.getElementById('discount');
            
            discountRow.classList.remove('hidden');
            discountAmount.textContent = `-$${data.discount_amount}`;
            
            // Update totals
            updateOrderSummary(data.cart_summary);
            
            // Show success message
            messageDiv.textContent = data.message;
            messageDiv.className = 'mt-2 text-sm text-green-600';
            messageDiv.classList.remove('hidden');
            
            showNotification('Promo code applied successfully!', 'success');
        } else {
            messageDiv.textContent = data.message;
            messageDiv.className = 'mt-2 text-sm text-red-600';
            messageDiv.classList.remove('hidden');
            
            showNotification(data.message, 'error');
        }
    } catch (error) {
        console.error('Error applying promo code:', error);
        showNotification('An error occurred while applying the promo code', 'error');
    } finally {
        hideLoading();
    }
}

// Proceed to checkout
function proceedToCheckout() {
    showLoading();
    // Redirect to checkout page
    window.location.href = '/checkout';
}

// Save for later
async function saveForLater() {
    showLoading();
    
    try {
        const response = await fetch('/cart/save-for-later', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        });

        const data = await response.json();

        if (data.success) {
            showNotification('Cart saved for later!', 'success');
        } else {
            showNotification(data.message || 'Failed to save cart', 'error');
        }
    } catch (error) {
        console.error('Error saving cart:', error);
        showNotification('An error occurred while saving the cart', 'error');
    } finally {
        hideLoading();
    }
}

// Show notification
function showNotification(message, type = 'info') {
    // Remove existing notifications
    const existingNotifications = document.querySelectorAll('.notification');
    existingNotifications.forEach(notification => notification.remove());

    // Create notification
    const notification = document.createElement('div');
    notification.className = `notification fixed top-4 right-4 z-50 px-6 py-4 rounded-xl shadow-lg transform transition-all duration-300 translate-x-full`;
    
    if (type === 'success') {
        notification.classList.add('bg-green-100', 'border', 'border-green-200', 'text-green-800');
    } else if (type === 'error') {
        notification.classList.add('bg-red-100', 'border', 'border-red-200', 'text-red-800');
    } else {
        notification.classList.add('bg-blue-100', 'border', 'border-blue-200', 'text-blue-800');
    }

    notification.innerHTML = `
        <div class="flex items-center">
            <span class="font-medium">${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-current hover:opacity-70">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    `;

    document.body.appendChild(notification);

    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);

    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => notification.remove(), 300);
    }, 5000);
}

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth transitions to all cart items
    const cartItems = document.querySelectorAll('.cart-item');
    cartItems.forEach(item => {
        item.style.transition = 'all 0.3s ease';
    });
});
</script>
@endsection
