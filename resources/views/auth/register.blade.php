@extends('layouts.app')

@section('title', 'Create Account')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-100 flex items-center justify-center p-4 relative overflow-hidden">
    <!-- Background decorative elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-amber-200/30 to-orange-200/30 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-tr from-yellow-200/30 to-amber-200/30 rounded-full blur-3xl"></div>
        <div class="absolute top-1/3 left-1/4 w-64 h-64 bg-gradient-to-r from-orange-100/20 to-amber-100/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/3 right-1/4 w-64 h-64 bg-gradient-to-l from-yellow-100/20 to-orange-100/20 rounded-full blur-3xl"></div>
    </div>

    <div class="w-full max-w-lg relative z-10">
        <!-- Header -->
        <div class="text-center mb-8 space-y-2">
            <a href="{{ route('home') }}" class="inline-block group">
                <h1 class="text-4xl font-bold bg-gradient-to-r from-green-800 to-green-900 bg-clip-text text-transparent group-hover:from-green-700 group-hover:to-green-800 transition-all duration-300">
                    StyleHub
                </h1>
            </a>
            <p class="text-gray-600 text-lg font-medium">Join our fashion community today</p>
            <div class="w-16 h-1 bg-gradient-to-r from-green-800 to-amber-600 mx-auto rounded-full"></div>
        </div>

        <!-- Main Card -->
        <div class="backdrop-blur-sm bg-white/90 shadow-2xl border-0 rounded-2xl overflow-hidden relative">
            <div class="absolute inset-0 bg-gradient-to-br from-white/50 to-amber-50/50 pointer-events-none"></div>

            <!-- Card Header -->
            <div class="relative z-10 text-center pb-6 pt-8 px-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Create Account</h2>
                <p class="text-gray-600 text-base">Fill in your details to get started</p>
            </div>

            <!-- Card Content -->
            <div class="relative z-10 px-8 pb-8">
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Name Fields -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="first_name" class="block text-sm font-semibold text-gray-700">First Name</label>
                            <div class="relative group">
                                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5 group-focus-within:text-green-800 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <input id="first_name"
                                       type="text"
                                       name="first_name"
                                       value="{{ old('first_name') }}"
                                       placeholder="First name"
                                       class="pl-11 w-full h-12 px-3 py-2 border-2 border-gray-200 rounded-xl focus:border-green-800 focus:ring-2 focus:ring-green-800/20 transition-all duration-300 bg-white/70 @error('first_name') border-red-500 @enderror"
                                       required>
                            </div>
                            @error('first_name')
                                <p class="text-red-500 text-sm mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="last_name" class="block text-sm font-semibold text-gray-700">Last Name</label>
                            <div class="relative group">
                                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5 group-focus-within:text-green-800 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <input id="last_name"
                                       type="text"
                                       name="last_name"
                                       value="{{ old('last_name') }}"
                                       placeholder="Last name"
                                       class="pl-11 w-full h-12 px-3 py-2 border-2 border-gray-200 rounded-xl focus:border-green-800 focus:ring-2 focus:ring-green-800/20 transition-all duration-300 bg-white/70 @error('last_name') border-red-500 @enderror"
                                       required>
                            </div>
                            @error('last_name')
                                <p class="text-red-500 text-sm mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

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

                    <!-- Phone Field -->
                    <div class="space-y-2">
                        <label for="phone" class="block text-sm font-semibold text-gray-700">Phone Number</label>
                        <div class="relative group">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5 group-focus-within:text-green-800 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <input id="phone"
                                   type="tel"
                                   name="phone"
                                   value="{{ old('phone') }}"
                                   placeholder="Enter your phone number"
                                   class="pl-11 w-full h-12 px-3 py-2 border-2 border-gray-200 rounded-xl focus:border-green-800 focus:ring-2 focus:ring-green-800/20 transition-all duration-300 bg-white/70 @error('phone') border-red-500 @enderror"
                                   required>
                        </div>
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Account Type -->
                    <div class="space-y-2">
                        <label for="user_type" class="block text-sm font-semibold text-gray-700">Account Type</label>
                        <select id="user_type"
                                name="user_type"
                                class="w-full h-12 px-3 py-2 border-2 border-gray-200 rounded-xl focus:border-green-800 focus:ring-2 focus:ring-green-800/20 transition-all duration-300 bg-white/70 @error('user_type') border-red-500 @enderror"
                                required>
                            <option value="">Select account type</option>
                            <option value="customer" {{ old('user_type') === 'customer' ? 'selected' : '' }}>Customer</option>
                            <option value="seller" {{ old('user_type') === 'seller' ? 'selected' : '' }}>Seller</option>
                        </select>
                        @error('user_type')
                            <p class="text-red-500 text-sm mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Fields -->
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                            <div class="relative group">
                                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5 group-focus-within:text-green-800 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                <input id="password"
                                       type="password"
                                       name="password"
                                       placeholder="Create a password"
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

                        <div class="space-y-2">
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Confirm Password</label>
                            <div class="relative group">
                                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5 group-focus-within:text-green-800 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                <input id="password_confirmation"
                                       type="password"
                                       name="password_confirmation"
                                       placeholder="Confirm your password"
                                       class="pl-11 pr-11 w-full h-12 px-3 py-2 border-2 border-gray-200 rounded-xl focus:border-green-800 focus:ring-2 focus:ring-green-800/20 transition-all duration-300 bg-white/70"
                                       required>
                                <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-green-800 transition-colors">
                                    <svg id="password_confirmation-eye" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Terms Checkbox -->
                    <div class="flex items-start space-x-3">
                        <input id="terms"
                               type="checkbox"
                               name="terms"
                               class="mt-1 h-4 w-4 text-green-800 focus:ring-green-800 border-2 border-gray-300 rounded transition-colors"
                               required>
                        <label for="terms" class="text-sm text-gray-700 leading-relaxed">
                            I agree to the 
                            <a href="#" class="text-green-800 hover:text-green-700 font-semibold hover:underline">Terms of Service</a> 
                            and 
                            <a href="#" class="text-green-800 hover:text-green-700 font-semibold hover:underline">Privacy Policy</a>
                        </label>
                    </div>

                    <!-- Create Account Button -->
                    <button type="submit"
                            class="w-full h-12 bg-gradient-to-r from-green-800 to-green-900 hover:from-green-700 hover:to-green-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] focus:ring-2 focus:ring-green-800/20 focus:outline-none">
                        <span class="register-text">Create Account</span>
                        <span class="register-loading hidden">
                            <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Creating Account...
                        </span>
                    </button>
                </form>

                <!-- Sign In Link -->
                <p class="text-center text-gray-600 mt-8">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-green-800 hover:text-green-700 font-semibold hover:underline transition-all">
                        Sign in
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
    const text = button.querySelector('.register-text');
    const loading = button.querySelector('.register-loading');
    
    text.classList.add('hidden');
    loading.classList.remove('hidden');
    button.disabled = true;
});
</script>
@endsection
