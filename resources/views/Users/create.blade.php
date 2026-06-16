<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        
                        <x-form-input 
                            name="name" 
                            label="Full Name" 
                            type="text" 
                            :value="old('name')" 
                            required 
                        />

                        <x-form-input 
                            name="email" 
                            label="Email Address" 
                            type="email" 
                            :value="old('email')" 
                            required 
                        />

                        <div class="mb-4">
                            <label for="role" class="block text-sm font-medium text-gray-700">
                                Role <span class="text-red-500">*</span>
                            </label>
                            <select 
                                name="role" 
                                id="role"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('role') border-red-500 @enderror"
                                required
                            >
                                <option value="">Select Role</option>
                                <option value="manager" {{ old('role') === 'manager' ? 'selected' : '' }}>Manager</option>
                                <option value="worker" {{ old('role') === 'worker' ? 'selected' : '' }}>Worker</option>
                            </select>
                            @error('role')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-1">Managers can manage products and categories. Workers can only view and sell.</p>
                        </div>

                        <x-form-input 
                            name="password" 
                            label="Password" 
                            type="password" 
                            required 
                        />

                        <x-form-input 
                            name="password_confirmation" 
                            label="Confirm Password" 
                            type="password" 
                            required 
                        />

                        <div class="flex space-x-2 mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Add Employee
                            </button>
                            <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>