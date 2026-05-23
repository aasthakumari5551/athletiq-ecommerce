<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(CartService $cart)
    {
        return view('cart.index', [
            'items' => $cart->items(),
            'total' => $cart->total(),
        ]);
    }

    public function add(Request $request, CartService $cart)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'variant_id' => ['nullable', 'exists:product_variants,id'],
            'qty' => ['nullable', 'integer', 'min:1', 'max:10'],
        ]);

        $product = Product::with(['brand', 'primaryImage'])->findOrFail($validated['product_id']);
        $cart->add($product, $validated['variant_id'] ?? null, (int) ($validated['qty'] ?? 1));

        return redirect()->route('cart.index')->with('success', 'Added to cart.');
    }

    public function update(Request $request, CartService $cart)
    {
        $validated = $request->validate([
            'item_key' => ['required', 'string'],
            'qty' => ['required', 'integer', 'min:0', 'max:10'],
        ]);

        $cart->update($validated['item_key'], (int) $validated['qty']);

        return back()->with('success', 'Cart updated.');
    }

    public function remove(string $id, CartService $cart)
    {
        $cart->remove($id);

        return back()->with('success', 'Item removed.');
    }
}