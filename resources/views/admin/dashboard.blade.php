<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="row flex flex-wrap -mx-2">
        <div class="col-lg-4 col-6 px-2 mb-4">
            <div class="small-box bg-info bg-blue-600 text-white rounded-lg shadow-md overflow-hidden">
                <div class="p-4">
                    <h3 class="text-3xl font-semibold mb-2">{{ $orders_count }}</h3>
                    <p class="text-sm">Total Orders</p>
                </div>
                <div class="p-4 bg-blue-700 flex items-center justify-center">
                    <i class="fas fa-shopping-cart text-4xl"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6 mb-4 px-2">
            <div class="bg-green-600 text-white rounded-lg shadow-md overflow-hidden">
                <div class="p-4">
                    <h3 class="text-3xl font-semibold mb-2">{{ $total_sales }}</h3>
                    <p class="text-sm">Total Sales</p>
                </div>
                <div class="p-4 bg-green-700 flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-4xl"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6 px-2 mb-4">
            <div class="bg-yellow-600 text-white rounded-lg shadow-md overflow-hidden">
                <div class="p-4">
                    <h3 class="text-3xl font-semibold mb-2">{{ $products_count }}</h3>
                    <p class="text-sm">Total Products</p>
                </div>
                <div class="p-4 bg-yellow-700 flex items-center justify-center">
                    <i class="fas fa-box text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:gird-cols-2 gap-4">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 border-b borer-gray-200">
                <h3 class="text-lg font-semitbold text-gray-800">Order Status</h3>
            </div>
            <div class="p-4">
                <canvas id="ordersChart" aria-label="Chart displaying order status" role="img"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Sales Analytics</h3>
            </div>
            <div class="p-4">
                <canvas id="salesChart" aria-label="Chart displaying sales analytics" role="img"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('ordersChart').getContext('2d');
        var salesCtx = document.getElementById('salesChart').getContext('2d');
        var ordersChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Pending', 'Delivered', 'Cancelled', 'Shipped'],
                datasets: [{
                    label: 'Orders Status',
                    data: [{{ $pending }},{{ $delivered }}, {{ $cancelled }}, {{ $shipped }}],
                    backgroundColor: ['#f39c12', '#3498db', '#e74c3c', '#2ecc71'] 
                }]
            },
            options: {
                responsive: true 
            }
        });

        var salesChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($sales_dates) !!},
                datasets: [{
                    label: 'Total Sales',
                    data: {!! json_encode($sales_totals) !!},
                    borderColor: '#28a745',
                    fill: false
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
</x-app-layout>