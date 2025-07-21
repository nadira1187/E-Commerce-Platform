@extends('layouts.app')

@section('title', 'Sign In')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-100 flex items-center justify-center p-4 relative overflow-hidden">
    <!-- Background decorative elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-amber-200/30 to-orange-200/30 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-tr from-yellow-200/30 to-amber-200/30 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-r from-orange-100/20 to-amber-100/20 rounded-full blur-3xl"></div>
    </div>

    <div class="w-full max-w-md relative z-10">
        <!-- Header -->
        <div class="text-center mb-8 space-y-2">
            <a href="{{ route('home') }}" class="inline-block group">
                <h1 class="text-4xl font-bold bg-gradient-to-r from-green-800 to-green-900 bg-clip-text text-transparent group-hover:from-green-700 group-hover:to-green-800 transition-all duration-300">
                    StyleHub
                </h1>
            </a>
            <p class="text-gray-600 text-lg font-medium">Welcome back to your fashion destination</p>
            <div class="w-16 h-1 bg-gradient-to-r from-green-800 to-amber-600 mx-auto rounded-full"></div>
        </div>

        <!-- Main Card -->
        <div class="backdrop-blur-sm bg-white/90 shadow-2xl border-0 rounded-2xl overflow-hidden relative">
            <div class="absolute inset-0 bg-gradient-to-br from-white/50 to-amber-50/50 pointer-events-none"></div>

            <!-- Card Header -->
            <div class="relative z-10 text-center pb-6 pt-8 px-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Sign In</h2>
                <p class="text-gray-600 text-base">Enter your credentials to access your account</p>
            </div>

            <!-- Card Content -->
            <div class="relative z-10 px-8 pb-8">
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-semibold text-gray-700">Email Address</label>
                        <div class="relative group">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5 group-focus-within:text-green-800 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                            <input id="email"
                                   type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   placeholder="Enter your email"
                                   class="pl-11 w-full h-12 px-3 py-2 border-2 border-gray-200 rounded-xl focus:border-green-800 focus:ring-2 focus:ring-green-800/20 transition-all duration-300 bg-white/70 @error('email') border-red-500 @enderror"
                                   required>
                        </div>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                        <div class="relative group">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5 group-focus-within:text-green-800 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <input id="password"
                                   type="password"
                                   name="password"
                                   placeholder="Enter your password"
                                   class="pl-11 pr-11 w-full h-12 px-3 py-2 border-2 border-gray-200 rounded-xl focus:border-green-800 focus:ring-2 focus:ring-green-800/20 transition-all duration-300 bg-white/70 @error('password') border-red-500 @enderror"
                                   required>
                            <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-green-800 transition-colors">
                                <svg id="password-eye" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <input id="remember"
                                   type="checkbox"
                                   name="remember"
                                   class="h-4 w-4 text-green-800 focus:ring-green-800 border-2 border-gray-300 rounded transition-colors">
                            <label for="remember" class="text-sm text-gray-700 font-medium">Remember me</label>
                        </div>
                        <a href="#" class="text-sm text-green-800 hover:text-green-700 font-semibold hover:underline transition-all">
                            Forgot password?
                        </a>
                    </div>

                    <!-- Sign In Button -->
                    <button type="submit"
                            class="w-full h-12 bg-gradient-to-r from-green-800 to-green-900 hover:from-green-700 hover:to-green-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] focus:ring-2 focus:ring-green-800/20 focus:outline-none">
                        <span class="signin-text">Sign In</span>
                        <span class="signin-loading hidden">
                            <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Signing In...
                        </span>
                    </button>
                </form>

                <!-- Divider -->
                <div class="my-8">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span class="bg-white px-4 text-sm text-gray-500 font-medium">Or continue with</span>
                        </div>
                    </div>
                </div>

                <!-- Social Login -->
                <div class="grid grid-cols-2 gap-4">
                    <button class="h-12 border-2 border-gray-200 hover:border-green-800 hover:bg-green-50 transition-all duration-300 rounded-xl group bg-transparent flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        <span class="font-medium text-gray-700">Google</span>
                    </button>
                    <button class="h-12 border-2 border-gray-200 hover:border-green-800 hover:bg-green-50 transition-all duration-300 rounded-xl group bg-transparent flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="#1877F2" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        <span class="font-medium text-gray-700">Facebook</span>
                    </button>
                </div>

                <!-- Sign Up Link -->
                <p class="text-center text-gray-600 mt-8">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-green-800 hover:text-green-700 font-semibold hover:underline transition-all">
                        Sign up
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const eye = document.getElementById(fieldId + '-eye');
    
    if (field.type === 'password') {
        field.type = 'text';
        eye.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L8.464 8.464m1.414 1.414L8.464 8.464m5.656 5.656l1.415 1.415m-1.415-1.415l1.415 1.415M14.828 14.828L16.243 16.243"></path>
        `;
    } else {
        field.type = 'password';
        eye.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        `;
    }
}

// Form submission loading state
document.querySelector('form').addEventListener('submit', function() {
    const button = this.querySelector('button[type="submit"]');
    const text = button.querySelector('.signin-text');
    const loading = button.querySelector('.signin-loading');
    
    text.classList.add('hidden');
    loading.classList.remove('hidden');
    button.disabled = true;
});
</script>
@endsection
