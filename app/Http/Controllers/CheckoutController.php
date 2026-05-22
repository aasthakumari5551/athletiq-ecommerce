<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCheckoutRequest;
use App\Models\Order;
use App\Services\CartService;
use App\Services\OrderService;

class CheckoutController extends Controller
{
    public function index(CartService $cart)
    {
        if ($cart->count() === 0) {
            return redirect()->route('cart.index')->with('success', 'Your cart is empty.');
        }

        return view('checkout.index', [
            'items' => $cart->items(),
            'total' => $cart->total(),
        ]);
    }

    public function store(StoreCheckoutRequest $request, CartService $cart, OrderService $orders)
    {
        if ($cart->count() === 0) {
            return redirect()->route('cart.index')->with('success', 'Your cart is empty.');
        }

        $order = $orders->createFromCart($request, $cart);

        return redirect()
            ->route('checkout.success', $order)
            ->with('success', 'Order placed.');
    }

    public function success(Order $order)
    {
        abort_unless($order->user_id === auth()->id(), 403);

        return view('checkout.success', compact('order'));
    }
}
