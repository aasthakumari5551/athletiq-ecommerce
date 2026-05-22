<?php

namespace App\Services;

use App\Http\Requests\StoreCheckoutRequest;
use App\Models\Address;
use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function createFromCart(StoreCheckoutRequest $request, CartService $cart): Order
    {
        return DB::transaction(function () use ($request, $cart) {
            $order = Order::create([
                'user_id' => $request->user()->id,
                'subtotal' => $cart->total(),
                'total' => $cart->total(),
                'status' => 'pending',
                'payment_method' => 'cod',
                'notes' => $request->validated('notes'),
            ]);

            foreach ($cart->items() as $item) {
                $order->items()->create([
                    'product_id' => $item['product_id'],
                    'variant_id' => $item['variant_id'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'product_name' => $item['name'],
                ]);

                if ($item['variant_id']) {
                    ProductVariant::whereKey($item['variant_id'])->decrement('stock', $item['qty']);
                }
            }

            Address::create([
                'order_id' => $order->id,
                'name' => $request->validated('name'),
                'phone' => $request->validated('phone'),
                'address' => $request->validated('address'),
                'city' => $request->validated('city'),
                'state' => $request->validated('state'),
                'pincode' => $request->validated('pincode'),
            ]);

            $cart->clear();

            return $order;
        });
    }
}
