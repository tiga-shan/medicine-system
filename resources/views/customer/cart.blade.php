<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Cart</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-teal-50 text-teal-700 rounded-lg border border-teal-100">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-4 p-4 bg-red-50 text-red-700 rounded-lg border border-red-100">{{ session('error') }}</div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                @if (count($cart) > 0)
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left border-b text-slate-500">
                                <th class="py-3">Medicine</th>
                                <th class="py-3">Price</th>
                                <th class="py-3">Quantity</th>
                                <th class="py-3">Subtotal</th>
                                <th class="py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $medicineId => $item)
                                <tr class="border-b">
                                    <td class="py-3">
                                        {{ $item['name'] }}
                                        @if ($item['requires_prescription'])
                                            <span class="text-xs bg-amber-100 text-amber-800 px-2 py-1 rounded-full ml-1">Rx</span>
                                        @endif
                                    </td>
                                    <td class="py-3">Rs. {{ number_format($item['price'], 2) }}</td>
                                    <td class="py-3">
                                        <form action="{{ route('cart.update', $medicineId) }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-16 border-slate-200 rounded-lg px-2 py-1">
                                            <button type="submit" class="text-teal-600 text-sm font-medium">Update</button>
                                        </form>
                                    </td>
                                    <td class="py-3 font-medium">Rs. {{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                    <td class="py-3">
                                        <form action="{{ route('cart.remove', $medicineId) }}" method="POST" onsubmit="return confirm('Remove this item?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 text-sm font-medium">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-6 flex justify-between items-center">
                        <span class="text-xl font-bold text-slate-800">Total: Rs. {{ number_format($total, 2) }}</span>
                        <a href="{{ route('shop.index') }}" class="text-teal-600 font-medium hover:underline">Continue Shopping</a>
                    </div>

                    <div class="mt-4 text-right">
                        <a href="{{ route('checkout.index') }}" class="bg-teal-600 hover:bg-teal-700 text-white font-medium px-6 py-3 rounded-lg inline-block transition">
                            Proceed to Checkout
                        </a>
                    </div>
                @else
                    <p class="text-center text-slate-500 py-6">Your cart is empty.</p>
                    <div class="text-center">
                        <a href="{{ route('shop.index') }}" class="text-teal-600 font-medium hover:underline">Browse Medicines</a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>