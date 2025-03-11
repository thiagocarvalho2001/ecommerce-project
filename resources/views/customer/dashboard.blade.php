<x-app-layout>    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Customer Dashboard') }}
        </h2>
    </x-slot>
    <div class="container">
        <h2>Welcome, {{ $user->name }}!</h2>

        <div class="row">
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5>Total Spend ${{ number_format($total_spent, 2) }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Order History</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                    <td><span class="badge bg-{{ $order->status == 'Delivered' ? 'success' : 'warning' }}">{{ $order->status }}</span></td>                                <td>${{ number_format($order->total_price, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($orders->isEmpty())
                            <p class="text-muted">No orders yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>