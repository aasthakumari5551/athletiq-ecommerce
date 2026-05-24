<?php

namespace App\Services;

use App\Http\Requests\StoreCheckoutRequest;
use App\Models\Address;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function createFromCart(StoreCheckoutRequest $request, CartService $cart): Order
    {
        return DB::transaction(function () use ($request, $cart) {

            $subtotal = $cart->total();
            $discount = session('coupon.discount', 0);
            $total    = max(0, $subtotal - $discount);

            $order = Order::create([
                'user_id'        => $request->user()->id,
                'subtotal'       => $subtotal,
                'total'          => $total,
                'status'         => 'pending',
                'payment_method' => 'cod',
                'notes'          => $request->validated('notes'),
            ]);

            foreach ($cart->items() as $item) {
                $order->items()->create([
                    'product_id'   => $item['product_id'],
                    'variant_id'   => $item['variant_id'],
                    'qty'          => $item['qty'],
                    'price'        => $item['price'],
                    'product_name' => $item['name'],
                ]);

                if ($item['variant_id']) {
                    ProductVariant::whereKey($item['variant_id'])->decrement('stock', $item['qty']);
                }
            }

            Address::create([
                'order_id' => $order->id,
                'name'     => $request->validated('name'),
                'phone'    => $request->validated('phone'),
                'address'  => $request->validated('address'),
                'city'     => $request->validated('city'),
                'state'    => $request->validated('state'),
                'pincode'  => $request->validated('pincode'),
            ]);

            // Coupon use count increment
            if (session('coupon.code')) {
                Coupon::where('code', session('coupon.code'))->increment('used_count');
                session()->forget('coupon');
            }

            $cart->clear();

            return $order;
        });
    }
}