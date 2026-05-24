<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Services\CartService;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function apply(Request $request, CartService $cart)
    {
        $request->validate([
            'coupon_code' => ['required', 'string'],
        ]);

        $coupon = Coupon::where('code', strtoupper($request->coupon_code))
            ->first();

        if (!$coupon || !$coupon->isValid()) {
            return back()->with('error', 'Invalid or expired coupon code.');
        }

        if ($cart->total() < $coupon->min_order) {
            return back()->with('error', "Minimum order of Rs. {$coupon->min_order} required.");
        }

        session(['coupon' => [
            'code'     => $coupon->code,
            'type'     => $coupon->type,
            'value'    => $coupon->value,
            'discount' => $coupon->calculateDiscount($cart->total()),
        ]]);

        return back()->with('success', "Coupon '{$coupon->code}' applied!");
    }

    public function remove()
    {
        session()->forget('coupon');
        return back()->with('success', 'Coupon removed.');
    }
}