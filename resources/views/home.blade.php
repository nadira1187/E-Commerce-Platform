@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 bg-gradient-to-br from-cream-50 via-amber-50 to-yellow-100"></div>
    
    <!-- Animated Background Shapes -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-olive-200/30 to-olive-300/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-gradient-to-tr from-amber-200/30 to-yellow-200/20 rounded-full blur-3xl animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-gradient-to-r from-olive-100/20 to-cream-200/20 rounded-full blur-2xl animate-pulse delay-500"></div>
    </div>

    <!-- Floating Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-4 h-4 bg-olive-300 rounded-full animate-float"></div>
        <div class="absolute top-40 right-20 w-6 h-6 bg-amber-300 rounded-full animate-float-delayed"></div>
        <div class="absolute bottom-40 left-20 w-3 h-3 bg-olive-400 rounded-full animate-float"></div>
        <div class="absolute bottom-20 right-10 w-5 h-5 bg-cream-400 rounded-full animate-float-delayed"></div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div class="text-center lg:text-left">
                <!-- Badge -->
                <div class="inline-flex items-center px-4 py-2 bg-olive-100 text-olive-800 rounded-full text-sm font-medium mb-8 animate-fade-in-up">
                    <span class="w-2 h-2 bg-olive-500 rounded-full mr-2 animate-pulse"></span>
                    ✨ New Spring Collection 2024
                </div>

                <!-- Main Heading -->
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-playfair font-bold text-olive-900 mb-6 leading-tight animate-fade-in-up delay-200">
                    Fashion That
                    <span class="relative inline-block">
                        <span class="bg-gradient-to-r from-amber-500 to-yellow-500 bg-clip-text text-transparent">Speaks</span>
                        <svg class="absolute -bottom-2 left-0 w-full h-3 text-amber-300" viewBox="0 0 100 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 10C20 2 40 2 50 6C60 2 80 2 98 10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </span>
                    <br>Your Soul
                </h1>

                <!-- Subtitle -->
                <p class="text-xl md:text-2xl text-olive-700 mb-8 leading-relaxed max-w-2xl animate-fade-in-up delay-400">
                    Discover premium clothing that blends 
                    <span class="font-semibold text-olive-800">timeless elegance</span> 
                    with contemporary style. Crafted for those who appreciate quality and sophistication.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 mb-12 animate-fade-in-up delay-600">
                    <a href="#products" class="group relative inline-flex items-center justify-center px-8 py-4 bg-olive-800 text-cream-50 rounded-2xl font-semibold text-lg overflow-hidden transition-all duration-300 hover:bg-olive-700 hover:shadow-2xl hover:scale-105">
                        <span class="absolute inset-0 bg-gradient-to-r from-olive-700 to-olive-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                        <span class="relative flex items-center">
                            Explore Collection
                            <svg class="ml-2 w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </span>
                    </a>
                    
                    <a href="/register" class="group inline-flex items-center justify-center px-8 py-4 bg-cream-100 text-olive-800 border-2 border-olive-200 rounded-2xl font-semibold text-lg hover:bg-cream-200 hover:border-olive-300 transition-all duration-300 hover:shadow-lg">
                        <span class="flex items-center">
                            Join StyleHub
                            <svg class="ml-2 w-5 h-5 transform group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </span>
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-8 animate-fade-in-up delay-800">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-olive-800 mb-2">50K+</div>
                        <div class="text-olive-600 text-sm">Happy Customers</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-olive-800 mb-2">1000+</div>
                        <div class="text-olive-600 text-sm">Premium Products</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-olive-800 mb-2">99%</div>
                        <div class="text-olive-600 text-sm">Satisfaction Rate</div>
                    </div>
                </div>
            </div>

            <!-- Right Content - Hero Image -->
            <div class="relative animate-fade-in-up delay-1000">
                <!-- Main Image Container -->
                <div class="relative">
                    <!-- Background Decoration -->
                    <div class="absolute -inset-4 bg-gradient-to-r from-olive-200 to-amber-200 rounded-3xl blur-2xl opacity-30 animate-pulse"></div>
                    
                    <!-- Image -->
                    <div class="relative bg-gradient-to-br from-cream-100 to-cream-200 rounded-3xl p-8 shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                             alt="Fashion Collection" 
                             class="w-full h-96 lg:h-[500px] object-cover rounded-2xl shadow-xl">
                        
                        <!-- Floating Cards -->
                        <div class="absolute -top-4 -left-4 bg-cream-50 rounded-2xl p-4 shadow-lg animate-float">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <span class="text-sm font-medium text-olive-800">Free Shipping</span>
                            </div>
                        </div>
                        
                        <div class="absolute -bottom-4 -right-4 bg-cream-50 rounded-2xl p-4 shadow-lg animate-float-delayed">
                            <div class="flex items-center space-x-2">
                                <div class="flex">
                                    <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-olive-800">4.9/5</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <div class="w-6 h-10 border-2 border-olive-300 rounded-full flex justify-center">
            <div class="w-1 h-3 bg-olive-400 rounded-full mt-2 animate-pulse"></div>
        </div>
    </div>
