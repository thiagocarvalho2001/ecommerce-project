<x-app-layout :categories="$categories">    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products Management') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <h2>Manage Products</h2>

        <form method="post" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" class="form-control" placeholder="Product Name" required>
            <input type="number" name="price" class="form-control mt-2" placeholder="Price" required><br>
            <select name="category_id" class="form-control mt-2" required>
                <option value="">Select one</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <input type="number" name="stock" class="form-control mt-2" placeholder="Stock" required><br>
            <textarea name="description" rows="5" class="form-control mt-2" placeholder="Description" required></textarea>
            <input type="file" name="image" class="form-control mt-2">
            <button type="submit" class="btn btn-success mt-2 center">Add Product</button>
        </form>

        <ul class="list-group mt-4">
            @foreach($products as $product)
                <li class="list-group-item">
                    {{ $product->name }} - ${{ number_format($product->price, 2) }}
                    <form action="{{ route('admin.products.delete', $product->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm float-end">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>