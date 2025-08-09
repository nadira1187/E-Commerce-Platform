@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-yellow-50 via-amber-50 to-yellow-100">
    <div class="container mx-auto px-6 py-12">
         <!-- Header  -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-black text-green-950 mb-4">Secure Checkout</h1>
            <p class="text-xl text-green-800">Complete your purchase safely and securely</p>
            <div class="w-32 h-1 bg-gradient-to-r from-green-600 to-green-800 mx-auto mt-6 rounded-full"></div>
        </div>

        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                 <!-- Order Summary  -->
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border-2 border-green-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-950 to-green-900 p-8">
                        <h2 class="text-3xl font-bold text-yellow-50 mb-2">Order Summary</h2>
                        <p class="text-yellow-200">Review your items before payment</p>
                    </div>
                    
                    <div class="p-8">
                         <!-- Cart Items  -->
                        <div class="space-y-6 mb-8">
                            @foreach($cartItems as $item)
                            <div class="flex items-center space-x-4 p-6 bg-gradient-to-r from-yellow-50 to-amber-50 rounded-2xl border border-green-200">
                                <div class="w-20 h-20 bg-gradient-to-br from-green-200 to-green-300 rounded-2xl flex items-center justify-center shadow-lg">
                                    @if($item->product->primary_image)
                                        <img src="{{ asset('storage/' . $item->product->primary_image) }}" 
                                             alt="{{ $item->product->name }}" 
                                             class="w-full h-full object-cover rounded-2xl">
                                    @else
                                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    @endif
                                </div>
                                
                                <div class="flex-1">
                                    <h3 class="text-lg font-bold text-green-950 mb-1">{{ $item->product->name }}</h3>
                                    <p class="text-green-700 mb-2">Quantity: {{ $item->quantity }}</p>
                                    <p class="text-xl font-bold text-green-800">${{ number_format($item->product->price * $item->quantity, 2) }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                         <!-- Order Totals  -->
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-2xl border-2 border-green-200">
                            <div class="space-y-3">
                                <div class="flex justify-between text-green-800">
                                    <span class="font-semibold">Subtotal:</span>
                                    <span class="font-bold">${{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-green-800">
                                    <span class="font-semibold">Shipping:</span>
                                    <span class="font-bold">${{ number_format($shipping, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-green-800">
                                    <span class="font-semibold">Tax:</span>
                                    <span class="font-bold">${{ number_format($tax, 2) }}</span>
                                </div>
                                <div class="border-t-2 border-green-300 pt-3">
                                    <div class="flex justify-between text-green-950">
                                        <span class="text-2xl font-black">Total:</span>
                                        <span class="text-3xl font-black">${{ number_format($total, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                 <!-- Payment Form  -->
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border-2 border-green-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-950 to-green-900 p-8">
                        <h2 class="text-3xl font-bold text-yellow-50 mb-2">Payment Details</h2>
                        <p class="text-yellow-200">Secure payment powered by Stripe</p>
                    </div>
                    
                     <!-- FIXED: Changed form ID to match JavaScript  -->
                    <form id="checkout-form" class="p-8">
                        @csrf
                        
                         <!-- Shipping Information  -->
                        <div class="mb-8">
                            <h3 class="text-2xl font-bold text-green-950 mb-6">Shipping Information</h3>
                            
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-lg font-bold text-green-950 mb-3">Phone Number</label>
                                     FIXED: Added ID to match JavaScript 
                                    <input type="tel" id="phone" name="phone" required
                                           class="w-full px-6 py-4 border-2 border-green-200 rounded-2xl focus:ring-4 focus:ring-green-200 focus:border-green-500 transition-all duration-300 text-green-950 font-semibold text-lg bg-yellow-50"
                                           placeholder="Enter your phone number">
                                </div>
                                
                                <div>
                                    <label class="block text-lg font-bold text-green-950 mb-3">Shipping Address</label>
                                     <!-- FIXED: Added ID to match JavaScript  -->
                                    <textarea id="shipping_address" name="shipping_address" required rows="4"
                                              class="w-full px-6 py-4 border-2 border-green-200 rounded-2xl focus:ring-4 focus:ring-green-200 focus:border-green-500 transition-all duration-300 text-green-950 font-semibold bg-yellow-50"
                                              placeholder="Enter your complete shipping address"></textarea>
                                </div>

                                <div>
                                    <label class="block text-lg font-bold text-green-950 mb-3">Billing Address</label>
                                     <!-- FIXED: Added ID to match JavaScript  -->
                                    <textarea id="billing_address" name="billing_address" required rows="4"
                                              class="w-full px-6 py-4 border-2 border-green-200 rounded-2xl focus:ring-4 focus:ring-green-200 focus:border-green-500 transition-all duration-300 text-green-950 font-semibold bg-yellow-50"
                                              placeholder="Enter your billing address"></textarea>
                                </div>
                            </div>
                        </div>

                         <!-- Payment Information  -->
                        <div class="mb-8">
                            <h3 class="text-2xl font-bold text-green-950 mb-6">Payment Information</h3>
                            
                             <!-- Stripe Card Element  -->
                            <div class="mb-6">
                                <label class="block text-lg font-bold text-green-950 mb-3">Card Information</label>
                                <div id="card-element" class="p-6 border-2 border-green-200 rounded-2xl bg-yellow-50 focus-within:ring-4 focus-within:ring-green-200 focus-within:border-green-500 transition-all duration-300">
                                     <!-- Stripe Elements will create form elements here  -->
                                </div>
                                <div id="card-errors" role="alert" class="text-red-600 font-semibold mt-3"></div>
                            </div>
                        </div>

                         <!-- Submit Button  -->
                        <button type="submit" id="submit-button"
                                class="w-full py-6 bg-gradient-to-r from-green-600 to-green-700 text-white font-black text-xl rounded-2xl hover:from-green-700 hover:to-green-800 transition-all duration-300 transform hover:scale-105 shadow-2xl disabled:opacity-50 disabled:cursor-not-allowed">
                            <span id="button-text" class="flex items-center justify-center">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Complete Secure Payment - ${{ number_format($total, 2) }}
                            </span>
                            <span id="spinner" class="hidden">
                                <svg class="animate-spin -ml-1 mr-3 h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Processing Payment...
                            </span>
                        </button>

                         <!-- Security Notice  -->
                        <div class="mt-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl border border-green-200">
                            <div class="flex items-center text-green-800">
                                <svg class="w-6 h-6 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                <span class="font-semibold">Your payment information is secure and encrypted</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing Stripe...');
    
    const stripe = Stripe('{{ config('services.stripe.key') }}');
    const elements = stripe.elements();

    // Create card element
    const cardElement = elements.create('card', {
        style: {
            base: {
                fontSize: '16px',
                color: '#424770',
                '::placeholder': {
                    color: '#aab7c4',
                },
            },
        },
    });

    cardElement.mount('#card-element');
    console.log('Card element mounted');

    // Handle real-time validation errors from the card Element
    cardElement.on('change', function(event) {
        const displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle form submission
    const form = document.getElementById('checkout-form');
    const submitButton = document.getElementById('submit-button');
    const buttonText = document.getElementById('button-text');
    const spinner = document.getElementById('spinner');

    if (!form) {
        console.error('Form not found!');
        return;
    }

    form.addEventListener('submit', async function(event) {
        event.preventDefault();
        console.log('Form submitted');

        // Disable submit button and show spinner
        submitButton.disabled = true;
        buttonText.classList.add('hidden');
        spinner.classList.remove('hidden');

        try {
            console.log('Creating payment intent...');
            
            // Create payment intent
            const response = await fetch('{{ route('checkout.create-payment-intent') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            });

            const responseData = await response.json();
            console.log('Payment intent response:', responseData);

            if (!response.ok) {
                throw new Error(responseData.error || 'Failed to create payment intent');
            }

            const { client_secret, payment_intent_id } = responseData;

            if (!client_secret) {
                throw new Error('Failed to create payment intent');
            }

            console.log('Confirming payment...');

            // Confirm payment
            const { error, paymentIntent } = await stripe.confirmCardPayment(client_secret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: '{{ Auth::user()->name }}',
                        email: '{{ Auth::user()->email }}',
                    },
                },
            });

            if (error) {
                console.error('Payment error:', error);
                document.getElementById('card-errors').textContent = error.message;
                
                // Re-enable submit button
                submitButton.disabled = false;
                buttonText.classList.remove('hidden');
                spinner.classList.add('hidden');
            } else {
                console.log('Payment succeeded, processing order...');
                
                // Payment succeeded, process the order
                const processResponse = await fetch('{{ route('checkout.process') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        payment_intent_id: paymentIntent.id,
                        phone: document.getElementById('phone').value,
                        shipping_address: document.getElementById('shipping_address').value,
                        billing_address: document.getElementById('billing_address').value,
                    }),
                });

                const processResult = await processResponse.json();
                console.log('Process result:', processResult);

                if (processResult.success) {
                    window.location.href = processResult.redirect_url;
                } else {
                    throw new Error(processResult.error || 'Payment processing failed');
                }
            }
        } catch (err) {
            console.error('Error:', err);
            document.getElementById('card-errors').textContent = err.message;
            
            // Re-enable submit button
            submitButton.disabled = false;
            buttonText.classList.remove('hidden');
            spinner.classList.add('hidden');
        }
    });
});
</script>
@endsection