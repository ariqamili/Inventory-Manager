<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-2xl font-bold">{{ $product->name }}</h3>
                            @if($product->category)
                                <span class="inline-block mt-2 px-3 py-1 text-sm bg-purple-100 text-purple-800 rounded">
                                    {{ $product->category->name }}
                                </span>
                            @endif
                        </div>
                        <div class="flex space-x-2">
                            @if(auth()->user()->canManageProducts())
                                <a href="{{ route('products.edit', $product) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Edit
                                </a>
                            @endif
                            
                            @if($product->stock > 0)
                                <a href="{{ route('transactions.create', $product) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Sell Product
                                </a>
                            @endif
                            
                            <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Back
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600 mb-1">Price</p>
                            <p class="text-3xl font-bold text-green-600">${{ number_format($product->price, 2) }}</p>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600 mb-1">Stock</p>
                            <p class="text-3xl font-bold {{ $product->isLowStock() ? 'text-red-600' : 'text-blue-600' }}">
                                {{ $product->stock }}
                            </p>
                            @if($product->isLowStock())
                                <p class="text-xs text-red-500 mt-1">Low stock!</p>
                            @endif
                        </div>
                    </div>

                    @if($product->description)
                        <div class="mb-6">
                            <h4 class="text-lg font-semibold mb-2">Description</h4>
                            <p class="text-gray-700">{{ $product->description }}</p>
                        </div>
                    @endif

                    <div class="border-t pt-4">
                        <p class="text-sm text-gray-500">Created: {{ $product->created_at->format('M d, Y') }}</p>
                        <p class="text-sm text-gray-500">Last updated: {{ $product->updated_at->format('M d, Y') }}</p>
                    </div>

                    @if(auth()->user()->canManageProducts())
                        <div class="mt-6 pt-6 border-t">
                            <form action="{{ route('products.destroy', $product) }}" method="POST" x-data>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" @click="return confirm('Are you sure you want to delete this product?')">
                                    Delete Product
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>