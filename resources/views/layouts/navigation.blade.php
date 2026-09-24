<nav x-data="{ open: false }" class="bg-white border-b border-slate-100 shadow-sm sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center gap-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <x-application-logo class="block h-8 w-8 text-teal-600" />
                        <span class="text-lg font-bold text-teal-700 hidden sm:block">MediCare</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:ms-10 sm:flex sm:items-center">
                    <a href="{{ route('dashboard') }}"
                       class="px-3 py-2 rounded-lg text-sm font-medium transition
                              {{ request()->routeIs('dashboard') ? 'bg-teal-50 text-teal-700' : 'text-slate-600 hover:bg-slate-50 hover:text-teal-600' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('shop.index') }}"
                       class="px-3 py-2 rounded-lg text-sm font-medium transition
                              {{ request()->routeIs('shop.index') ? 'bg-teal-50 text-teal-700' : 'text-slate-600 hover:bg-slate-50 hover:text-teal-600' }}">
                        Shop
                    </a>
                    <a href="{{ route('cart.index') }}"
                       class="px-3 py-2 rounded-lg text-sm font-medium transition flex items-center gap-1
                              {{ request()->routeIs('cart.index') ? 'bg-teal-50 text-teal-700' : 'text-slate-600 hover:bg-slate-50 hover:text-teal-600' }}">
                        Cart
                        <span class="bg-orange-100 text-orange-700 text-xs font-bold px-1.5 py-0.5 rounded-full">{{ count(session('cart', [])) }}</span>
                    </a>

                    @if (auth()->user()->role === 'admin')
                        <span class="mx-2 h-6 w-px bg-slate-200"></span>

                        <a href="{{ route('admin.dashboard') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition
                                  {{ request()->routeIs('admin.dashboard') ? 'bg-slate-800 text-white' : 'text-slate-600 hover:bg-slate-50' }}">
                            Admin
                        </a>
                        <a href="{{ route('medicines.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition
                                  {{ request()->routeIs('medicines.*') ? 'bg-slate-800 text-white' : 'text-slate-600 hover:bg-slate-50' }}">
                            Medicines
                        </a>
                        <a href="{{ route('admin.orders.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition
                                  {{ request()->routeIs('admin.orders.*') ? 'bg-slate-800 text-white' : 'text-slate-600 hover:bg-slate-50' }}">
                            Orders
                        </a>
                        <a href="{{ route('admin.prescriptions.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition
                                  {{ request()->routeIs('admin.prescriptions.*') ? 'bg-slate-800 text-white' : 'text-slate-600 hover:bg-slate-50' }}">
                            Prescriptions
                        </a>
                        <a href="{{ route('admin.deliveries.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition
                                  {{ request()->routeIs('admin.deliveries.*') ? 'bg-slate-800 text-white' : 'text-slate-600 hover:bg-slate-50' }}">
                            Deliveries
                        </a>
                        <a href="{{ route('admin.reports.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition
                                  {{ request()->routeIs('admin.reports.*') ? 'bg-slate-800 text-white' : 'text-slate-600 hover:bg-slate-50' }}">
                            Reports
                        </a>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-slate-50 transition">
                            <div class="bg-teal-100 text-teal-700 w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="fill-current h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-slate-400 hover:text-teal-600 hover:bg-slate-50 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-slate-100">
        <div class="pt-2 pb-3 space-y-1 px-2">
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-teal-50 text-teal-700' : 'text-slate-600' }}">Dashboard</a>
            <a href="{{ route('shop.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('shop.index') ? 'bg-teal-50 text-teal-700' : 'text-slate-600' }}">Shop</a>
            <a href="{{ route('cart.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('cart.index') ? 'bg-teal-50 text-teal-700' : 'text-slate-600' }}">Cart ({{ count(session('cart', [])) }})</a>

            @if (auth()->user()->role === 'admin')
                <div class="pt-2 mt-2 border-t border-slate-100 text-xs font-semibold text-slate-400 px-3 uppercase">Admin</div>
                <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-slate-800 text-white' : 'text-slate-600' }}">Admin Dashboard</a>
                <a href="{{ route('medicines.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('medicines.*') ? 'bg-slate-800 text-white' : 'text-slate-600' }}">Medicines</a>
                <a href="{{ route('admin.orders.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.orders.*') ? 'bg-slate-800 text-white' : 'text-slate-600' }}">Orders</a>
                <a href="{{ route('admin.prescriptions.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.prescriptions.*') ? 'bg-slate-800 text-white' : 'text-slate-600' }}">Prescriptions</a>
                <a href="{{ route('admin.deliveries.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.deliveries.*') ? 'bg-slate-800 text-white' : 'text-slate-600' }}">Deliveries</a>
                <a href="{{ route('admin.reports.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.reports.*') ? 'bg-slate-800 text-white' : 'text-slate-600' }}">Reports</a>
            @endif
        </div>

        <div class="pt-4 pb-3 border-t border-slate-100">
            <div class="px-4 flex items-center gap-3">
                <div class="bg-teal-100 text-teal-700 w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="font-medium text-base text-slate-800">{{ Auth::user()->name }}</div>
                    <div class="text-sm text-slate-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1 px-2">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>