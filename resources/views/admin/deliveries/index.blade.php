<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Deliveries</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-teal-50 text-teal-700 rounded-lg border border-teal-100">{{ session('success') }}</div>
                @endif

                <div class="space-y-4">
                    @forelse ($orders as $order)
                        <div class="border border-slate-100 rounded-xl p-5">
                            <div class="flex justify-between items-start flex-wrap gap-2">
                                <div>
                                    <p class="font-bold text-slate-800">Order #{{ $order->id }} — {{ $order->user->name ?? 'N/A' }}</p>
                                    <p class="text-sm text-slate-500">{{ $order->delivery_address }} | {{ $order->phone }}</p>
                                </div>
                                <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">
                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                </span>
                            </div>

                            @if ($order->delivery)
                                <div class="mt-4 p-4 bg-slate-50 rounded-lg">
                                    <p class="text-sm text-slate-700"><strong>Delivery Person:</strong> {{ $order->delivery->delivery_person }} ({{ $order->delivery->delivery_phone }})</p>
                                    <form action="{{ route('admin.deliveries.update-status', $order) }}" method="POST" class="flex gap-2 mt-3">
                                        @csrf
                                        @method('PATCH')
                                        <select name="delivery_status" class="border-slate-200 rounded-lg px-3 py-2 text-sm">
                                            @foreach (['assigned', 'picked_up', 'in_transit', 'delivered'] as $status)
                                                <option value="{{ $status }}" {{ $order->delivery->status === $status ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $status)) }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">Update</button>
                                    </form>
                                </div>
                            @else
                                <form action="{{ route('admin.deliveries.assign', $order) }}" method="POST" class="mt-4 flex flex-wrap gap-2">
                                    @csrf
                                    <input type="text" name="delivery_person" placeholder="Delivery person name" class="border-slate-200 rounded-lg px-3 py-2 text-sm flex-1 min-w-[180px]" required>
                                    <input type="text" name="delivery_phone" placeholder="Phone" class="border-slate-200 rounded-lg px-3 py-2 text-sm" required>
                                    <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">Assign Delivery</button>
                                </form>
                            @endif
                        </div>
                    @empty
                        <p class="text-center text-slate-500 py-6">No orders ready for delivery.</p>
                    @endforelse
                </div>

                <div class="mt-4">{{ $orders->links() }}</div>

            </div>
        </div>
    </div>
</x-app-layout>