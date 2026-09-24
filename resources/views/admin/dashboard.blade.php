<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-gradient-to-r from-slate-800 to-slate-900 text-white rounded-xl p-8 shadow">
                <h3 class="text-2xl font-bold mb-1">Pharmacy Overview</h3>
                <p class="text-slate-300">Monitor stock, orders and deliveries at a glance.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-slate-500">Total Medicines</span>
                        <div class="bg-teal-100 p-2 rounded-full">
                            <svg class="w-4 h-4 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-slate-800">{{ $totalMedicines }}</p>
                </div>

                <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-slate-500">Low Stock</span>
                        <div class="bg-red-100 p-2 rounded-full">
                            <svg class="w-4 h-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-red-600">{{ $lowStockCount }}</p>
                </div>

                <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-slate-500">Expiring Soon</span>
                        <div class="bg-orange-100 p-2 rounded-full">
                            <svg class="w-4 h-4 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-orange-600">{{ $expiringSoonCount }}</p>
                </div>

                <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-slate-500">Pending Orders</span>
                        <div class="bg-yellow-100 p-2 rounded-full">
                            <svg class="w-4 h-4 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-yellow-600">{{ $pendingOrders }}</p>
                </div>

                <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-slate-500">Total Orders</span>
                        <div class="bg-blue-100 p-2 rounded-full">
                            <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-slate-800">{{ $totalOrders }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                <h3 class="font-bold text-slate-800 mb-4">Quick Links</h3>
                <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
                    <a href="{{ route('medicines.index') }}" class="bg-teal-50 hover:bg-teal-100 text-teal-700 font-medium text-sm rounded-lg px-4 py-3 text-center transition">
                        Medicines
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="bg-blue-50 hover:bg-blue-100 text-blue-700 font-medium text-sm rounded-lg px-4 py-3 text-center transition">
                        Orders
                    </a>
                    <a href="{{ route('admin.prescriptions.index') }}" class="bg-yellow-50 hover:bg-yellow-100 text-yellow-700 font-medium text-sm rounded-lg px-4 py-3 text-center transition">
                        Prescriptions
                    </a>
                    <a href="{{ route('admin.deliveries.index') }}" class="bg-purple-50 hover:bg-purple-100 text-purple-700 font-medium text-sm rounded-lg px-4 py-3 text-center transition">
                        Deliveries
                    </a>
                    <a href="{{ route('admin.reports.index') }}" class="bg-slate-50 hover:bg-slate-100 text-slate-700 font-medium text-sm rounded-lg px-4 py-3 text-center transition">
                        Reports
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>