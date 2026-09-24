<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Medicine Catalog</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-teal-50 text-teal-700 rounded-lg border border-teal-100">{{ session('success') }}</div>
                @endif

                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-lg font-bold text-slate-800">All Medicines</h3>
                    <a href="{{ route('medicines.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white font-medium px-4 py-2 rounded-lg transition">
                        + Add Medicine
                    </a>
                </div>

                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left border-b text-slate-500">
                            <th class="py-3">Name</th>
                            <th class="py-3">Category</th>
                            <th class="py-3">Price</th>
                            <th class="py-3">Stock</th>
                            <th class="py-3">Expiry</th>
                            <th class="py-3">Supplier</th>
                            <th class="py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($medicines as $medicine)
                            <tr class="border-b">
                                <td class="py-3 font-medium text-slate-800">{{ $medicine->name }}</td>
                                <td class="py-3">{{ $medicine->category ?? '-' }}</td>
                                <td class="py-3">{{ number_format($medicine->price, 2) }}</td>
                                <td class="py-3">
                                    <span class="{{ $medicine->stock_quantity <= $medicine->reorder_level ? 'text-red-600 font-bold' : '' }}">
                                        {{ $medicine->stock_quantity }}
                                    </span>
                                </td>
                                <td class="py-3 {{ \Carbon\Carbon::parse($medicine->expiry_date)->isPast() ? 'text-red-600 font-bold' : '' }}">
                                    {{ $medicine->expiry_date }}
                                </td>
                                <td class="py-3">{{ $medicine->supplier->name ?? '-' }}</td>
                                <td class="py-3 space-x-2">
                                    <a href="{{ route('medicines.edit', $medicine) }}" class="text-teal-600 font-medium">Edit</a>
                                    <form action="{{ route('medicines.destroy', $medicine) }}" method="POST" class="inline" onsubmit="return confirm('Delete this medicine?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 font-medium">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="py-6 text-center text-slate-500">No medicines found.</td></tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">{{ $medicines->links() }}</div>

            </div>
        </div>
    </div>
</x-app-layout>