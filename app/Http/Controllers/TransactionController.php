<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        
        if ($user->isWorker()) {
            $transactions = $user->transactions()
                ->with('product')
                ->latest()
                ->paginate(15);
        } else {
            $transactions = $user->business->transactions()
                ->with(['product', 'user'])
                ->latest()
                ->paginate(15);
        }
        
        return view('transactions.index', compact('transactions'));
    }

    
    public function create(Product $product): View
    {
        return view('transactions.create', compact('product'));
    }

    
    public function store(Request $request, Product $product): RedirectResponse
    {
        $validatedData = $request->validate([
            'quantity_sold' => 'required|integer|min:1|max:' . $product->stock,
        ]);

        $totalAmount = $product->price * $validatedData['quantity_sold'];

        Transaction::create([
            'business_id' => auth()->user()->business_id,
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'quantity_sold' => $validatedData['quantity_sold'],
            'total_amount' => $totalAmount,
        ]);

        $product->decrement('stock', $validatedData['quantity_sold']);

        return redirect()->route('products.index')->with('success', 'Product sold successfully!');
    }
}