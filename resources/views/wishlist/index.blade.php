<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Wishlist') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">Wishlist</h2>
                @if($wishlist->isEmpty())
                    <p class="text-lg text-gray-700 dark:text-gray-300">Your wishlist is empty.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($wishlist as $item)
                            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                                <img src="{{ url('images/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h5 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">{{ $item->product->name }}</h5>
                                    <p class="text-gray-600 dark:text-gray-400">${{ number_format($item->product->price, 2) }}</p>
                                    <form action="{{ route('wishlist.remove', $item->product->id) }}" method="post" class="mt-4">
                                        @csrf
                                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>