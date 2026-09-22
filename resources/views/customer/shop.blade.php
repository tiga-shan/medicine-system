<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Medicine Shop
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-4 rounded shadow mb-6">
                <form method="GET" action="{{ route('shop.index') }}" class="flex gap-4">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search medicine..." class="flex-1 border rounded px-3 py-2">
                    <select name="category" class="border rounded px-3 py-2">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Search</button>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @forelse ($medicines as $medicine)
                    <div class="bg-white p-4 rounded shadow flex flex-col justify-between">
                        <div>
                            <h3 class="font-bold text-lg">{{ $medicine->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $medicine->category ?? 'General' }}</p>
                            <p class="text-sm mt-2">{{ Str::limit($medicine->description, 80) }}</p>
                            @if ($medicine->requires_prescription)
                                <span class="inline-block mt-2 text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">
                                    Prescription Required
                                </span>
                            @endif
                        </div>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-xl font-bold">Rs. {{ number_format($medicine->price, 2) }}</span>
                            <form action="{{ route('cart.add', $medicine) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="col-span-3 text-center text-gray-500">No medicines found.</p>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $medicines->links() }}
            </div>

        </div>
    </div>
</x-app-layout>