<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'body'   => ['nullable', 'string', 'max:1000'],
        ]);

        // Check already reviewed
        $existing = Review::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {
            return back()->with('error', 'You have already reviewed this product.');
        }

        Review::create([
            'user_id'     => auth()->id(),
            'product_id'  => $product->id,
            'rating'      => $request->rating,
            'body'        => $request->body,
            'is_approved' => false,
        ]);

        return back()->with('success', 'Review submitted! It will appear after approval.');
    }
}