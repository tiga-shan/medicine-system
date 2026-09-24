<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Orders</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                @if ($orders->count() > 0)
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left border-b text-slate-500">
                                <th class="py-3">Order #</th>
                                <th class="py-3">Date</th>
                                <th class="py-3">Total</th>
                                <th class="py-3">Status</th>
                                <th class="py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr class="border-b">
                                    <td class="py-3">#{{ $order->id }}</td>
                                    <td class="py-3">{{ $order->created_at->format('d M Y') }}</td>
                                    <td class="py-3">Rs. {{ number_format($order->total_amount, 2) }}</td>
                                    <td class="py-3">
                                        <span class="px-2 py-1 text-xs rounded-full
                                            @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                            @elseif($order->status === 'delivered') bg-green-100 text-green-800
                                            @else bg-blue-100 text-blue-800
                                            @endif">
                                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        <a href="{{ route('orders.show', $order) }}" class="text-teal-600 font-medium">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">{{ $orders->links() }}</div>
                @else
                    <p class="text-center text-slate-500 py-6">You haven't placed any orders yet.
                        <a href="{{ route('shop.index') }}" class="text-teal-600 underline">Start shopping</a>
                    </p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>