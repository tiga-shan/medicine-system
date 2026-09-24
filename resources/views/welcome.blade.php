<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MediCare — Online Medicine Delivery & Inventory System</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Figtree', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800">

    <!-- Top Navbar -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <svg class="w-8 h-8 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 4a4 4 0 100 8 4 4 0 000-8zM6.343 17.657l3.536-3.536a4 4 0 015.657 0l3.535 3.536a4 4 0 11-5.656 5.656l-.707-.707-.707.707a4 4 0 11-5.658-5.656z" />
                </svg>
                <span class="text-xl font-bold text-teal-700">MediCare</span>
            </div>

            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-slate-600 hover:text-teal-600">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-teal-600">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-teal-600 to-teal-800 text-white">
        <div class="max-w-7xl mx-auto px-6 py-24 grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">
                    Your Medicines,<br>Delivered to Your Door.
                </h1>
                <p class="text-teal-100 text-lg mb-8">
                    Order medicines online, upload your prescription, and track your delivery —
                    all while your local pharmacy manages stock in real time.
                </p>
                <div class="flex gap-4">
                    @auth
                        <a href="{{ route('shop.index') }}" class="bg-white text-teal-700 font-semibold px-6 py-3 rounded-lg hover:bg-teal-50 transition">
                            Browse Medicines
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="bg-white text-teal-700 font-semibold px-6 py-3 rounded-lg hover:bg-teal-50 transition">
                            Get Started
                        </a>
                        <a href="{{ route('login') }}" class="border border-white/60 font-semibold px-6 py-3 rounded-lg hover:bg-white/10 transition">
                            Log In
                        </a>
                    @endauth
                </div>
            </div>

            <div class="hidden md:flex justify-center">
                <div class="bg-white/10 backdrop-blur rounded-2xl p-8 w-full max-w-sm">
                    <div class="bg-white rounded-xl p-6 shadow-xl">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="bg-teal-100 p-3 rounded-full">
                                <svg class="w-6 h-6 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-800">Prescription Verified</p>
                                <p class="text-sm text-slate-500">Order #1042 approved</p>
                            </div>
                        </div>
                        <div class="border-t pt-4 space-y-2 text-sm text-slate-600">
                            <div class="flex justify-between"><span>Paracetamol 500mg</span><span>× 2</span></div>
                            <div class="flex justify-between"><span>Amoxicillin</span><span>× 1</span></div>
                        </div>
                        <div class="border-t mt-4 pt-4 flex justify-between font-bold text-slate-800">
                            <span>Status</span>
                            <span class="text-teal-600">Out for Delivery</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="max-w-7xl mx-auto px-6 py-20">
        <div class="text-center mb-14">
            <h2 class="text-3xl font-bold text-slate-800 mb-3">Everything Your Pharmacy Needs</h2>
            <p class="text-slate-500">One platform for customers to order, and pharmacies to manage stock and deliveries.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl p-8 shadow-sm border border-slate-100 hover:shadow-md transition">
                <div class="bg-teal-100 w-12 h-12 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h3 class="font-semibold text-lg mb-2">Order Online</h3>
                <p class="text-slate-500 text-sm">Browse medicines, add to cart, and check out in a few clicks — no need to visit the pharmacy in person.</p>
            </div>

            <div class="bg-white rounded-xl p-8 shadow-sm border border-slate-100 hover:shadow-md transition">
                <div class="bg-teal-100 w-12 h-12 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="font-semibold text-lg mb-2">Prescription Verified</h3>
                <p class="text-slate-500 text-sm">Upload your prescription and our pharmacists verify it before restricted medicines are dispatched.</p>
            </div>

            <div class="bg-white rounded-xl p-8 shadow-sm border border-slate-100 hover:shadow-md transition">
                <div class="bg-teal-100 w-12 h-12 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
                <h3 class="font-semibold text-lg mb-2">Real-Time Inventory</h3>
                <p class="text-slate-500 text-sm">Stock updates automatically with every order, with low-stock and expiry alerts for the pharmacy.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-300 py-10">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-2">
                <svg class="w-6 h-6 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 4a4 4 0 100 8 4 4 0 000-8zM6.343 17.657l3.536-3.536a4 4 0 015.657 0l3.535 3.536a4 4 0 11-5.656 5.656l-.707-.707-.707.707a4 4 0 11-5.658-5.656z" />
                </svg>
                <span class="font-bold text-white">MediCare</span>
            </div>
            <p class="text-sm">&copy; {{ date('Y') }} MediCare — Web-based Online Medicine Delivery & Inventory Tracking System</p>
        </div>
    </footer>

</body>
</html>