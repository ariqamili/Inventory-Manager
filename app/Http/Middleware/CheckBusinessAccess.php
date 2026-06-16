<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBusinessAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        
        $product = $request->route('product');
        $category = $request->route('category');

        if ($product && $product->business_id !== $user->business_id) {
            abort(403, 'This product does not belong to your business.');
        }

        if ($category && $category->business_id !== $user->business_id) {
            abort(403, 'This category does not belong to your business.');
        }

        return $next($request);
    }
}