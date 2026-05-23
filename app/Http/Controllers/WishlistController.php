<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function __construct()
    {
        // Laravel 12 — middleware in routes
    }

    public function index()
    {
        $wishlists = auth()->user()->wishlists()
            ->with(['product.primaryImage', 'product.brand'])
            ->latest()
            ->get();

        return view('wishlist.index', compact('wishlists'));
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $existing = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existing) {
            $existing->delete();
            $message = 'Removed from wishlist.';
        } else {
            Wishlist::create([
                'user_id'    => auth()->id(),
                'product_id' => $request->product_id,
            ]);
            $message = 'Added to wishlist!';
        }

        return back()->with('success', $message);
    }

    public function remove(Wishlist $wishlist)
    {
        $wishlist->delete();
        return back()->with('success', 'Removed from wishlist.');
    }
}