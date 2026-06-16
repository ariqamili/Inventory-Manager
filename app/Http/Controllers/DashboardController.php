<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $business = auth()->user()->business;
        
        $totalProducts = $business->products()->count();
        $lowStockProducts = $business->products()->where('stock', '<', 10)->get();
        $totalCategories = $business->categories()->count();
        $recentTransactions = $business->transactions()->with(['product', 'user'])->latest()->take(5)->get();
        
        return view('dashboard', compact('totalProducts', 'lowStockProducts', 'totalCategories', 'recentTransactions'));
    }
}