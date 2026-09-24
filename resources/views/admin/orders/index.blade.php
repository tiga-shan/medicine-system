<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">All Orders</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-teal-50 text-teal-700 rounded-lg border border-teal-100">{{ session('success') }}</div>
                @endif

                <form method="GET" class="mb-4">
                    <select name="status" onchange="this.form.submit()" class="border-slate-200 rounded-lg px-4 py-2">
                        <option value="">All Statuses</option>
                        @foreach (['pending', 'approved', 'packed', 'out_for_delivery', 'delivered', 'cancelled'] as $status)
                            <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $status)) }}</option>
                        @endforeach
                    </select>
                </form>

                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left border-b text-slate-500">
                            <th class="py-3">Order #</th>
                            <th class="py-3">Customer</th>
                            <th class="py-3">Total</th>
                            <th class="py-3">Status</th>
                            <th class="py-3">Date</th>
                            <th class="py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr class="border-b">
                                <td class="py-3 font-medium">#{{ $order->id }}</td>
                                <td class="py-3">{{ $order->user->name ?? 'N/A' }}</td>
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
                                <td class="py-3">{{ $order->created_at->format('d M Y') }}</td>
                                <td class="py-3"><a href="{{ route('admin.orders.show', $order) }}" class="text-teal-600 font-medium">View</a></td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="py-6 text-center text-slate-500">No orders found.</td></tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">{{ $orders->links() }}</div>

            </div>
        </div>
    </div>
</x-app-layout>