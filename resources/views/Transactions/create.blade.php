<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sell Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold mb-2">{{ $product->name }}</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Price</p>
                                <p class="text-xl font-bold text-green-600">${{ number_format($product->price, 2) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Available Stock</p>
                                <p class="text-xl font-bold {{ $product->isLowStock() ? 'text-red-600' : 'text-blue-600' }}">
                                    {{ $product->stock }}
                                </p>
                            </div>
                        </div>
                    </div>

                    @if($product->stock == 0)
                        <x-alert type="error" message="This product is out of stock." />
                        <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to Products
                        </a>
                    @else
                        <form action="{{ route('transactions.store', $product) }}" method="POST" x-data="{ quantity: 1, price: {{ $product->price }} }">
                            @csrf
                            
                            <div class="mb-4">
                                <label for="quantity_sold" class="block text-sm font-medium text-gray-700">
                                    Quantity to Sell <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="number" 
                                    name="quantity_sold" 
                                    id="quantity_sold" 
                                    x-model="quantity"
                                    min="1" 
                                    max="{{ $product->stock }}" 
                                    value="{{ old('quantity_sold', 1) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('quantity_sold') border-red-500 @enderror"
                                    required
                                >
                                @error('quantity_sold')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6 bg-blue-50 p-4 rounded-lg">
                                <p class="text-sm text-gray-600">Total Amount</p>
                                <p class="text-3xl font-bold text-blue-600" x-text="'$' + (quantity * price).toFixed(2)"></p>
                            </div>

                            <div class="flex space-x-2">
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" @click="return confirm('Confirm sale?')">
                                    Complete Sale
                                </button>
                                <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>