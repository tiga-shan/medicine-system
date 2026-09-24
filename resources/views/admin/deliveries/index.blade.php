<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Deliveries
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="space-y-4">
                    @forelse ($orders as $order)
                        <div class="border rounded p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p><strong>Order #{{ $order->id }}</strong> — {{ $order->user->name ?? 'N/A' }}</p>
                                    <p class="text-sm text-gray-500">{{ $order->delivery_address }} | {{ $order->phone }}</p>
                                    <p class="text-sm mt-1">Order Status:
                                        <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded">
                                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                            @if ($order->delivery)
                                <div class="mt-3 p-3 bg-gray-50 rounded">
                                    <p><strong>Delivery Person:</strong> {{ $order->delivery->delivery_person }} ({{ $order->delivery->delivery_phone }})</p>
                                    <form action="{{ route('admin.deliveries.update-status', $order) }}" method="POST" class="flex gap-2 mt-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="delivery_status" class="border rounded px-3 py-2">
                                            @foreach (['assigned', 'picked_up', 'in_transit', 'delivered'] as $status)
                                                <option value="{{ $status }}" {{ $order->delivery->status === $status ? 'selected' : '' }}>
                                                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded text-sm">Update</button>
                                    </form>
                                </div>
                            @else
                                <form action="{{ route('admin.deliveries.assign', $order) }}" method="POST" class="mt-3 flex gap-2">
                                    @csrf
                                    <input type="text" name="delivery_person" placeholder="Delivery person name" class="border rounded px-3 py-2" required>
                                    <input type="text" name="delivery_phone" placeholder="Phone" class="border rounded px-3 py-2" required>
                                    <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded text-sm">Assign Delivery</button>
                                </form>
                            @endif
                        </div>
                    @empty
                        <p class="text-center text-gray-500">No orders ready for delivery.</p>
                    @endforelse
                </div>

                <div class="mt-4">
                    {{ $orders->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>