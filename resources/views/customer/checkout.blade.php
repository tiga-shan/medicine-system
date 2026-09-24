<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Checkout</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if ($errors->any())
                <div class="p-4 bg-red-50 text-red-700 rounded-lg border border-red-100">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                <h3 class="font-bold text-slate-800 mb-4">Order Summary</h3>
                <table class="min-w-full text-sm">
                    @foreach ($cart as $item)
                        <tr>
                            <td class="py-1">{{ $item['name'] }} × {{ $item['quantity'] }}</td>
                            <td class="py-1 text-right">Rs. {{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                        </tr>
                    @endforeach
                </table>
                <div class="border-t mt-3 pt-3 flex justify-between font-bold text-slate-800">
                    <span>Total</span>
                    <span>Rs. {{ number_format($total, 2) }}</span>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium text-slate-700 mb-1">Delivery Address *</label>
                        <textarea name="delivery_address" class="w-full border-slate-200 rounded-lg px-4 py-2 focus:ring-teal-500 focus:border-teal-500" required>{{ old('delivery_address') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-slate-700 mb-1">Phone Number *</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border-slate-200 rounded-lg px-4 py-2 focus:ring-teal-500 focus:border-teal-500" required>
                    </div>

                    @if ($requiresPrescription)
                        <div class="mb-4 p-4 bg-amber-50 border border-amber-200 rounded-lg">
                            <label class="block font-medium text-slate-700 mb-1">
                                Upload Prescription * <span class="text-sm text-slate-500">(one or more items require this)</span>
                            </label>
                            <input type="file" name="prescription" accept=".jpg,.jpeg,.png,.pdf" class="w-full border-slate-200 rounded-lg px-4 py-2" required>
                        </div>
                    @endif

                    <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-medium px-6 py-3 rounded-lg transition">
                        Confirm Order
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>