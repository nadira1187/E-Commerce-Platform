@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-amber-50 via-cream-50 to-emerald-50">
    <div class="container mx-auto px-6 py-8">
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-5xl font-bold bg-gradient-to-r from-emerald-800 via-emerald-600 to-emerald-700 bg-clip-text text-transparent mb-3">
                        Admin Dashboard
                    </h1>
                    <p class="text-xl text-emerald-700 font-medium">Welcome back! Here's what's happening with your store.</p>
                </div>
                <div class="hidden lg:block">
                    <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 p-6 rounded-2xl shadow-2xl">
                        <div class="text-cream-100 text-center">
                            <div class="text-3xl font-bold">{{ date('d') }}</div>
                            <div class="text-sm opacity-90">{{ date('M Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <!-- Total Products -->
            <div class="group relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-3xl transform rotate-1 group-hover:rotate-2 transition-transform duration-300"></div>
                <div class="relative bg-gradient-to-br from-cream-50 to-white p-8 rounded-3xl shadow-xl border border-emerald-100 hover:shadow-2xl transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-4 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-wider">Total Products</p>
                            <p class="text-4xl font-bold text-emerald-800">{{ $stats['total_products'] }}</p>
                        </div>
                    </div>
                    <div class="flex items-center text-emerald-600">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm font-medium">Active inventory</span>
                    </div>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="group relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-amber-400 to-orange-500 rounded-3xl transform -rotate-1 group-hover:-rotate-2 transition-transform duration-300"></div>
                <div class="relative bg-gradient-to-br from-cream-50 to-white p-8 rounded-3xl shadow-xl border border-amber-100 hover:shadow-2xl transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-4 bg-gradient-to-br from-amber-500 to-orange-500 rounded-2xl shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold text-amber-600 uppercase tracking-wider">Total Orders</p>
                            <p class="text-4xl font-bold text-amber-800">{{ $stats['total_orders'] }}</p>
                        </div>
                    </div>
                    <div class="flex items-center text-amber-600">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm font-medium">All time orders</span>
                    </div>
                </div>
            </div>

            <!-- Total Customers -->
            <div class="group relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl transform rotate-1 group-hover:rotate-2 transition-transform duration-300"></div>
                <div class="relative bg-gradient-to-br from-cream-50 to-white p-8 rounded-3xl shadow-xl border border-emerald-100 hover:shadow-2xl transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-4 bg-gradient-to-br from-emerald-600 to-teal-600 rounded-2xl shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 0a2.25 2.25 0 01-2.25 2.25H3a2.25 2.25 0 01-2.25-2.25V6A2.25 2.25 0 013 3.75h16.5A2.25 2.25 0 0121.75 6v12a2.25 2.25 0 01-2.25 2.25z"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold text-emerald-600 uppercase tracking-wider">Total Customers</p>
                            <p class="text-4xl font-bold text-emerald-800">{{ $stats['total_customers'] }}</p>
                        </div>
                    </div>
                    <div class="flex items-center text-emerald-600">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm font-medium">Registered users</span>
                    </div>
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="group relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-yellow-400 to-amber-500 rounded-3xl transform -rotate-1 group-hover:-rotate-2 transition-transform duration-300"></div>
                <div class="relative bg-gradient-to-br from-cream-50 to-white p-8 rounded-3xl shadow-xl border border-yellow-100 hover:shadow-2xl transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-4 bg-gradient-to-br from-yellow-500 to-amber-500 rounded-2xl shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold text-yellow-600 uppercase tracking-wider">Total Revenue</p>
                            <p class="text-4xl font-bold text-yellow-800">${{ number_format($stats['total_revenue'], 2) }}</p>
                        </div>
                    </div>
                    <div class="flex items-center text-yellow-600">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm font-medium">Completed orders</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders Section -->
        <div class="bg-gradient-to-br from-white via-cream-50 to-emerald-50 rounded-3xl shadow-2xl border border-emerald-100 mb-12 overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 p-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold text-white mb-2">Recent Orders</h2>
                        <p class="text-emerald-100">Latest customer orders and their status</p>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-emerald-50 to-cream-50">
                        <tr>
                            <th class="px-8 py-6 text-left text-sm font-bold text-emerald-800 uppercase tracking-wider">Order ID</th>
                            <th class="px-8 py-6 text-left text-sm font-bold text-emerald-800 uppercase tracking-wider">Customer</th>
                            <th class="px-8 py-6 text-left text-sm font-bold text-emerald-800 uppercase tracking-wider">Amount</th>
                            <th class="px-8 py-6 text-left text-sm font-bold text-emerald-800 uppercase tracking-wider">Status</th>
                            <th class="px-8 py-6 text-left text-sm font-bold text-emerald-800 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-emerald-100">
                        @forelse($stats['recent_orders'] as $order)
                        <tr class="hover:bg-gradient-to-r hover:from-emerald-50 hover:to-cream-50 transition-all duration-200">
                            <td class="px-8 py-6 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-emerald-500 rounded-full mr-3"></div>
                                    <span class="text-lg font-bold text-emerald-800">#{{ $order->id }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                        {{ substr($order->user->name, 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-lg font-semibold text-gray-800">{{ $order->user->name }}</div>
                                        <div class="text-sm text-emerald-600">{{ $order->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap">
                                <span class="text-2xl font-bold text-emerald-700">${{ number_format($order->total_amount, 2) }}</span>
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap">
                                <span class="px-4 py-2 inline-flex text-sm leading-5 font-bold rounded-full shadow-lg
                                    @if($order->status == 'completed') bg-gradient-to-r from-green-400 to-green-500 text-white
                                    @elseif($order->status == 'pending') bg-gradient-to-r from-yellow-400 to-amber-500 text-white
                                    @elseif($order->status == 'processing') bg-gradient-to-r from-blue-400 to-blue-500 text-white
                                    @else bg-gradient-to-r from-gray-400 to-gray-500 text-white @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap">
                                <div class="text-lg font-semibold text-gray-800">{{ $order->created_at->format('M d, Y') }}</div>
                                <div class="text-sm text-emerald-600">{{ $order->created_at->format('h:i A') }}</div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-12 text-center">
                                <div class="text-emerald-600">
                                    <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                    <p class="text-xl font-semibold">No recent orders</p>
                                    <p class="text-emerald-500">Orders will appear here once customers start purchasing</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <a href="{{ route('admin.products.create') }}" class="group relative overflow-hidden rounded-3xl shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 via-emerald-600 to-emerald-700"></div>
                <div class="relative p-8 text-white">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-4 bg-white/20 backdrop-blur-sm rounded-2xl">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <h3 class="text-2xl font-bold">Add Product</h3>
                            <p class="text-emerald-100">Create new product</p>
                        </div>
                    </div>
                    <div class="flex items-center text-emerald-100">
                        <span class="text-sm font-medium">Click to add new product →</span>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.orders') }}" class="group relative overflow-hidden rounded-3xl shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-br from-amber-500 via-orange-500 to-red-500"></div>
                <div class="relative p-8 text-white">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-4 bg-white/20 backdrop-blur-sm rounded-2xl">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <h3 class="text-2xl font-bold">Manage Orders</h3>
                            <p class="text-orange-100">{{ $stats['pending_orders'] }} pending</p>
                        </div>
                    </div>
                    <div class="flex items-center text-orange-100">
                        <span class="text-sm font-medium">View all orders →</span>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.reviews') }}" class="group relative overflow-hidden rounded-3xl shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-500 via-purple-600 to-indigo-600"></div>
                <div class="relative p-8 text-white">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-4 bg-white/20 backdrop-blur-sm rounded-2xl">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <h3 class="text-2xl font-bold">Reviews</h3>
                            <p class="text-purple-100">Manage reviews</p>
                        </div>
                    </div>
                    <div class="flex items-center text-purple-100">
                        <span class="text-sm font-medium">View all reviews →</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<style>
    .cream-50 { background-color: #fefdf8; }
    .cream-100 { background-color: #fdf8f0; }
</style>
@endsection