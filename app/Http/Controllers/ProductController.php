<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\QueryBuilders\ProductFilter;

class ProductController extends Controller
{
    public function index()
    {
        $products = (new ProductFilter())->apply(
            Product::query()->with(['brand', 'category', 'primaryImage']),
            request()
        )->paginate(12)->withQueryString();

        $brands = Brand::where('is_active', true)->orderBy('name')->get();
        $categories = Category::where('is_active', true)->orderBy('name')->get();

        return view('products.index', compact('products', 'brands', 'categories'));
    }

    public function show(string $slug)
    {
        $product = Product::with(['brand', 'category', 'images', 'variants'])
            ->where('is_active', true)
            ->where('slug', $slug)
            ->firstOrFail();

        $related = Product::with(['brand', 'primaryImage'])
            ->where('is_active', true)
            ->where('id', '!=', $product->id)
            ->where('brand_id', $product->brand_id)
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'related'));
    }
}
