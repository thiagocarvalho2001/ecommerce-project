<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

<title>Cart</title>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
             <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">Shopping Cart</h2>

            @if(session('cart') && count(session('cart')) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    Image
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    Product Name
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        Price
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        Quantity
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    Subtotal
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(session('cart') as $id => $item)
                            <tr class="dark:bg-gray-800">
                                <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm align-middle">
                                    <img src="{{ url('images/'.$item['image']) }}" alt="{{ $item['name'] }}" class="w-12 h-12 object-cover rounded">
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm align-middle">
                                    <p class="text-gray-900 dark:text-gray-300 whitespace-no-wrap">
                                        {{ $item['name'] }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm align-middle">
                                    <p class="text-gray-900 dark:text-gray-300 whitespace-no-wrap">
                                        ${{ number_format($item['price'], 2) }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm align-middle">
                                    <form action="{{ route('cart.update', $id) }}" method="post" class="flex items-center space-x-2">
                                        @csrf
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-20 sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                                        <button type="submit" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-500 dark:text-indigo-100 dark:hover:bg-indigo-600">Update</button>
                                    </form>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm align-middle">
                                    <p class="text-gray-900 dark:text-gray-300 whitespace-no-wrap">
                                        ${{ number_format($item['price'] * $item['quantity'], 2)}}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm align-middle">
                                    <a href="{{ route('cart.remove', $id) }}" class="inline-flex items-center px-3 py-2 border border-red-500 text-red-500 text-xs leading-4 font-medium rounded-md hover:bg-red-500 hover:text-white focus:outline-none transition ease-in-out duration-150">
                                        Remove
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <h4 class="text-xl font-semibold text-gray-900 dark:text-white mt-6">Total: ${{ number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], session('cart'))), 2) }}</h4>
                <a href="{{ route('checkout.index') }}" class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-700 text-white font-semibold rounded-md mt-4 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Proceed to Checkout
                </a>
            @else
                <p class="text-gray-700 dark:text-gray-300">Cart is empty.</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-semibold rounded-md mt-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Back to Products
                </a>
            @endif
        </div>
    </div>
</div>
</x-app-layout>