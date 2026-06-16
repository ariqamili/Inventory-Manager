<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('products.store') }}" method="POST">
                        @csrf
                        
                        <x-form-input 
                            name="name" 
                            label="Product Name" 
                            type="text" 
                            :value="old('name')" 
                            required 
                        />

                        <x-form-select 
                            name="category_id" 
                            label="Category" 
                            :options="$categories" 
                            :selected="old('category_id')"
                        />

                        <x-form-input 
                            name="price" 
                            label="Price" 
                            type="number" 
                            step="0.01" 
                            :value="old('price')" 
                            required 
                        />

                        <x-form-input 
                            name="stock" 
                            label="Stock Quantity" 
                            type="number" 
                            :value="old('stock')" 
                            required 
                        />

                        <x-form-textarea 
                            name="description" 
                            label="Description" 
                            :value="old('description')" 
                        />

                        <div class="flex space-x-2 mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Create Product
                            </button>
                            <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>