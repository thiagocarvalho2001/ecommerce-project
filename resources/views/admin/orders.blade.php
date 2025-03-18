<x-app-layout>    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order Management') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <h2>Manage Orders</h2>

        @foreach($orders as $order)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Order #{{ $order->id }} ({{ $order->status ?? 'Pending' }})</h5>
                    <p><strong>Name:</strong>{{ $order->customer_name }}</p>
                    <p><strong>Email:</strong>{{ $order->customer_email }}</p>
                    <p><strong>Total Price:</strong>${{number_format($order->total_price, 2) }}</p>

                    <form action="{{ route('admin.orders.update', $order->id) }}" method="post">
                        @csrf
                        <select name="status" class="form-control">
                            <option value="Pending">Pending</option>
                            <option value="Shipped">Shipped</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                        <button class="btn btn-primary mt-2">Update Status</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>