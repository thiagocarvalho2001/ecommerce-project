<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <title>Products</title>

    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 text-center">Category: {{ $product->category->name ?? 'Uncategorized' }}</p>

    <form method="GET" action="{{ route('products.index') }}" class="mb-4 flex justify-center">
        <select name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-auto p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" onchange="this.form.submit()">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </form>
    <div class="container mx-auto mt-8">
        <h2 class="mb-6 text-2xl font-semibold text-gray-900 dark:text-white text-center">Our Products</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden transition-shadow hover:shadow-xl">
                    <img src="{{ url('images/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h5 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">{{ $product->name }}</h5>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-3">Price: ${{ number_format($product->price, 2) }}</p>
                        <div class="flex items-center justify-between">
                            <form action="{{ route('cart.index', $product->id) }}" method="get" class="inline-block">
                                @csrf
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition-colors">Buy Now</button>
                            </form>
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                    Add to Cart
                                </button>
                            </form>
                            <form action="{{ route('wishlist.add', $product->id) }}" method="post">
                                @csrf
                                <button class="bg-purple-500 hover:bg-purple-700 text-white font-semibold py-2 px-4 border border-transparent rounded transition-colors focus:outline-none">
                                    Add to Wishlist
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>