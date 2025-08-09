<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - StyleHub Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
        }
        .line-clamp-2 { 
            display: -webkit-box; 
            -webkit-line-clamp: 2; 
            -webkit-box-orient: vertical; 
            overflow: hidden; 
        }
        .cream-50 { background-color: #fefdf8; }
        .cream-100 { background-color: #fdf8f0; }
        .cream-200 { background-color: #faf5e6; }
    </style>
</head>
<body class="bg-gradient-to-br from-amber-50 via-cream-50 to-emerald-50">
    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-emerald-800 via-emerald-700 to-emerald-600 shadow-2xl border-b-4 border-emerald-900 sticky top-0 z-50 backdrop-blur-sm">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center space-x-12">
                    <a href="{{ route('admin.dashboard') }}" class="text-3xl font-black text-orange-200">
                        StyleHub Admin
                    </a>
                    
                    <div class="hidden md:flex space-x-8">
                        <a href="{{ route('admin.dashboard') }}" class="relative group px-4 py-2 text-cream-100 hover:text-white font-semibold transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'text-white' : '' }}">
                            Dashboard
                            <span class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-yellow-400 to-amber-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 {{ request()->routeIs('admin.dashboard') ? 'scale-x-100' : '' }}"></span>
                        </a>
                        <a href="{{ route('admin.products') }}" class="relative group px-4 py-2 text-cream-100 hover:text-white font-semibold transition-all duration-300 {{ request()->routeIs('admin.products*') ? 'text-white' : '' }}">
                            Products
                            <span class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-yellow-400 to-amber-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 {{ request()->routeIs('admin.products*') ? 'scale-x-100' : '' }}"></span>
                        </a>
                        <a href="{{ route('admin.orders') }}" class="relative group px-4 py-2 text-cream-100 hover:text-white font-semibold transition-all duration-300 {{ request()->routeIs('admin.orders*') ? 'text-white' : '' }}">
                            Orders
                            <span class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-yellow-400 to-amber-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 {{ request()->routeIs('admin.orders*') ? 'scale-x-100' : '' }}"></span>
                        </a>
                        <a href="{{ route('admin.reviews') }}" class="relative group px-4 py-2 text-cream-100 hover:text-white font-semibold transition-all duration-300 {{ request()->routeIs('admin.reviews*') ? 'text-white' : '' }}">
                            Reviews
                            <span class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-yellow-400 to-amber-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 {{ request()->routeIs('admin.reviews*') ? 'scale-x-100' : '' }}"></span>
                        </a>
                    </div>
                </div>

                <div class="flex items-center space-x-6">
                    <!-- Notifications -->
                    <div class="relative">
                        <button class="p-3 bg-white/10 backdrop-blur-sm rounded-2xl hover:bg-white/20 transition-all duration-300 group">
                            <svg class="w-6 h-6 text-cream-100 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM10.07 2.82l3.12 3.12M7.05 5.84L3.93 8.96M2 12h4M5.84 16.95l3.12-3.12"></path>
                            </svg>
                        </button>
                        @if($stats['pending_orders'] ?? 0 > 0)
                        <span class="absolute -top-2 -right-2 bg-gradient-to-r from-red-500 to-red-600 text-white text-xs font-bold rounded-full h-6 w-6 flex items-center justify-center shadow-lg">
                            {{ $stats['pending_orders'] ?? 0 }}
                        </span>
                        @endif
                    </div>

                    <!-- User Profile -->
                    <div class="relative group">
                        <button class="flex items-center space-x-3 bg-white/10 backdrop-blur-sm rounded-2xl px-4 py-3 hover:bg-white/20 transition-all duration-300">
                            <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-amber-500 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="text-left hidden lg:block">
                                <div class="font-bold text-white">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-cream-200">Administrator</div>
                            </div>
                            <svg class="w-4 h-4 text-cream-200 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-6 py-3 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg font-semibold">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @if(session('success'))
            <div class="mx-6 mt-6">
                <div class="bg-gradient-to-r from-green-400 to-emerald-500 border border-green-300 text-white px-6 py-4 rounded-2xl shadow-lg" role="alert">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-semibold">{{ session('success') }}</span>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mx-6 mt-6">
                <div class="bg-gradient-to-r from-red-400 to-red-500 border border-red-300 text-white px-6 py-4 rounded-2xl shadow-lg" role="alert">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-semibold">{{ session('error') }}</span>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-emerald-800 to-emerald-700 border-t-4 border-emerald-900 mt-16">
        <div class="container mx-auto px-6 py-12">
            <div class="text-center">
                <div class="text-3xl font-bold bg-gradient-to-r from-cream-100 to-white bg-clip-text text-transparent mb-4">
                    StyleHub Admin
                </div>
                <p class="text-orange-100 text-lg">&copy; {{ date('Y') }} StyleHub Admin Panel. All rights reserved.</p>
                <div class="mt-6 flex justify-center space-x-6">
                    <a href="#" class="text-orange-100 hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="text-orange-100 hover:text-white transition-colors">Terms of Service</a>
                    <a href="#" class="text-orange-100 hover:text-white transition-colors">Support</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>