@extends('layouts.app')

@section('title', $product->name . ' - Product Details')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-100">
  <!-- Breadcrumb -->
  <div class="px-4 md:px-8 lg:px-8 py-6">
      <nav class="flex items-center space-x-2 text-sm">
          <a href="{{ route('home') }}" class="text-green-800 hover:text-green-700 font-medium transition-colors">Home</a>
          <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
          </svg>
          <a href="{{ route('products.index') }}" class="text-green-800 hover:text-green-700 font-medium transition-colors">Products</a>
          <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
          </svg>
          <span class="text-gray-600">{{ $product->name }}</span>
      </nav>
  </div>

  <div class="px-4 md:px-8 lg:px-8 pb-12">
      <!-- Product Details Section -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
          <!-- Product Images -->
          <div class="space-y-4">
              <div class="backdrop-blur-sm bg-white/90 rounded-2xl shadow-2xl border-0 p-8 relative overflow-hidden">
                  <div class="absolute inset-0 bg-gradient-to-br from-white/50 to-amber-50/50 pointer-events-none"></div>
                  
                  <div class="relative z-10">
                      <!-- Main Image -->
                      <div class="aspect-square rounded-2xl overflow-hidden mb-6 group">
                          <img id="main-image" 
                               src="{{ $product->images }}" 
                               alt="{{ $product->name }}" 
                               class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                      </div>
                      
                      <!-- Thumbnail Images -->
                      @if($product->gallery && count($product->gallery) > 1)
                      <div class="grid grid-cols-4 gap-3">
                          @foreach($product->gallery as $index => $image)
                          <button onclick="changeMainImage('{{ $image }}')" 
                                  class="aspect-square rounded-xl overflow-hidden border-2 border-transparent hover:border-green-800 transition-all duration-300 {{ $index === 0 ? 'border-green-800' : '' }}">
                              <img src="{{ $image }}" 
                                   alt="Product image {{ $index + 1 }}" 
                                   class="w-full h-full object-cover">
                          </button>
                          @endforeach
                      </div>
                      @endif
                  </div>
              </div>
          </div>

          <!-- Product Information -->
          <div class="space-y-8">
              <div class="backdrop-blur-sm bg-white/90 rounded-2xl shadow-2xl border-0 p-8 relative overflow-hidden">
                  <div class="absolute inset-0 bg-gradient-to-br from-white/50 to-amber-50/50 pointer-events-none"></div>
                  
                  <div class="relative z-10 space-y-6">
                      <!-- Product Title & Rating -->
                      <div>
                          <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                          <div class="flex items-center space-x-4 mb-4">
                              <div class="flex items-center">
                                  @for($i = 1; $i <= 5; $i++)
                                      <svg class="w-5 h-5 {{ $i <= $product->average_rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                      </svg>
                                  @endfor
                                  <span class="ml-2 text-gray-600 font-medium">{{ number_format($product->average_rating, 1) }} ({{ $product->reviews_count }} reviews)</span>
                              </div>
                              @if($product->stock_quantity > 0) {{-- Changed from $product->in_stock to $product->stock_quantity > 0 --}}
                                  <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">In Stock</span>
                              @else
                                  <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">Out of Stock</span>
                              @endif
                          </div>
                      </div>

                      <!-- Price -->
                      <div class="flex items-center space-x-4">
                          <span class="text-4xl font-bold text-green-800">${{ $product->price }}</span>
                          @if($product->original_price && $product->original_price > $product->price)
                              <span class="text-2xl text-gray-500 line-through">${{ $product->original_price }}</span>
                              <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-bold">
                                  {{ round((($product->original_price - $product->price) / $product->original_price) * 100) }}% OFF
                              </span>
                          @endif
                      </div>

                      <!-- Description -->
                      <div>
                          <h3 class="text-xl font-semibold text-gray-900 mb-3">Description</h3>
                          <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                      </div>

                      <!-- Product Options -->
                      <form id="add-to-cart-form" class="space-y-6">
                          @csrf
                          <input type="hidden" name="product_id" value="{{ $product->id }}">
                          
                          <!-- Size Selection -->
                          @if($product->sizes && count($product->sizes) > 0)
                          <div>
                              <label class="block text-lg font-semibold text-gray-900 mb-3">Size</label>
                              <div class="flex flex-wrap gap-3">
                                  @foreach($product->sizes as $size)
                                  <label class="cursor-pointer">
                                      <input type="radio" name="size" value="{{ $size }}" class="sr-only peer" required>
                                      <div class="px-4 py-2 border-2 border-gray-200 rounded-xl peer-checked:border-green-800 peer-checked:bg-green-50 hover:border-green-600 transition-all duration-300 font-medium">
                                          {{ $size }}
                                      </div>
                                  </label>
                                  @endforeach
                              </div>
                          </div>
                          @endif

                          <!-- Color Selection -->
                          @if($product->colors && count($product->colors) > 0)
                          <div>
                              <label class="block text-lg font-semibold text-gray-900 mb-3">Color</label>
                              <div class="flex flex-wrap gap-3">
                                  @foreach($product->colors as $color)
                                  <label class="cursor-pointer">
                                      <input type="radio" name="color" value="{{ $color }}" class="sr-only peer" required>
                                      <div class="px-4 py-2 border-2 border-gray-200 rounded-xl peer-checked:border-green-800 peer-checked:bg-green-50 hover:border-green-600 transition-all duration-300 font-medium">
                                          {{ $color }}
                                      </div>
                                  </label>
                                  @endforeach
                              </div>
                          </div>
                          @endif

                          <!-- Quantity -->
                          <div>
                              <label class="block text-lg font-semibold text-gray-900 mb-3">Quantity</label>
                              <div class="flex items-center bg-gray-100 rounded-xl p-1 w-fit">
                                  <button type="button" onclick="changeQuantity(-1)" class="p-3 hover:bg-white rounded-lg transition-all duration-300">
                                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                      </svg>
                                  </button>
                                  <input type="number" name="quantity" id="quantity" value="1" min="1" max="10" class="w-16 text-center bg-transparent font-bold text-lg border-none focus:outline-none">
                                  <button type="button" onclick="changeQuantity(1)" class="p-3 hover:bg-white rounded-lg transition-all duration-300">
                                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                      </svg>
                                  </button>
                              </div>
                          </div>

                          <!-- Action Buttons -->
                          <div class="space-y-4">
                              <button type="submit" 
                                      id="add-to-cart-btn"
                                      class="w-full bg-gradient-to-r from-green-800 to-green-900 hover:from-green-700 hover:to-green-800 text-white py-4 rounded-xl font-semibold text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] disabled:opacity-50 disabled:cursor-not-allowed"
                                      {{ $product->stock_quantity > 0 ? '' : 'disabled' }}> {{-- Changed from $product->in_stock to $product->stock_quantity > 0 --}}
                                  <span class="add-to-cart-text">
                                      @if($product->stock_quantity <= 0) {{-- Changed from !$product->in_stock to $product->stock_quantity <= 0 --}}
                                          Out of Stock
                                      @else
                                          Add to Cart
                                      @endif
                                  </span>
                                  <span class="add-to-cart-loading hidden flex items-center justify-center">
                                      <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                      </svg>
                                      Adding to Cart...
                                  </span>
                              </button>
                              
                              <div class="grid grid-cols-2 gap-4">
                                  <button type="button" onclick="addToWishlist({{ $product->id }})" class="border-2 border-gray-200 hover:border-green-800 hover:bg-green-50 py-3 rounded-xl font-semibold transition-all duration-300 flex items-center justify-center">
                                      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                      </svg>
                                      Wishlist
                                  </button>
                                  <button type="button" onclick="shareProduct()" class="border-2 border-gray-200 hover:border-green-800 hover:bg-green-50 py-3 rounded-xl font-semibold transition-all duration-300 flex items-center justify-center">
                                      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                      </svg>
                                      Share
                                  </button>
                              </div>
                          </div>
                      </form>

                      <!-- Product Features -->
                      <div class="border-t pt-6">
                          <div class="grid grid-cols-2 gap-4 text-sm">
                              <div class="flex items-center">
                                  <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                  </svg>
                                  Free Shipping
                              </div>
                              <div class="flex items-center">
                                  <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                  </svg>
                                  Easy Returns
                              </div>
                              <div class="flex items-center">
                                  <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                  </svg>
                                  Secure Payment
                              </div>
                              <div class="flex items-center">
                                  <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                  </svg>
                                  24/7 Support
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <!-- Reviews Section -->
      <div class="backdrop-blur-sm bg-white/90 rounded-2xl shadow-2xl border-0 p-8 relative overflow-hidden mb-12">
          <div class="absolute inset-0 bg-gradient-to-br from-white/50 to-amber-50/50 pointer-events-none"></div>
          
          <div class="relative z-10">
              <!-- Reviews Header -->
              <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                  <div>
                      <h2 class="text-3xl font-bold text-gray-900 mb-2">Customer Reviews</h2>
                      <div class="flex items-center space-x-4">
                          <div class="flex items-center">
                              @for($i = 1; $i <= 5; $i++)
                                  <svg class="w-6 h-6 {{ $i <= $product->average_rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                  </svg>
                              @endfor
                              <span class="ml-3 text-xl font-semibold text-gray-900">{{ number_format($product->average_rating, 1) }} out of 5</span>
                          </div>
                          <span class="text-gray-600">Based on {{ $product->reviews_count }} reviews</span>
                      </div>
                  </div>
                  
                  @auth
                  <button onclick="toggleReviewForm()" class="mt-4 md:mt-0 bg-gradient-to-r from-green-800 to-green-900 hover:from-green-700 hover:to-green-800 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105">
                      Write a Review
                  </button>
                  @endauth
              </div>

              <!-- Add Review Form -->
              @auth
              <div id="review-form" class="hidden mb-8 p-6 bg-gradient-to-r from-green-50 to-amber-50 rounded-xl border border-green-200">
                  <h3 class="text-xl font-semibold text-gray-900 mb-4">Write Your Review</h3>
                  <form id="add-review-form" class="space-y-4">
                      @csrf
                      <input type="hidden" name="product_id" value="{{ $product->id }}">
                      
                      <!-- Rating -->
                      <div>
                          <label class="block text-sm font-semibold text-gray-700 mb-2">Rating</label>
                          <div class="flex items-center space-x-1">
                              @for($i = 1; $i <= 5; $i++)
                              <button type="button" onclick="setRating({{ $i }})" class="rating-star text-gray-300 hover:text-yellow-400 transition-colors">
                                  <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                  </svg>
                              </button>
                              @endfor
                              <input type="hidden" name="rating" id="rating-input" required>
                          </div>
                      </div>

                      <!-- Review Title -->
                      <div>
                          <label for="review-title" class="block text-sm font-semibold text-gray-700 mb-2">Review Title</label>
                          <input type="text" 
                                 id="review-title" 
                                 name="title" 
                                 placeholder="Summarize your review" 
                                 class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-800 focus:ring-2 focus:ring-green-800/20 transition-all duration-300"
                                 required>
                      </div>

                      <!-- Review Content -->
                      <div>
                          <label for="review-content" class="block text-sm font-semibold text-gray-700 mb-2">Your Review</label>
                          <textarea id="review-content" 
                                    name="content" 
                                    rows="4" 
                                    placeholder="Share your thoughts about this product..." 
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-800 focus:ring-2 focus:ring-green-800/20 transition-all duration-300 resize-none"
                                    required></textarea>
                      </div>

                      <!-- Submit Button -->
                      <div class="flex space-x-4">
                          <button type="submit" class="bg-gradient-to-r from-green-800 to-green-900 hover:from-green-700 hover:to-green-800 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300">
                              <span class="submit-review-text">Submit Review</span>
                              <span class="submit-review-loading hidden">
                                  <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                  </svg>
                                  Submitting...
                              </span>
                          </button>
                          <button type="button" onclick="toggleReviewForm()" class="border-2 border-gray-200 hover:border-gray-300 px-6 py-3 rounded-xl font-semibold transition-all duration-300">
                              Cancel
                          </button>
                      </div>
                  </form>
              </div>
              @endauth

              <!-- Reviews List -->
              <div id="reviews-list" class="space-y-6">
                  @forelse($product->reviews as $review)
                  <div class="review-item p-6 bg-white/70 rounded-xl border border-gray-100 hover:border-green-200 transition-all duration-300">
                      <div class="flex items-start justify-between mb-4">
                          <div class="flex items-center space-x-4">
                              <div class="w-12 h-12 bg-gradient-to-r from-green-800 to-green-900 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                  {{ strtoupper(substr($review->user->name, 0, 1)) }}
                              </div>
                              <div>
                                  <h4 class="font-semibold text-gray-900">{{ $review->user->name }}</h4>
                                  <div class="flex items-center space-x-2">
                                      <div class="flex items-center">
                                          @for($i = 1; $i <= 5; $i++)
                                              <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                              </svg>
                                          @endfor
                                      </div>
                                      <span class="text-sm text-gray-500">{{ $review->created_at->format('M d, Y') }}</span>
                                  </div>
                              </div>
                          </div>
                          
                          @if($review->verified_purchase)
                          <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Verified Purchase</span>
                          @endif
                      </div>
                      
                      <h5 class="font-semibold text-lg text-gray-900 mb-2">{{ $review->title }}</h5>
                      <p class="text-gray-700 leading-relaxed">{{ $review->content }}</p>
                      
                      <!-- Review Actions -->
                      <div class="flex items-center space-x-4 mt-4 pt-4 border-t border-gray-100">
                          <button onclick="likeReview({{ $review->id }})" class="flex items-center space-x-2 text-gray-500 hover:text-green-600 transition-colors">
                              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                              </svg>
                              <span>Helpful ({{ $review->likes_count ?? 0 }})</span>
                          </button>
                          <button class="text-gray-500 hover:text-gray-700 transition-colors">Report</button>
                      </div>
                  </div>
                  @empty
                  <div class="text-center py-12">
                      <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                      </svg>
                      <h3 class="text-xl font-semibold text-gray-900 mb-2">No reviews yet</h3>
                      <p class="text-gray-600">Be the first to review this product!</p>
                  </div>
                  @endforelse
              </div>

              <!-- Load More Reviews -->
              @if($product->reviews_count > 5)
              <div class="text-center mt-8">
                  <button onclick="loadMoreReviews()" class="border-2 border-green-800 text-green-800 hover:bg-green-50 px-6 py-3 rounded-xl font-semibold transition-all duration-300">
                      Load More Reviews
                  </button>
              </div>
              @endif
          </div>
      </div>

      <!-- Related Products -->
      @if($relatedProducts && $relatedProducts->count() > 0)
      <div class="backdrop-blur-sm bg-white/90 rounded-2xl shadow-2xl border-0 p-8 relative overflow-hidden">
          <div class="absolute inset-0 bg-gradient-to-br from-white/50 to-amber-50/50 pointer-events-none"></div>
          
          <div class="relative z-10">
              <h2 class="text-3xl font-bold text-gray-900 mb-8">You Might Also Like</h2>
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                  @foreach($relatedProducts as $relatedProduct)
                  <div class="group">
                      <a href="{{ route('products.show', $relatedProduct->id) }}" class="block">
                          <div class="aspect-square rounded-xl overflow-hidden mb-4 group-hover:shadow-lg transition-shadow duration-300">
                              <img src="{{ $relatedProduct->images }}" 
                                   alt="{{ $relatedProduct->name }}" 
                                   class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                          </div>
                          <h3 class="font-semibold text-gray-900 mb-2 group-hover:text-green-800 transition-colors">{{ $relatedProduct->name }}</h3>
                          <div class="flex items-center space-x-2">
                              <span class="text-lg font-bold text-green-800">${{ $relatedProduct->price }}</span>
                              @if($relatedProduct->original_price && $relatedProduct->original_price > $relatedProduct->price)
                                  <span class="text-sm text-gray-500 line-through">${{ $relatedProduct->original_price }}</span>
                              @endif
                          </div>
                      </a>
                  </div>
                  @endforeach
              </div>
          </div>
      </div>
      @endif
  </div>
