<x-app-layout :categories="$categories">
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Products Management') }}
    </h2>
</x-slot>
<title>Add products</title>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">Manage Products</h2>

            <form method="post" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="mb-6">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Product Name</label>
                    <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:bg-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline" placeholder="Product Name" required>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Price</label>
                    <input type="number" name="price" id="price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:bg-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline" placeholder="Price" required>
                </div>
                <div class="mb-4">
                    <label for="category_id" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Category</label>
                    <select name="category_id" id="category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:bg-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option value="">Select one</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="stock" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Stock</label>
                    <input type="number" name="stock" id="stock" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:bg-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline" placeholder="Stock" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Description</label>
                    <textarea name="description" id="description" rows="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:bg-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline" placeholder="Description" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Product Image</label>
                    <input type="file" name="image" id="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:bg-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Add Product
                </button>
            </form>

            <ul class="space-y-4">
                @foreach($products as $product)
                    <li class="bg-white dark:bg-gray-800 shadow rounded-md p-4 flex items-center justify-between">
                        <div>
                            <span class="text-gray-800 dark:text-gray-200">{{ $product->name }}</span>
                            <span class="text-gray-600 dark:text-gray-400 ml-2">- ${{ number_format($product->price, 2) }}</span>
                        </div>
                        <form action="{{ route('admin.products.delete', $product->id) }}" method="post" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline text-sm">
                                Delete
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
</x-app-layout>