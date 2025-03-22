<x-app-layout>    
<x-slot name="header">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
        {{ __('Customer Dashboard') }}
    </h2>
</x-slot>
<title>Customer dashboard</title>
<div class="max-w-7xl mx-auto py-6 px-4">
    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">
        Welcome, {{ $user->name }}!
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Total Spend Card -->
        <div class="bg-green-500 text-white p-6 rounded-lg shadow-md">
            <h5 class="text-lg font-bold">Total Spend</h5>
            <p class="text-xl font-semibold">${{ number_format($total_spent, 2) }}</p>
        </div>

        <!-- Order History -->
        <div class="md:col-span-2 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-3">Order History</h3>

            @if($orders->isEmpty())
                <p class="text-gray-500">No orders yet.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300 dark:border-gray-700">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                                <th class="p-2 border border-gray-300 dark:border-gray-600">Order ID</th>
                                <th class="p-2 border border-gray-300 dark:border-gray-600">Date</th>
                                <th class="p-2 border border-gray-300 dark:border-gray-600">Status</th>
                                <th class="p-2 border border-gray-300 dark:border-gray-600">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr class="border border-gray-300 dark:border-gray-600">
                                    <td class="p-2 text-center">{{ $order->id }}</td>
                                    <td class="p-2 text-center">{{ $order->created_at->format('d M Y') }}</td>
                                    <td class="p-2 text-center">
                                        <span class="px-3 py-1 rounded-full text-white 
                                            {{ $order->status == 'Delivered' ? 'bg-green-500' : 'bg-yellow-500' }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="p-2 text-center">${{ number_format($order->total_price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
</x-app-layout>
