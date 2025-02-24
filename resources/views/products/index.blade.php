@extends('layouts.app')

@section('content')
    <h1>Products</h1>
    <a href="{{ route('products.create') }}">Add Product</a>
    <ul>
        @foreach($products as $product)
            <li>{{product->$name}} - ${{ $product->price }}</li>
        @endforeach
    </ul>
    <p class="text-muted">Category: {{ $product->category->name ?? 'Uncategorized '}} </p>

    <form method="GET" action="{{ route('products.index') }}" class="mb-3">
        <select name="category" class="form-select w-auto d-inline-block" onchange="this.form.submit()">
            <option value="">All Categories</option>
            @foreach($categories as category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </form>    
@endsection