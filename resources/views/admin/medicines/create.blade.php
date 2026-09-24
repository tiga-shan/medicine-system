<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add New Medicine</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 text-red-700 rounded-lg border border-red-100">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('medicines.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block font-medium text-slate-700 mb-1">Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full border-slate-200 rounded-lg px-4 py-2 focus:ring-teal-500 focus:border-teal-500" required>
                    </div>

                    <div>
                        <label class="block font-medium text-slate-700 mb-1">Generic Name</label>
                        <input type="text" name="generic_name" value="{{ old('generic_name') }}" class="w-full border-slate-200 rounded-lg px-4 py-2 focus:ring-teal-500 focus:border-teal-500">
                    </div>

                    <div>
                        <label class="block font-medium text-slate-700 mb-1">Category</label>
                        <input type="text" name="category" value="{{ old('category') }}" class="w-full border-slate-200 rounded-lg px-4 py-2 focus:ring-teal-500 focus:border-teal-500">
                    </div>

                    <div>
                        <label class="block font-medium text-slate-700 mb-1">Description</label>
                        <textarea name="description" class="w-full border-slate-200 rounded-lg px-4 py-2 focus:ring-teal-500 focus:border-teal-500">{{ old('description') }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium text-slate-700 mb-1">Price *</label>
                            <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="w-full border-slate-200 rounded-lg px-4 py-2 focus:ring-teal-500 focus:border-teal-500" required>
                        </div>
                        <div>
                            <label class="block font-medium text-slate-700 mb-1">Stock Quantity *</label>
                            <input type="number" name="stock_quantity" value="{{ old('stock_quantity', 0) }}" class="w-full border-slate-200 rounded-lg px-4 py-2 focus:ring-teal-500 focus:border-teal-500" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium text-slate-700 mb-1">Reorder Level *</label>
                            <input type="number" name="reorder_level" value="{{ old('reorder_level', 10) }}" class="w-full border-slate-200 rounded-lg px-4 py-2 focus:ring-teal-500 focus:border-teal-500" required>
                        </div>
                        <div>
                            <label class="block font-medium text-slate-700 mb-1">Expiry Date *</label>
                            <input type="date" name="expiry_date" value="{{ old('expiry_date') }}" class="w-full border-slate-200 rounded-lg px-4 py-2 focus:ring-teal-500 focus:border-teal-500" required>
                        </div>
                    </div>

                    <div>
                        <label class="block font-medium text-slate-700 mb-1">Supplier</label>
                        <select name="supplier_id" class="w-full border-slate-200 rounded-lg px-4 py-2 focus:ring-teal-500 focus:border-teal-500">
                            <option value="">-- None --</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="requires_prescription" value="1" class="rounded text-teal-600 focus:ring-teal-500" {{ old('requires_prescription') ? 'checked' : '' }}>
                            <span class="ml-2 text-slate-700">Requires Prescription</span>
                        </label>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-medium px-6 py-2 rounded-lg transition">Save Medicine</button>
                        <a href="{{ route('medicines.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium px-6 py-2 rounded-lg transition">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>