<x-app-layout>    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <h2>Admin Dashboard</h2>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5>Total Orders</h5>
                        <h3> {{ $orders }} </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Total Products</h5>
                    <h3>{{ $products }}</h3>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('admin.orders') }}" class="btn btn-primary mt-3">Manage Orders</a>
    <a href="{{ route('admin.products') }}" class="btn btn-secondary">Manage Products</a>

    </div>
</x-app-layout>