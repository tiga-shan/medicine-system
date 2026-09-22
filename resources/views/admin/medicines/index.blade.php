<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Medicine Catalog
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">All Medicines</h3>
                    <a href="{{ route('medicines.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                        + Add Medicine
                    </a>
                </div>

                <table class="min-w-full border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">Name</th>
                            <th class="px-4 py-2 text-left">Category</th>
                            <th class="px-4 py-2 text-left">Price</th>
                            <th class="px-4 py-2 text-left">Stock</th>
                            <th class="px-4 py-2 text-left">Expiry</th>
                            <th class="px-4 py-2 text-left">Supplier</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($medicines as $medicine)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $medicine->name }}</td>
                                <td class="px-4 py-2">{{ $medicine->category ?? '-' }}</td>
                                <td class="px-4 py-2">{{ number_format($medicine->price, 2) }}</td>
                                <td class="px-4 py-2 {{ $medicine->stock_quantity <= $medicine->reorder_level ? 'text-red-600 font-bold' : '' }}">
                                    {{ $medicine->stock_quantity }}
                                </td>
                                <td class="px-4 py-2 {{ \Carbon\Carbon::parse($medicine->expiry_date)->isPast() ? 'text-red-600 font-bold' : '' }}">
                                    {{ $medicine->expiry_date }}
                                </td>
                                <td class="px-4 py-2">{{ $medicine->supplier->name ?? '-' }}</td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="{{ route('medicines.edit', $medicine) }}" class="text-blue-600">Edit</a>
                                    <form action="{{ route('medicines.destroy', $medicine) }}" method="POST" class="inline" onsubmit="return confirm('Delete this medicine?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-4 text-center text-gray-500">No medicines found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $medicines->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>