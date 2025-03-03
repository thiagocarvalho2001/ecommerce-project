@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container mt-4">
    <h2>Checkout</h2>

    <form action="{{ route('checkout.process') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="customer_name" class="form-label">Name</label>
            <input type="text" class="form-control"
             id="customer_name" name="customer_name" required>
        </div>

        <h4>Total: ${{ number_format(array_sum(array_map(fn($item) 
            => $item['price'] * $item['quantity'], session('cart', []))), 2)}}</h4>

        <button type="submit" class="btn btn-success">Place Order</button>
    </form>
</div>
@endsection