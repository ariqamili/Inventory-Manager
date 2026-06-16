@props(['title', 'value', 'icon', 'color' => 'blue'])

@php
    $colorClasses = [
        'blue' => 'bg-blue-50 text-blue-600',
        'green' => 'bg-green-50 text-green-600',
        'red' => 'bg-red-50 text-red-600',
        'purple' => 'bg-purple-50 text-purple-600',
    ];
    $bgClass = $colorClasses[$color] ?? $colorClasses['blue'];
@endphp

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">{{ $title }}</p>
                <p class="text-3xl font-bold">{{ $value }}</p>
            </div>
            <div class="{{ $bgClass }} w-16 h-16 rounded-full flex items-center justify-center text-3xl">
                {{ $icon }}
            </div>
        </div>
    </div>
</div>