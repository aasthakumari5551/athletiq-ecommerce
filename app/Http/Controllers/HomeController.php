<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index()
    {
        if (! Schema::hasTable('banners')) {
            return view('home.index', [
                'banners' => collect(),
                'featuredBrands' => collect(),
                'newArrivals' => collect(),
                'categories' => collect(),
            ]);
        }

        $banners = Banner::where('is_active', true)->orderBy('sort_order')->take(3)->get();
        $featuredBrands = Brand::where('is_active', true)->where('is_featured', true)->take(8)->get();
        $newArrivals = Product::with(['brand', 'primaryImage'])
            ->where('is_active', true)
            ->latest()
            ->take(8)
            ->get();
        $categories = Category::where('is_active', true)->take(3)->get();

        return view('home.index', compact('banners', 'featuredBrands', 'newArrivals', 'categories'));
    }
}
