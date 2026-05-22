<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\QueryBuilders\ProductFilter;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::withCount('products')
            ->where('is_active', true)
            ->orderByDesc('is_featured')
            ->orderBy('name')
            ->get();

        return view('brands.index', compact('brands'));
    }

    public function show(string $slug)
    {
        $brand = Brand::where('is_active', true)->where('slug', $slug)->firstOrFail();
        $products = (new ProductFilter())->apply(
            $brand->products()->with(['primaryImage', 'brand', 'category']),
            request()
        )->paginate(16)->withQueryString();

        return view('brands.show', compact('brand', 'products'));
    }
}
