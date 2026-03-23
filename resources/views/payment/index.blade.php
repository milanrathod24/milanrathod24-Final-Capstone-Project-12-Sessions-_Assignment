<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex flex-col items-center">
                    <h3 class="text-2xl font-bold mb-2">Complete Your Payment</h3>
                    <p class="mb-6 text-gray-600">Proceed to checkout to complete your $10.00 one-time payment.</p>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 w-full max-w-md text-center">
                        <div class="text-4xl font-bold mb-6">$10.00</div>
                        <a href="{{ route('payment.checkout') }}" class="inline-block w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded transition duration-150">
                            Pay with Stripe
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
