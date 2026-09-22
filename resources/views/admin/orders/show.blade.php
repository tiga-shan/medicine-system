<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Order #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-6 rounded shadow">
                <h3 class="font-bold mb-3">Customer & Delivery</h3>
                <p><strong>Customer:</strong> {{ $order->user->name }} ({{ $order->user->email }})</p>
                <p><strong>Delivery Address:</strong> {{ $order->delivery_address }}</p>
                <p><strong>Phone:</strong> {{ $order->phone }}</p>
                <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
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
                <div class="border-t mt-3 pt-3 flex justify-between font-bold">
                    <span>Total</span>
                    <span>Rs. {{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>

            @if ($order->prescription)
                <div class="bg-white p-6 rounded shadow">
                    <h3 class="font-bold mb-3">Prescription</h3>
                    <p><strong>Status:</strong>
                        <span class="px-2 py-1 text-xs rounded
                            @if($order->prescription->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($order->prescription->status === 'approved') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($order->prescription->status) }}
                        </span>
                    </p>
                    <img src="{{ asset('storage/' . $order->prescription->image_path) }}" alt="Prescription" class="mt-3 max-w-sm border rounded">
                    <p class="mt-2 text-sm text-gray-500">
                        Full prescription approval/rejection is on the "Prescriptions" page.
                    </p>
                </div>
            @endif

            <div class="bg-white p-6 rounded shadow">
                <h3 class="font-bold mb-3">Update Status</h3>
                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="flex gap-2">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="border rounded px-3 py-2">
                        @foreach (['pending', 'approved', 'packed', 'out_for_delivery', 'delivered', 'cancelled'] as $status)
                            <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $status)) }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>