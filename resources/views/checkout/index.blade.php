<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 shadow-md rounded-md overflow-hidden">
            <div class="p-8">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">Checkout</h2>
                <form action="{{ route('checkout.process') }}" method="post" id="payment-form">
                    @csrf
                    <div class="mb-4">
                        <label for="card_name" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Name on Card</label>
                        <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:bg-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline" id="card_name" name="card_name" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Card Details</label>
                        <div id="card-element" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:bg-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"></div>
                    </div>

                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded focus:outline-none focus:shadow-outline">Pay Now</button>
                    <input type="hidden" name="stripeToken" id="stripeToken">
                </form>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe("{{ config('services.stripe.key') }}");
        var elements = stripe.elements();
        var card = elements.create('card');
        card.mount('#card-element');

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    alert(result.error.message);
                } else {
                    document.getElementById('stripeToken').value = result.token.id;
                    form.submit();
                }
            });
        });
    </script>
</x-app-layout>