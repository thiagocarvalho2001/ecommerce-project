<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Manage Orders</h2>

                    @foreach($orders as $order)
                        <div class="bg-gray-100 dark:bg-gray-700 rounded-lg shadow-md p-6 mb-4">
                            <h5 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">
                                Order #{{ $order->id }} (<span class="font-normal">{{ $order->status ?? 'Pending' }}</span>)
                            </h5>
                            <p class="text-gray-700 dark:text-gray-300 mb-1"><strong>Name:</strong> {{ $order->customer_name }}</p>
                            <p class="text-gray-700 dark:text-gray-300 mb-1"><strong>Email:</strong> {{ $order->customer_email }}</p>
                            <p class="text-gray-700 dark:text-gray-300 mb-3"><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</p>

                            <form action="{{ route('admin.orders.update', $order->id) }}" method="post" class="flex items-center space-x-2">
                                @csrf
                                <select name="status" class="bg-gray-50 dark:bg-gray-600 border border-gray-300 dark:border-gray-500 text-gray-900 dark:text-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="Pending" {{ $order->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Shipped" {{ $order->status === 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="Delivered" {{ $order->status === 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="Cancelled" {{ $order->status === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Update Status
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>