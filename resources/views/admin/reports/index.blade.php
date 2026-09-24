<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Reports</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5">
                <form method="GET" class="flex flex-wrap gap-3 items-end">
                    <div>
                        <label class="block text-sm text-slate-600 mb-1">From</label>
                        <input type="date" name="from" value="{{ $from->format('Y-m-d') }}" class="border-slate-200 rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm text-slate-600 mb-1">To</label>
                        <input type="date" name="to" value="{{ $to->format('Y-m-d') }}" class="border-slate-200 rounded-lg px-3 py-2">
                    </div>
                    <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-medium px-5 py-2 rounded-lg transition">Filter</button>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5">
                    <p class="text-sm text-slate-500">Total Sales ({{ $from->format('d M') }} – {{ $to->format('d M') }})</p>
                    <p class="text-3xl font-bold text-teal-600">Rs. {{ number_format($totalSales, 2) }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5">
                    <p class="text-sm text-slate-500">Total Orders</p>
                    <p class="text-3xl font-bold text-slate-800">{{ $totalOrders }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                <h3 class="font-bold text-slate-800 mb-4">Top Selling Medicines</h3>
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left border-b text-slate-500">
                            <th class="py-2">Medicine</th>
                            <th class="py-2">Units Sold</th>
                            <th class="py-2">Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($topMedicines as $item)
                            <tr class="border-b">
                                <td class="py-2">{{ $item->medicine->name ?? 'Deleted medicine' }}</td>
                                <td class="py-2">{{ $item->total_sold }}</td>
                                <td class="py-2">Rs. {{ number_format($item->total_revenue, 2) }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="py-4 text-center text-slate-500">No sales in this period.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                <h3 class="font-bold text-red-600 mb-4">Low Stock Medicines ({{ $lowStockMedicines->count() }})</h3>
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left border-b text-slate-500">
                            <th class="py-2">Medicine</th>
                            <th class="py-2">Stock</th>
                            <th class="py-2">Reorder Level</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lowStockMedicines as $medicine)
                            <tr class="border-b">
                                <td class="py-2">{{ $medicine->name }}</td>
                                <td class="py-2 text-red-600 font-bold">{{ $medicine->stock_quantity }}</td>
                                <td class="py-2">{{ $medicine->reorder_level }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="py-4 text-center text-slate-500">No low stock medicines.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                <h3 class="font-bold text-orange-600 mb-4">Expiring Soon ({{ $expiringMedicines->count() }})</h3>
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left border-b text-slate-500">
                            <th class="py-2">Medicine</th>
                            <th class="py-2">Expiry Date</th>
                            <th class="py-2">Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($expiringMedicines as $medicine)
                            <tr class="border-b">
                                <td class="py-2">{{ $medicine->name }}</td>
                                <td class="py-2 text-orange-600 font-bold">{{ \Carbon\Carbon::parse($medicine->expiry_date)->format('d M Y') }}</td>
                                <td class="py-2">{{ $medicine->stock_quantity }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="py-4 text-center text-slate-500">No medicines expiring soon.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>