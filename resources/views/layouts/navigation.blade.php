<nav x-data="{ open: false }" class="bg-blue-500 dark:bg-gray-800 shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('customer.dashboard') }}" class="text-white dark:text-gray-200 font-semibold text-xl">
                        {{ config('app.name', 'Ecommerce') }}
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if (!Auth::check())
                        <x-nav-link :href="route('login')" :active="request()->routeIs('login')" class="text-white dark:text-gray-300 hover:text-gray-200 dark:hover:text-gray-100">
                            {{ __('Login') }}
                        </x-nav-link>
                    @else
                        @if (Auth::check() && Auth::user()->is_admin)
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-white dark:text-gray-300 hover:text-gray-200 dark:hover:text-gray-100">
                                {{ __('Admin') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.products')" :active="request()->routeIs('admin.products')" class="text-white dark:text-gray-300 hover:text-gray-200 dark:hover:text-gray-100">
                                {{ __('Products') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.orders')" :active="request()->routeIs('admin.orders')" class="text-white dark:text-gray-300 hover:text-gray-200 dark:hover:text-gray-100">
                                {{ __('Orders') }}
                            </x-nav-link>
                        @endif
                        <x-nav-link :href="route('customer.dashboard')" :active="request()->routeIs('customer.dashboard')" class="text-white dark:text-gray-300 hover:text-gray-200 dark:hover:text-gray-100">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('wishlist.index')" :active="request()->routeIs('wishlist.index')" class="text-white dark:text-gray-300 hover:text-gray-200 dark:hover:text-gray-100">
                            {{ __('Wishlist') }}
                        </x-nav-link>
                        <x-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')" class="text-white dark:text-gray-300 hover:text-gray-200 dark:hover:text-gray-100">
                            {{ __('My orders') }}
                        </x-nav-link>
                        <x-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')" class="text-white dark:text-gray-300 hover:text-gray-200 dark:hover:text-gray-100">
                            {{ __('Cart') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @if (Auth::check())
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-200 dark:text-gray-400 bg-blue-700 dark:bg-gray-700 hover:text-gray-100 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none transition duration-150 ease-in-out">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none transition duration-150 ease-in-out">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-blue-700 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-200 dark:text-gray-400 uppercase tracking-widest hover:bg-blue-800 dark:hover:bg-gray-600 focus:bg-blue-800 dark:focus:bg-gray-600 active:bg-blue-900 dark:active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        {{ __('Login / Register') }}
                    </a>
                @endif
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if (!Auth::check())
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')" class="block px-4 py-2 text-base font-medium text-white dark:text-gray-300 hover:bg-blue-600 dark:hover:bg-gray-700 focus:outline-none focus:ring focus:ring-blue-500 transition duration-150 ease-in-out">
                    {{ __('Login') }}
                </x-responsive-nav-link>
            @else
                @if (Auth::check() && Auth::user()->is_admin)
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="block px-4 py-2 text-base font-medium text-white dark:text-gray-300 hover:bg-blue-600 dark:hover:bg-gray-700 focus:outline-none focus:ring focus:ring-blue-500 transition duration-150 ease-in-out">
                        {{ __('Admin Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.products')" :active="request()->routeIs('admin.products')" class="block px-4 py-2 text-base font-medium text-white dark:text-gray-300 hover:bg-blue-600 dark:hover:bg-gray-700 focus:outline-none focus:ring focus:ring-blue-500 transition duration-150 ease-in-out">
                        {{ __('Products') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.orders')" :active="request()->routeIs('admin.orders')" class="block px-4 py-2 text-base font-medium text-white dark:text-gray-300 hover:bg-blue-600 dark:hover:bg-gray-700 focus:outline-none focus:ring focus:ring-blue-500 transition duration-150 ease-in-out">
                        {{ __('Orders') }}
                    </x-responsive-nav-link>
                @endif
                <x-responsive-nav-link :href="route('customer.dashboard')" :active="request()->routeIs('customer.dashboard')" class="block px-4 py-2 text-base font-medium text-white dark:text-gray-300 hover:bg-blue-600 dark:hover:bg-gray-700 focus:outline-none focus:ring focus:ring-blue-500 transition duration-150 ease-in-out">
                    {{ __('Customer Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('wishlist.index')" :active="request()->routeIs('wishlist.index')" class="block px-4 py-2 text-base font-medium text-white dark:text-gray-300 hover:bg-blue-600 dark:hover:bg-gray-700 focus:outline-none focus:ring focus:ring-blue-500 transition duration-150 ease-in-out">
                    {{ __('Wishlist') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')" class="block px-4 py-2 text-base font-medium text-white dark:text-gray-300 hover:bg-blue-600 dark:hover:bg-gray-700 focus:outline-none focus:ring focus:ring-blue-500 transition duration-150 ease-in-out">
                    {{ __('My orders') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')" class="block px-4 py-2 text-base font-medium text-white dark:text-gray-300 hover:bg-blue-600 dark:hover:bg-gray-700 focus:outline-none focus:ring focus:ring-blue-500 transition duration-150 ease-in-out">
                    {{ __('Cart') }}
                </x-responsive-nav-link>
            @endif
        </div>

        @if (Auth::check())
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" class="block px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring focus:ring-indigo-500 transition duration-150 ease-in-out">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();" class="block px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring focus:ring-indigo-500 transition duration-150 ease-in-out">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endif
    </div>
</nav>