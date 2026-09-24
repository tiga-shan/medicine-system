<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Order #{{ $order->id }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="p-4 bg-teal-50 text-teal-700 rounded-lg border border-teal-100">{{ session('success') }}</div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="font-bold text-slate-800">Order Status</h3>
                    <span class="px-3 py-1 text-sm rounded-full
                        @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                        @elseif($order->status === 'delivered') bg-green-100 text-green-800
                        @else bg-blue-100 text-blue-800
                        @endif">
                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                    </span>
                </div>
                <p class="text-sm text-slate-600"><strong>Delivery Address:</strong> {{ $order->delivery_address }}</p>
                <p class="text-sm text-slate-600"><strong>Phone:</strong> {{ $order->phone }}</p>
                <p class="text-sm text-slate-600"><strong>Total:</strong> Rs. {{ number_format($order->total_amount, 2) }}</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                <h3 class="font-bold text-slate-800 mb-3">Items</h3>
                <table class="min-w-full text-sm">
                    @foreach ($order->items as $item)
                        <tr>
                            <td class="py-1">{{ $item->medicine->name ?? 'Medicine removed' }} × {{ $item->quantity }}</td>
                            <td class="py-1 text-right">Rs. {{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

            @if ($order->delivery)
                <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                    <h3 class="font-bold text-slate-800 mb-2">Delivery</h3>
                    <p class="text-sm text-slate-600"><strong>Delivery Person:</strong> {{ $order->delivery->delivery_person }}</p>
                    <p class="text-sm text-slate-600"><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $order->delivery->status)) }}</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>