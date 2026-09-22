<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
                <div class="bg-white p-4 rounded shadow">
                    <p class="text-sm text-gray-500">Total Medicines</p>
                    <p class="text-2xl font-bold">{{ $totalMedicines }}</p>
                </div>
                <div class="bg-white p-4 rounded shadow">
                    <p class="text-sm text-gray-500">Low Stock</p>
                    <p class="text-2xl font-bold text-red-600">{{ $lowStockCount }}</p>
                </div>
                <div class="bg-white p-4 rounded shadow">
                    <p class="text-sm text-gray-500">Expiring Soon (30 days)</p>
                    <p class="text-2xl font-bold text-orange-600">{{ $expiringSoonCount }}</p>
                </div>
                <div class="bg-white p-4 rounded shadow">
                    <p class="text-sm text-gray-500">Pending Orders</p>
                    <p class="text-2xl font-bold text-blue-600">{{ $pendingOrders }}</p>
                </div>
                <div class="bg-white p-4 rounded shadow">
                    <p class="text-sm text-gray-500">Total Orders</p>
                    <p class="text-2xl font-bold">{{ $totalOrders }}</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="font-bold mb-2">Quick Links</h3>
                <a href="{{ route('medicines.index') }}" class="text-blue-600 underline">Manage Medicines</a>
            </div>

        </div>
    </div>
</x-app-layout>