<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Order #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-6 rounded shadow mb-6">
                <p><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $order->status)) }}</p>
                <p><strong>Delivery Address:</strong> {{ $order->delivery_address }}</p>
                <p><strong>Phone:</strong> {{ $order->phone }}</p>
                <p><strong>Total:</strong> Rs. {{ number_format($order->total_amount, 2) }}</p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="font-bold mb-3">Items</h3>
                <table class="min-w-full">
                    @foreach ($order->items as $item)
                        <tr>
                            <td class="py-1">{{ $item->medicine->name ?? 'Medicine removed' }} × {{ $item->quantity }}</td>
                            <td class="py-1 text-right">Rs. {{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

        </div>
    </div>
</x-app-layout>