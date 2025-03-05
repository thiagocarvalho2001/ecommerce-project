<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Orders') }}
            </h2>
    </x-slot>
<div class="container mt-4">
    <h2>Order History</h2>

    @if($orders->count() > 0)
        @foreach($orders as $order)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Order #{{ $order->id }}</h5>
                    <p class="card-text">Name: {{ $order->customer_name }}</p>
                    <p class="card-text">Email: {{ $order->customer_email }}</p>
                    <p class="card-text">Price: {{number_format($order->total_price, 2)}}</p>
                    <p class="card-text">Placed on: {{ $order->created_at->format('d M Y, H:i') }}</p>

                    <h6>Items:</h6>
                    <ul>
                        @foreach($order->items as $item)
                            <li>{{ $item->product->name }} - {{ $item->quantity }} x ${{ number_format($item->price, 2) }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    @else
        <p>No orders found.</p>
    @endif

    <a href="{{ route('products.index') }}" class="btn btn-primary">Back to products</a>
</div>
</x-app-layout>