</div>

<!-- Loading Overlay -->
<div id="loading-overlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center">
  <div class="bg-white rounded-2xl p-8 text-center">
      <div class="animate-spin w-12 h-12 border-4 border-green-800 border-t-transparent rounded-full mx-auto mb-4"></div>
      <p class="text-lg font-semibold text-gray-900">Processing...</p>
  </div>
</div>

<script>
// CSRF Token
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Change main product image
function changeMainImage(imageSrc) {
  document.getElementById('main-image').src = imageSrc;
  
  // Update active thumbnail
  document.querySelectorAll('[onclick*="changeMainImage"]').forEach(btn => {
      btn.classList.remove('border-green-800');
      btn.classList.add('border-transparent');
  });
  event.target.closest('button').classList.add('border-green-800');
  event.target.closest('button').classList.remove('border-transparent');
}

// Change quantity
function changeQuantity(change) {
  const quantityInput = document.getElementById('quantity');
  const currentValue = parseInt(quantityInput.value);
  const newValue = Math.max(1, Math.min(10, currentValue + change));
  quantityInput.value = newValue;
}

// Toggle review form
function toggleReviewForm() {
  const form = document.getElementById('review-form');
  form.classList.toggle('hidden');
  
  if (!form.classList.contains('hidden')) {
      form.scrollIntoView({ behavior: 'smooth', block: 'center' });
  }
}

