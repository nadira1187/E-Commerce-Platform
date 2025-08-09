@extends('layouts.admin')

@section('title', 'Orders Management')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
    <div class="container mx-auto px-6 py-8">
         Header 
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Orders Management</h1>
            <p class="text-gray-600">Track and manage all customer orders</p>
        </div>

         Orders Table 
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Order ID</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Items</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($orders as $order)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900">#{{ $order->id }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                        {{ substr($order->user->name, 0, 1) }}
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">{{ $order->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $order->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $order->items->count() }} items</div>
                                <div class="text-xs text-gray-500">
                                    @foreach($order->items->take(2) as $item)
                                        {{ $item->product->name }}@if(!$loop->last), @endif
                                    @endforeach
                                    @if($order->items->count() > 2)
                                        +{{ $order->items->count() - 2 }} more
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900">${{ number_format($order->total_amount, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="px-3 py-1 text-xs font-semibold rounded-full border-0 focus:ring-2 focus:ring-blue-500
                                        @if($order->status == 'completed') bg-green-100 text-green-800
                                        @elseif($order->status == 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                        @elseif($order->status == 'shipped') bg-purple-100 text-purple-800
                                        @elseif($order->status == 'delivered') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800 @endif">
                                        <option value="pending" @if($order->status == 'pending') selected @endif>Pending</option>
                                        <option value="processing" @if($order->status == 'processing') selected @endif>Processing</option>
                                        <option value="shipped" @if($order->status == 'shipped') selected @endif>Shipped</option>
                                        <option value="delivered" @if($order->status == 'delivered') selected @endif>Delivered</option>
                                        <option value="cancelled" @if($order->status == 'cancelled') selected @endif>Cancelled</option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $order->created_at->format('M d, Y') }}
                                <div class="text-xs text-gray-500">{{ $order->created_at->format('h:i A') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="bg-blue-50 text-blue-600 px-3 py-1 rounded-lg hover:bg-blue-100 transition-colors text-xs">
                                        View
                                    </a>
                                    <a href="{{ route('admin.orders.invoice', $order) }}" class="bg-green-50 text-green-600 px-3 py-1 rounded-lg hover:bg-green-100 transition-colors text-xs">
                                        Invoice
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

         Pagination 
        <div class="mt-8">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection