<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Wishlist') }}
        </h2>
    </x-slot>

    <div class="container">
        <h2>Wishlist</h2>
        @if($wishlist->isEmpty())
            <p class="text-m">Your wishlist is empty.</p>
        @else
            <div class="row">
                @foreach($wishlist as $item)
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ url('images/' . $item->product->image) }}" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->product->name }}</h5>
                                <p class="card-text">${{ number_format($item->product->price, 2) }}</p>
                                <form action="{{ route('wishlist.remove', $item->product->id) }}" method="post">
                                    @csrf
                                    <button class="btn btn-danger">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>