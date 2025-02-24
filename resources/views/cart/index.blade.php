@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="container mt-4">
    <h2>Shopping Cart</h2>

    @if(session('cart') && count(session('cart')) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('cart') as $id => $item)
                <tr>
                    <td><img src="{{ asset('storage/'.$item['image']) }}" width="50"></td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ number_format($item['price'], 2) }}</td>
                    <td>
                        <form action="{{ route('cart.update', $id) }}" method="post">
                            @csrf
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1">
                            <button type="submit" class="btn btn-info btn-sm">Update</button>
                        </form>
                    </td>
                    <td>{{ number_format($item['price'] * $item['quantity'], 2)}}</td> 
                    <td>
                        <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger btn-sm">Remove</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h4>Total: ${{ number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], session('cart'))), 2) }}</h4>
        <a href="#" class="btn btn-success">Checkout</a>
    @else
        <p>Cart is empty.</p>
    @endif
</div>
@endsection