</section>

<!-- Category Filter Section -->
<section class="py-20 bg-cream-50" id="products">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-playfair font-bold text-olive-900 mb-6">
                Explore Our 
                <span class="bg-gradient-to-r from-amber-500 to-yellow-500 bg-clip-text text-transparent">Collections</span>
            </h2>
            <p class="text-xl text-olive-600 max-w-3xl mx-auto leading-relaxed">
                Carefully curated pieces that blend timeless elegance with contemporary style. 
                Each item is selected for its quality, craftsmanship, and unique character.
            </p>
        </div>
        
        <!-- Category Filters -->
        <div class="flex flex-wrap justify-center gap-4 mb-16">
            <a href="{{ route('home') }}" 
               class="group px-8 py-4 rounded-2xl font-semibold transition-all duration-300 {{ !request('category') ? 'bg-olive-800 text-cream-50 shadow-xl scale-105' : 'bg-cream-100 text-olive-700 hover:bg-cream-200 border-2 border-olive-200 hover:border-olive-300 hover:scale-105' }}">
                <span class="flex items-center">
                    All Collections
                    @if(!request('category'))
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    @endif
                </span>
            </a>
            @foreach(['men', 'women', 'kids'] as $category)
                <a href="{{ route('home', ['category' => $category]) }}" 
                   class="group px-8 py-4 rounded-2xl font-semibold transition-all duration-300 {{ request('category') === $category ? 'bg-olive-800 text-cream-50 shadow-xl scale-105' : 'bg-cream-100 text-olive-700 hover:bg-cream-200 border-2 border-olive-200 hover:border-olive-300 hover:scale-105' }}">
                    <span class="flex items-center">
                        {{ ucfirst($category) }}
                        @if(request('category') === $category)
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        @endif
                    </span>
                </a>
            @endforeach
        </div>

        <!-- Sort Dropdown -->
        <div class="flex justify-end mb-12">
            <select onchange="window.location.href=this.value" 
                    class="bg-cream-100 border-2 border-olive-200 text-olive-700 rounded-2xl px-6 py-3 focus:ring-2 focus:ring-olive-300 focus:border-olive-400 font-medium">
                <option value="{{ route('home', array_merge(request()->all(), ['sort' => 'created_at'])) }}" 
                        {{ request('sort') === 'created_at' ? 'selected' : '' }}>✨ Newest First</option>
                <option value="{{ route('home', array_merge(request()->all(), ['sort' => 'price_low'])) }}" 
                        {{ request('sort') === 'price_low' ? 'selected' : '' }}>💰 Price: Low to High</option>
                <option value="{{ route('home', array_merge(request()->all(), ['sort' => 'price_high'])) }}" 
                        {{ request('sort') === 'price_high' ? 'selected' : '' }}>💎 Price: High to Low</option>
                <option value="{{ route('home', array_merge(request()->all(), ['sort' => 'rating'])) }}" 
                        {{ request('sort') === 'rating' ? 'selected' : '' }}>⭐ Highest Rated</option>
            </select>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($products as $product)
                <div class="group bg-cream-50 rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-olive-100 overflow-hidden hover:scale-105">
                    <div class="relative overflow-hidden">
                        <img src="{{ $product->images}}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-72 object-cover group-hover:scale-110 transition-transform duration-700">
                        
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        @if($product->discount_percentage > 0)
                            <div class="absolute top-4 left-4 bg-gradient-to-r from-red-500 to-red-600 text-white px-3 py-2 rounded-full text-sm font-bold shadow-lg animate-pulse">
                                -{{ $product->discount_percentage }}%
                            </div>
                        @endif
                        
                        @auth
                            <button onclick="toggleWishlist({{ $product->id }})" 
                                    class="absolute top-4 right-4 p-3 bg-cream-50/90 backdrop-blur-sm rounded-full shadow-lg hover:bg-cream-100 hover:scale-110 transition-all duration-300 group/heart">
                                <svg class="w-5 h-5 text-olive-600 group-hover/heart:text-red-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.682l-1.318-1.364a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        @endauth
                    </div>
                    
                    <div class="p-6">
                        <h3 class="font-semibold text-xl mb-3 text-olive-900 line-clamp-2 group-hover:text-olive-700 transition-colors duration-300">
                            {{ $product->name }}
                        </h3>
                        
                        <!-- Rating -->
                        <div class="flex items-center mb-4">
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= $product->average_rating ? 'text-amber-400 fill-current' : 'text-olive-200' }}" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-sm text-olive-600 ml-2 font-medium">({{ $product->total_reviews }})</span>
                        </div>
                        
                        <!-- Price -->
                        <div class="flex items-center space-x-2 mb-4">
                            <span class="text-2xl font-bold text-olive-900">${{ $product->price }}</span>
                            @if($product->original_price && $product->original_price > $product->price)
                                <span class="text-lg text-olive-500 line-through">${{ $product->original_price }}</span>
                            @endif
                        </div>
                        
                        <!-- Sizes -->
                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach(array_slice($product->sizes, 0, 4) as $size)
                                <span class="px-3 py-1 bg-olive-100 text-olive-700 text-sm rounded-full font-medium">{{ $size }}</span>
                            @endforeach
                            @if(count($product->sizes) > 4)
                                <span class="px-3 py-1 bg-olive-100 text-olive-700 text-sm rounded-full font-medium">+{{ count($product->sizes) - 4 }}</span>
                            @endif
                        </div>
                        
                        <!-- Actions -->
                        <div class="flex space-x-3">
                            <a href="{{ route('products.show', $product->id) }}" 
                               class="flex-1 bg-olive-800 text-cream-50 text-center py-3 rounded-2xl hover:bg-olive-700 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl hover:scale-105">
                                View Details
                            </a>
                            @auth
                                <button onclick="addToCart({{ $product->id }})" 
                                        class="px-4 py-3 bg-cream-100 text-olive-700 rounded-2xl hover:bg-cream-200 transition-all duration-300 border-2 border-olive-200 hover:border-olive-300 hover:scale-105">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9m-9 0V19a2 2 0 002 2h7a2 2 0 002-2v-4"></path>
                                    </svg>
                                </button>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <div class="text-olive-300 mb-8">
                        <svg class="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-olive-900 mb-4">No products found</h3>
                    <p class="text-olive-600 mb-8 text-lg">Try adjusting your search or filter criteria.</p>
                    <a href="{{ route('home') }}" class="inline-flex items-center px-8 py-4 bg-olive-800 text-cream-50 rounded-2xl hover:bg-olive-700 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl">
                        View All Products
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-16 flex justify-center">
            {{ $products->appends(request()->query())->links() }}
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-gradient-to-br from-olive-50 to-cream-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <h2 class="text-4xl md:text-5xl font-playfair font-bold text-olive-900 mb-6">
                Why Choose 
                <span class="bg-gradient-to-r from-amber-500 to-yellow-500 bg-clip-text text-transparent">StyleHub?</span>
            </h2>
            <p class="text-xl text-olive-600 max-w-3xl mx-auto leading-relaxed">
                Experience premium fashion with unmatched quality, service, and style. 
                We're committed to delivering excellence in every aspect of your shopping journey.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <!-- Feature 1 -->
            <div class="group text-center">
                <div class="relative mb-8">
                    <div class="w-24 h-24 bg-gradient-to-br from-amber-100 to-yellow-100 rounded-3xl flex items-center justify-center mx-auto group-hover:scale-110 transition-transform duration-500 shadow-xl">
                        <svg class="w-12 h-12 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-olive-900">Secure Shopping</h3>
                <p class="text-olive-600 leading-relaxed text-lg">
                    Shop with confidence using our SSL-encrypted checkout process and multiple secure payment options including PayPal, Stripe, and major credit cards.
                </p>
            </div>
            
            <!-- Feature 2 -->
            <div class="group text-center">
                <div class="relative mb-8">
                    <div class="w-24 h-24 bg-gradient-to-br from-olive-100 to-green-100 rounded-3xl flex items-center justify-center mx-auto group-hover:scale-110 transition-transform duration-500 shadow-xl">
                        <svg class="w-12 h-12 text-olive-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center">
                        <span class="text-white text-xs font-bold">★</span>
                    </div>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-olive-900">Premium Quality</h3>
                <p class="text-olive-600 leading-relaxed text-lg">
                    Every piece is carefully selected from trusted brands and sustainable materials. We guarantee exceptional quality that stands the test of time.
                </p>
            </div>
            
            <!-- Feature 3 -->
            <div class="group text-center">
                <div class="relative mb-8">
                    <div class="w-24 h-24 bg-gradient-to-br from-cream-100 to-amber-50 rounded-3xl flex items-center justify-center mx-auto group-hover:scale-110 transition-transform duration-500 shadow-xl">
                        <svg class="w-12 h-12 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">
                        <span class="text-white text-xs font-bold">24</span>
                    </div>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-olive-900">24/7 Support</h3>
                <p class="text-olive-600 leading-relaxed text-lg">
                    Our dedicated customer support team is always ready to help. Get instant assistance via chat, email, or phone whenever you need it.
                </p>
            </div>
        </div>
        
        <!-- CTA Section -->
        <div class="mt-20">
            <div class="relative bg-gradient-to-r from-olive-800 via-olive-700 to-olive-800 rounded-3xl p-12 text-center overflow-hidden">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-0 left-0 w-40 h-40 bg-cream-200 rounded-full -translate-x-20 -translate-y-20"></div>
                    <div class="absolute bottom-0 right-0 w-32 h-32 bg-amber-200 rounded-full translate-x-16 translate-y-16"></div>
                </div>
                
                <div class="relative z-10">
                    <h3 class="text-3xl md:text-4xl font-playfair font-bold text-cream-50 mb-6">
                        Ready to Upgrade Your Wardrobe?
                    </h3>
                    <p class="text-xl text-cream-100 mb-10 max-w-2xl mx-auto leading-relaxed">
                        Join over 50,000 satisfied customers who trust StyleHub for their fashion needs. 
                        Start your style journey today!
                    </p>
                    <div class="flex flex-col sm:flex-row gap-6 justify-center">
                        <a href="#products" class="inline-flex items-center px-8 py-4 bg-cream-50 text-olive-800 rounded-2xl hover:bg-cream-100 transition-all duration-300 font-bold text-lg shadow-lg hover:shadow-xl hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Start Shopping
                        </a>
                        <a href="/register" class="inline-flex items-center px-8 py-4 border-2 border-cream-50 text-cream-50 rounded-2xl hover:bg-cream-50 hover:text-olive-800 transition-all duration-300 font-bold text-lg hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Join StyleHub
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    function addToCart(productId) {
        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: 1,
                size: 'M',
                color: 'Default'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateCartCount();
                showNotification('Product added to cart! 🛍️', 'success');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Error adding product to cart', 'error');
        });
    }

    function toggleWishlist(productId) {
        showNotification('Wishlist feature coming soon! ❤️', 'info');
    }
    
    function showNotification(message, type) {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `fixed top-24 right-4 z-50 px-6 py-4 rounded-2xl shadow-2xl transform translate-x-full transition-all duration-500 ${
            type === 'success' ? 'bg-green-500 text-white' : 
            type === 'error' ? 'bg-red-500 text-white' : 
            'bg-blue-500 text-white'
        }`;
        notification.innerHTML = `
            <div class="flex items-center">
                <div class="mr-3">
                    ${type === 'success' ? 
                        '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>' :
                        type === 'error' ?
                        '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>' :
                        '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
                    }
                </div>
                <span class="font-medium">${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);
        
        // Remove after 4 seconds
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => {
                if (document.body.contains(notification)) {
                    document.body.removeChild(notification);
                }
            }, 500);
        }, 4000);
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
            }
        });
    }, observerOptions);

    // Observe elements for animation
    document.querySelectorAll('.group').forEach(el => {
        observer.observe(el);
    });
</script>
@endpush
