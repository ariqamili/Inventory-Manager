@props(['name', 'label', 'options', 'selected' => null])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
        {{ $label }}
    </label>
    <select 
        name="{{ $name }}" 
        id="{{ $name }}"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error($name) border-red-500 @enderror"
    >
        <option value="">Select {{ $label }}</option>
        @foreach($options as $option)
            <option value="{{ $option->id }}" {{ $selected == $option->id ? 'selected' : '' }}>
                {{ $option->name }}
            </option>
        @endforeach
    </select>
    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>