@extends('layouts.app')

@section('title', 'Order Sucessful')

@section('content')
<div class="container mt-4">
    <h2>Order Successful!</h2>
    <p>Thank you, {{ $order->costumer_name }}. You order has been placed.</p>

    <h4>Order sumary</h4>
    <ul>
        @foreach($order->items as $item)
            <li>{{ $item->product->name }} - {{ $item->quantity }} x {{ number_format($item->price, 2)}}</li>
        @endforeach
    </ul>

    <h4>Total: ${{ number_format($order->total_price, 2) }}</h4>

    <href="{{ route('product.index') }}" class="btn btn-primary">Continue Shopping</a>
</div>
@endsection