// Set rating for review
let selectedRating = 0;
function setRating(rating) {
  selectedRating = rating;
  document.getElementById('rating-input').value = rating;
  
  // Update star display
  document.querySelectorAll('.rating-star').forEach((star, index) => {
      if (index < rating) {
          star.classList.remove('text-gray-300');
          star.classList.add('text-yellow-400');
      } else {
          star.classList.remove('text-yellow-400');
          star.classList.add('text-gray-300');
      }
  });
}

// Add to cart form submission
document.getElementById('add-to-cart-form').addEventListener('submit', async function(e) {
  e.preventDefault();
  
  const button = document.getElementById('add-to-cart-btn');
  const textSpan = button.querySelector('.add-to-cart-text');
  const loadingSpan = button.querySelector('.add-to-cart-loading');
  
  // Check if product is out of stock
  // The disabled attribute is set by Laravel Blade based on $product->stock_quantity > 0
  if (button.disabled) { // Check the actual disabled state of the button
      return;
  }
  
  // Check if elements exist before manipulating them
  if (!textSpan || !loadingSpan) {
      console.error('Button text elements not found');
      return;
  }
  
  // Show loading state
  textSpan.classList.add('hidden');
  loadingSpan.classList.remove('hidden');
  button.disabled = true;
  
  const formData = new FormData(this);
  
  try {
      const response = await fetch('/cart/add', {
          method: 'POST',
          headers: {
              'X-CSRF-TOKEN': csrfToken,
              'Accept': 'application/json'
          },
          body: formData
      });
      
      const data = await response.json();
      
      if (response.status === 401) {
          showNotification('Please login to add items to cart', 'error');
          setTimeout(() => {
              window.location.href = '/login';
          }, 2000);
          return;
      }
      
      if (data.success) {
          showNotification('Product added to cart successfully!', 'success');
          
          // Update cart count in header if function exists
          if (window.updateCartCount) {
              window.updateCartCount();
          }
      } else {
          showNotification(data.message || 'Failed to add product to cart', 'error');
      }
  } catch (error) {
      console.error('Error adding to cart:', error);
      showNotification('An error occurred while adding to cart', 'error');
  } finally {
      // Reset button state only if product is in stock (based on initial Blade check)
      if ({{ $product->stock_quantity > 0 ? 'true' : 'false' }}) { // Use stock_quantity here
          textSpan.classList.remove('hidden');
          loadingSpan.classList.add('hidden');
          button.disabled = false;
      }
  }
});

