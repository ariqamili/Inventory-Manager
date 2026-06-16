<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Products') }}
            </h2>
            @if(auth()->user()->canManageProducts())
                <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Add New Product
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-6 bg-white p-4 shadow-sm sm:rounded-lg">
                <form action="{{ route('products.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Search by name, description or category..." 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        >
                    </div>

                    <div class="w-full md:w-48">
                        <select name="stock_status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">All Stock Levels</option>
                            <option value="low" {{ request('stock_status') == 'low' ? 'selected' : '' }}>Low Stock Only</option>
                            <option value="out" {{ request('stock_status') == 'out' ? 'selected' : '' }}>Out of Stock</option>
                        </select>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition">
                            Filter
                        </button>
                        @if(request()->anyFilled(['search', 'stock_status']))
                            <a href="{{ route('products.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition text-center">
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <x-alert type="success" :message="session('success')" />
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Category</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Stock</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 border-b">
                                            <div class="font-medium text-gray-900">{{ $product->name }}</div>
                                            @if($product->description)
                                                <div class="text-sm text-gray-500">{{ Str::limit($product->description, 50) }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 border-b">
                                            @if($product->category)
                                                <span class="px-2 py-1 text-xs bg-purple-100 text-purple-800 rounded">
                                                    {{ $product->category->name }}
                                                </span>
                                            @else
                                                <span class="text-gray-400 italic text-sm">No category</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 border-b font-semibold text-gray-700">
                                            ${{ number_format($product->price, 2) }}
                                        </td>
                                        <td class="px-6 py-4 border-b">
                                            @if($product->stock <= 0)
                                                <span class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded font-bold uppercase">Out of Stock</span>
                                            @elseif($product->isLowStock())
                                                <span class="px-2 py-1 text-xs bg-orange-100 text-orange-800 rounded font-bold">
                                                    Low: {{ $product->stock }}
                                                </span>
                                            @else
                                                <span class="text-gray-700">{{ $product->stock }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 border-b">
                                            <div class="flex items-center space-x-3">
                                                <a href="{{ route('products.show', $product) }}" class="text-blue-600 hover:text-blue-900 font-medium">View</a>
                                                
                                                @if(auth()->user()->canManageProducts())
                                                    <a href="{{ route('products.edit', $product) }}" class="text-green-600 hover:text-green-900 font-medium">Edit</a>
                                                @endif
                                                
                                                @if($product->stock > 0)
                                                    <a href="{{ route('transactions.create', $product) }}" class="text-purple-600 hover:text-purple-900 font-medium">Sell</a>
                                                @endif
                                                
                                                @if(auth()->user()->canManageProducts())
                                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline" x-data>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900 font-medium" 
                                                            @click="if (!confirm('Are you sure you want to delete this product?')) $event.preventDefault()">
                                                            Delete
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-10 border-b text-center text-gray-500">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                                </svg>
                                                <p>No products match your search or filters.</p>
                                                <a href="{{ route('products.index') }}" class="text-blue-600 mt-2 underline">View all products</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>