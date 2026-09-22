<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Cart
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-6 rounded shadow">
                @if (count($cart) > 0)
                    <table class="min-w-full border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left">Medicine</th>
                                <th class="px-4 py-2 text-left">Price</th>
                                <th class="px-4 py-2 text-left">Quantity</th>
                                <th class="px-4 py-2 text-left">Subtotal</th>
                                <th class="px-4 py-2 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $medicineId => $item)
                                <tr class="border-t">
                                    <td class="px-4 py-2">
                                        {{ $item['name'] }}
                                        @if ($item['requires_prescription'])
                                            <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded ml-1">Rx</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">Rs. {{ number_format($item['price'], 2) }}</td>
                                    <td class="px-4 py-2">
                                        <form action="{{ route('cart.update', $medicineId) }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-16 border rounded px-2 py-1">
                                            <button type="submit" class="text-blue-600 text-sm">Update</button>
                                        </form>
                                    </td>
                                    <td class="px-4 py-2">Rs. {{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                    <td class="px-4 py-2">
                                        <form action="{{ route('cart.remove', $medicineId) }}" method="POST" onsubmit="return confirm('Remove this item?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-6 flex justify-between items-center">
                        <span class="text-xl font-bold">Total: Rs. {{ number_format($total, 2) }}</span>
                        <a href="{{ route('shop.index') }}" class="text-blue-600 underline">Continue Shopping</a>
                    </div>

                    <div class="mt-4 text-right">
                        <a href="#" class="bg-green-600 text-white px-6 py-2 rounded inline-block">
                            Proceed to Checkout
                        </a>
                    </div>
                @else
                    <p class="text-center text-gray-500">Your cart is empty.</p>
                    <div class="text-center mt-4">
                        <a href="{{ route('shop.index') }}" class="text-blue-600 underline">Browse Medicines</a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>