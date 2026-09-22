<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Medicine
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('medicines.update', $medicine) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Name *</label>
                        <input type="text" name="name" value="{{ old('name', $medicine->name) }}" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Generic Name</label>
                        <input type="text" name="generic_name" value="{{ old('generic_name', $medicine->generic_name) }}" class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Category</label>
                        <input type="text" name="category" value="{{ old('category', $medicine->category) }}" class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Description</label>
                        <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description', $medicine->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block font-medium mb-1">Price *</label>
                            <input type="number" step="0.01" name="price" value="{{ old('price', $medicine->price) }}" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Stock Quantity *</label>
                            <input type="number" name="stock_quantity" value="{{ old('stock_quantity', $medicine->stock_quantity) }}" class="w-full border rounded px-3 py-2" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block font-medium mb-1">Reorder Level *</label>
                            <input type="number" name="reorder_level" value="{{ old('reorder_level', $medicine->reorder_level) }}" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Expiry Date *</label>
                            <input type="date" name="expiry_date" value="{{ old('expiry_date', \Carbon\Carbon::parse($medicine->expiry_date)->format('Y-m-d')) }}" class="w-full border rounded px-3 py-2" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Supplier</label>
                        <select name="supplier_id" class="w-full border rounded px-3 py-2">
                            <option value="">-- None --</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id', $medicine->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="requires_prescription" value="1" {{ old('requires_prescription', $medicine->requires_prescription) ? 'checked' : '' }}>
                            <span class="ml-2">Requires Prescription</span>
                        </label>
                    </div>

                    <div class="flex space-x-2">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Medicine</button>
                        <a href="{{ route('medicines.index') }}" class="bg-gray-300 px-4 py-2 rounded">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>