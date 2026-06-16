@props(['type' => 'success', 'message'])

@php
    $classes = [
        'success' => 'bg-green-100 border-green-400 text-green-700',
        'error' => 'bg-red-100 border-red-400 text-red-700',
        'warning' => 'bg-yellow-100 border-yellow-400 text-yellow-700',
        'info' => 'bg-blue-100 border-blue-400 text-blue-700',
    ];
    $alertClass = $classes[$type] ?? $classes['success'];
@endphp

<div class="{{ $alertClass }} border px-4 py-3 rounded mb-4" x-data="{ show: true }" x-show="show" x-transition>
    <div class="flex justify-between items-center">
        <span>{{ $message }}</span>
        <button @click="show = false" class="font-bold text-xl leading-none">&times;</button>
    </div>
</div>