<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-2">Welcome, {{ auth()->user()->name }}!</h3>
                    <p class="text-gray-600">{{ auth()->user()->business->name }} - {{ ucfirst(auth()->user()->role) }}</p>
                </div>
            </div>

            @if($totalProducts == 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border-2 border-dashed border-blue-200">
                    <div class="p-12 text-center">
                        <span class="text-5xl block mb-4">🚀</span>
                        <h3 class="text-xl font-bold text-gray-800">Ready to start tracking?</h3>
                        <p class="text-gray-600 mb-6">You haven't added any products to your inventory yet.</p>
                        @if(auth()->user()->canManageProducts())
                            <a href="{{ route('products.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition">
                                Add Your First Product
                            </a>
                        @endif
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <x-stat-card 
                        title="Total Products" 
                        :value="$totalProducts" 
                        icon="📦"
                        color="blue"
                    />
                    
                    <x-stat-card 
                        title="Categories" 
                        :value="$totalCategories" 
                        icon="📁"
                        color="green"
                    />
                    
                    <x-stat-card 
                        title="Low Stock Items" 
                        :value="$lowStockProducts->count()" 
                        icon="⚠️"
                        color="red"
                    />
                </div>

                @if($lowStockProducts->count() > 0)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4 text-red-600 flex items-center">
                                <span class="text-2xl mr-2">⚠️</span>
                                Low Stock Alert
                            </h3>
                            <div class="space-y-2">
                                @foreach($lowStockProducts as $product)
                                    <div class="flex justify-between items-center bg-red-50 p-3 rounded-lg border border-red-100">
                                        <div>
                                            <span class="font-medium text-gray-900">{{ $product->name }}</span>
                                            <p class="text-xs text-red-500 font-bold">Current Stock: {{ $product->stock }}</p>
                                        </div>
                                        @if(auth()->user()->canManageProducts())
                                            <a href="{{ route('products.edit', $product) }}" class="text-xs bg-white border border-red-200 text-red-600 px-3 py-1.5 rounded-md hover:bg-red-600 hover:text-white transition font-semibold shadow-sm">
                                                Restock
                                            </a>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            @if($recentTransactions->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Recent Transactions</h3>
                        <div class="space-y-3">
                            @foreach($recentTransactions as $transaction)
                                <div class="flex justify-between items-center border-b pb-2">
                                    <div>
                                        <p class="font-medium">{{ $transaction->product->name }}</p>
                                        <p class="text-sm text-gray-600">Sold by: {{ $transaction->user->name }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-green-600">${{ number_format($transaction->total_amount, 2) }}</p>
                                        <p class="text-xs text-gray-500">{{ $transaction->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('products.index') }}" class="block p-4 bg-blue-50 hover:bg-blue-100 rounded-lg text-center transition">
                            <span class="text-3xl block mb-2">📦</span>
                            <span class="font-medium">View Products</span>
                        </a>
                        
                        @if(auth()->user()->canManageProducts())
                            <a href="{{ route('products.create') }}" class="block p-4 bg-green-50 hover:bg-green-100 rounded-lg text-center transition">
                                <span class="text-3xl block mb-2">➕</span>
                                <span class="font-medium">Add Product</span>
                            </a>
                            
                            <a href="{{ route('categories.index') }}" class="block p-4 bg-purple-50 hover:bg-purple-100 rounded-lg text-center transition">
                                <span class="text-3xl block mb-2">📁</span>
                                <span class="font-medium">Manage Categories</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>