// Submit review
document.getElementById('add-review-form').addEventListener('submit', async function(e) {
  e.preventDefault();
  
  if (selectedRating === 0) {
      showNotification('Please select a rating', 'error');
      return;
  }
  
  const formData = new FormData(this);
  const button = this.querySelector('button[type="submit"]');
  const text = button.querySelector('.submit-review-text');
  const loading = button.querySelector('.submit-review-loading');
  
  // Show loading state
  text.classList.add('hidden');
  loading.classList.remove('hidden');
  button.disabled = true;
  
  try {
      const response = await fetch('/reviews/add', {
          method: 'POST',
          headers: {
              'X-CSRF-TOKEN': csrfToken,
              'Accept': 'application/json'
          },
          body: formData
      });
      
      const data = await response.json();
      
      if (data.success) {
          showNotification('Review submitted successfully!', 'success');
          
          // Reset form
          this.reset();
          selectedRating = 0;
          document.querySelectorAll('.rating-star').forEach(star => {
              star.classList.remove('text-yellow-400');
              star.classList.add('text-gray-300');
          });
          
          // Hide form
          toggleReviewForm();
          
          // Reload reviews (or add the new review to the list)
          setTimeout(() => {
              location.reload();
          }, 1500);
      } else {
          showNotification(data.message || 'Failed to submit review', 'error');
      }
  } catch (error) {
      console.error('Error submitting review:', error);
      showNotification('An error occurred while submitting review', 'error');
  } finally {
      // Reset button state
      text.classList.remove('hidden');
      loading.classList.add('hidden');
      button.disabled = false;
  }
});

