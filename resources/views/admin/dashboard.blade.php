<x-app-layout>    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="row">
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $orders_count }}</h3>
                    <p>Total Orders</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
                <div class="i">
                    <h3>{{ $total_sales }}</h3>
                    <p>Total Sales</p>
                </div>
                <div class="icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $products_count }}</h3>
                    <p>Total Products</p>
                </div>
                <div class="icon">
                    <i class="fas fa-box"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Order Status</h3>
        </div>
        <div class="card">
            <canvas id="ordersChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('ordersChart').getContext('2d');
        var ordersChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Pending', 'Delivered', 'Cancelled', 'Shipped'],
                datasets: [{
                    label: 'Orders Status',
                    data: [{{ $pending }},{{ $delivered }}, {{ $cancelled }}, {{ $shipped }}],
                    backgroundColor: ['#f39c12', '#3498db', '#2ecc71']
                }]
            }
        });
    </script>
</x-app-layout>