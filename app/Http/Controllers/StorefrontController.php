<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Schema;

class StorefrontController extends Controller
{
    public function home(): View
    {
        $featured = Schema::hasTable('products')
            ? Product::with('category')->where('is_featured', true)->orderBy('display_order')->orderBy('name')->take(3)->get()
            : collect();

        return view('storefront.home', compact('featured'));
    }

    public function shop(): View
    {
        $products = Schema::hasTable('products')
            ? Product::with('category')->orderBy('display_order')->orderBy('name')->get()
            : collect();

        return view('storefront.shop', compact('products'));
    }

    public function show(Product $product): View
    {
        $related = Schema::hasTable('products')
            ? Product::query()->whereKeyNot($product->id)->orderBy('display_order')->take(3)->get()
            : collect();

        return view('storefront.product', compact('product', 'related'));
    }

    public function cart(): View
    {
        $cart = session('cart', []);
        if (! Schema::hasTable('products')) {
            $items = collect();
        } else {
            $items = Product::query()
                ->whereIn('id', array_keys($cart))
                ->get()
                ->map(function (Product $product) use ($cart): array {
                    $qty = max(1, (int) ($cart[$product->id] ?? 1));

                    return [
                        'product' => $product,
                        'qty' => $qty,
                        'line_total' => $qty * (float) $product->price,
                    ];
                });
        }

        $subtotal = $items->sum('line_total');
        $tax = $subtotal * 0.08;
        $total = $subtotal + $tax;

        return view('storefront.cart', compact('items', 'subtotal', 'tax', 'total'));
    }
}
