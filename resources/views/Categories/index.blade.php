<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Categories') }}
            </h2>
            <a href="{{ route('categories.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Category
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <x-alert type="success" :message="session('success')" />
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @forelse($categories as $category)
                            <div class="border rounded-lg p-6 hover:shadow-lg transition">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-xl font-bold">{{ $category->name }}</h3>
                                        <p class="text-sm text-gray-500">{{ $category->products_count }} products</p>
                                    </div>
                                    <span class="text-3xl">📁</span>
                                </div>
                                
                                @if($category->description)
                                    <p class="text-gray-600 text-sm mb-4">{{ $category->description }}</p>
                                @endif
                                
                                <div class="flex space-x-2">
                                    <a href="{{ route('categories.edit', $category) }}" class="text-blue-600 hover:text-blue-900 text-sm">
                                        Edit
                                    </a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline" x-data>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm" @click="if (!confirm('Are you sure you want to delete this product?')) $event.preventDefault()">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-3 text-center py-12">
                                <p class="text-gray-500 mb-4">No categories found.</p>
                                <a href="{{ route('categories.create') }}" class="text-blue-600 hover:text-blue-900">
                                    Create your first category
                                </a>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>