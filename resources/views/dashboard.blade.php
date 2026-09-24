<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-gradient-to-r from-teal-600 to-teal-700 text-white rounded-xl p-8 shadow">
                <h3 class="text-2xl font-bold mb-1">Welcome back, {{ Auth::user()->name }} 👋</h3>
                <p class="text-teal-100">Here's a quick look at your account.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <a href="{{ route('shop.index') }}" class="bg-white rounded-xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition flex items-center gap-4">
                    <div class="bg-teal-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-slate-800">Browse Medicines</p>
                        <p class="text-sm text-slate-500">Shop now</p>
                    </div>
                </a>

                <a href="{{ route('cart.index') }}" class="bg-white rounded-xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition flex items-center gap-4">
                    <div class="bg-orange-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-slate-800">My Cart</p>
                        <p class="text-sm text-slate-500">{{ $cartCount }} item(s)</p>
                    </div>
                </a>

                <a href="{{ route('orders.index') }}" class="bg-white rounded-xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition flex items-center gap-4">
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-slate-800">My Orders</p>
                        <p class="text-sm text-slate-500">View history</p>
                    </div>
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                <h3 class="font-bold text-slate-800 mb-4">Recent Orders</h3>

                @if ($recentOrders->count() > 0)
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left border-b text-slate-500">
                                <th class="py-2">Order #</th>
                                <th class="py-2">Date</th>
                                <th class="py-2">Total</th>
                                <th class="py-2">Status</th>
                                <th class="py-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentOrders as $order)
                                <tr class="border-b">
                                    <td class="py-2">#{{ $order->id }}</td>
                                    <td class="py-2">{{ $order->created_at->format('d M Y') }}</td>
                                    <td class="py-2">Rs. {{ number_format($order->total_amount, 2) }}</td>
                                    <td class="py-2">
                                        <span class="px-2 py-1 text-xs rounded
                                            @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                            @elseif($order->status === 'delivered') bg-green-100 text-green-800
                                            @else bg-blue-100 text-blue-800
                                            @endif">
                                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                        </span>
                                    </td>
                                    <td class="py-2">
                                        <a href="{{ route('orders.show', $order) }}" class="text-teal-600 font-medium">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-slate-500 text-sm">You haven't placed any orders yet.
                        <a href="{{ route('shop.index') }}" class="text-teal-600 underline">Start shopping</a>
                    </p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>