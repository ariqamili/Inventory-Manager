<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sales History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(auth()->user()->isWorker())
                        <div class="mb-4 bg-blue-50 p-4 rounded-lg">
                            <p class="text-sm text-blue-800">You are viewing your own sales only.</p>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Product</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Quantity</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Total Amount</th>
                                    @if(!auth()->user()->isWorker())
                                        <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Sold By</th>
                                    @endif
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $transaction)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 border-b">
                                            <div class="font-medium">{{ $transaction->product->name }}</div>
                                            @if($transaction->product->category)
                                                <div class="text-xs text-gray-500">{{ $transaction->product->category->name }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 border-b">{{ $transaction->quantity_sold }}</td>
                                        <td class="px-6 py-4 border-b font-bold text-green-600">
                                            ${{ number_format($transaction->total_amount, 2) }}
                                        </td>
                                        @if(!auth()->user()->isWorker())
                                            <td class="px-6 py-4 border-b">{{ $transaction->user->name }}</td>
                                        @endif
                                        <td class="px-6 py-4 border-b">
                                            <div>{{ $transaction->created_at->format('M d, Y') }}</div>
                                            <div class="text-xs text-gray-500">{{ $transaction->created_at->format('h:i A') }}</div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ auth()->user()->isWorker() ? '4' : '5' }}" class="px-6 py-4 border-b text-center text-gray-500">
                                            No transactions found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>