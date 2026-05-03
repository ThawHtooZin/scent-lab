<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, Product $product): RedirectResponse
    {
        $quantity = max(1, (int) $request->integer('quantity', 1));
        $cart = session('cart', []);

        $cart[$product->id] = ($cart[$product->id] ?? 0) + $quantity;

        session(['cart' => $cart]);

        return back()->with('status', "{$product->name} added to your selection.");
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $quantity = max(1, (int) $request->integer('quantity', 1));
        $cart = session('cart', []);
        $cart[$product->id] = $quantity;

        session(['cart' => $cart]);

        return back();
    }

    public function remove(Product $product): RedirectResponse
    {
        $cart = session('cart', []);
        unset($cart[$product->id]);
        session(['cart' => $cart]);

        return back();
    }
}