// Add to wishlist
async function addToWishlist(productId) {
  try {
      const response = await fetch('/wishlist/add', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken,
              'Accept': 'application/json'
          },
          body: JSON.stringify({ product_id: productId })
      });
      
      const data = await response.json();
      
      if (data.success) {
          showNotification('Product added to wishlist!', 'success');
      } else {
          showNotification(data.message || 'Failed to add to wishlist', 'error');
      }
  } catch (error) {
      console.error('Error adding to wishlist:', error);
      showNotification('An error occurred while adding to wishlist', 'error');
  }
}

// Share product
function shareProduct() {
  if (navigator.share) {
      navigator.share({
          title: document.title,
          url: window.location.href
      });
  } else {
      // Fallback: copy to clipboard
      navigator.clipboard.writeText(window.location.href).then(() => {
          showNotification('Product link copied to clipboard!', 'success');
      });
  }
}

// Like review
async function likeReview(reviewId) {
  try {
      const response = await fetch(`/reviews/${reviewId}/like`, {
          method: 'POST',
          headers: {
              'X-CSRF-TOKEN': csrfToken,
              'Accept': 'application/json'
          }
      });
      
      const data = await response.json();
      
      if (data.success) {
          showNotification('Thank you for your feedback!', 'success');
          // Update like count in UI
          const likeButton = event.target.closest('button');
          const likeCount = likeButton.querySelector('span');
          likeCount.textContent = `Helpful (${data.likes_count})`;
      }
  } catch (error) {
      console.error('Error liking review:', error);
  }
}

// Load more reviews
async function loadMoreReviews() {
  // Implementation for pagination
  showNotification('Loading more reviews...', 'info');
}

// Show notification function
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
</script>
@endsection
