<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Medicine Shop</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="p-4 bg-teal-50 text-teal-700 rounded-lg border border-teal-100">{{ session('success') }}</div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5">
                <form method="GET" action="{{ route('shop.index') }}" class="flex flex-col sm:flex-row gap-3">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search medicine..." class="flex-1 border-slate-200 rounded-lg px-4 py-2 focus:ring-teal-500 focus:border-teal-500">
                    <select name="category" class="border-slate-200 rounded-lg px-4 py-2 focus:ring-teal-500 focus:border-teal-500">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-medium px-6 py-2 rounded-lg transition">Search</button>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @forelse ($medicines as $medicine)
                    <div class="bg-white rounded-xl shadow-sm border border-slate-100 hover:shadow-md transition p-5 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-1">
                                <h3 class="font-bold text-lg text-slate-800">{{ $medicine->name }}</h3>
                                @if ($medicine->requires_prescription)
                                    <span class="text-xs bg-amber-100 text-amber-800 px-2 py-1 rounded-full whitespace-nowrap">Rx Required</span>
                                @endif
                            </div>
                            <p class="text-sm text-teal-600 font-medium mb-2">{{ $medicine->category ?? 'General' }}</p>
                            <p class="text-sm text-slate-500">{{ Str::limit($medicine->description, 80) }}</p>
                        </div>
                        <div class="mt-5 flex justify-between items-center">
                            <span class="text-xl font-bold text-slate-800">Rs. {{ number_format($medicine->price, 2) }}</span>
                            <form action="{{ route('cart.add', $medicine) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="col-span-3 text-center text-slate-500 py-10">No medicines found.</p>
                @endforelse
            </div>

            <div>{{ $medicines->links() }}</div>

        </div>
    </div>
</x-app-layout>