<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewBrandsProductSeeder extends Seeder
{
    public function run(): void
    {
        $brands     = Brand::all()->keyBy('slug');
        $categories = Category::all()->keyBy('slug');

        $products = [

            // ── JORDAN (12) ────────────────────────────────────────────
            ['brand' => 'jordan', 'category' => 'shoes',       'gender' => 'men',    'name' => 'Jordan Air 1 Retro High',      'price' => 18999, 'sale_price' => 15999],
            ['brand' => 'jordan', 'category' => 'shoes',       'gender' => 'men',    'name' => 'Jordan Air 1 Mid',             'price' => 12999, 'sale_price' => null],
            ['brand' => 'jordan', 'category' => 'shoes',       'gender' => 'women',  'name' => 'Jordan Air 1 Low SE',          'price' => 10999, 'sale_price' => 9499],
            ['brand' => 'jordan', 'category' => 'shoes',       'gender' => 'unisex', 'name' => 'Jordan Max Aura 5',            'price' => 9999,  'sale_price' => null],
            ['brand' => 'jordan', 'category' => 'apparel',     'gender' => 'men',    'name' => 'Jordan Flight MVP T-Shirt',    'price' => 2999,  'sale_price' => 2499],
            ['brand' => 'jordan', 'category' => 'apparel',     'gender' => 'men',    'name' => 'Jordan Essential Fleece',      'price' => 5499,  'sale_price' => null],
            ['brand' => 'jordan', 'category' => 'apparel',     'gender' => 'women',  'name' => 'Jordan Sport Dress',           'price' => 4999,  'sale_price' => 3999],
            ['brand' => 'jordan', 'category' => 'apparel',     'gender' => 'men',    'name' => 'Jordan Dri-FIT Air Shorts',    'price' => 3499,  'sale_price' => null],
            ['brand' => 'jordan', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Jordan Backpack',              'price' => 4499,  'sale_price' => 3999],
            ['brand' => 'jordan', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Jordan Pro Cap',               'price' => 1799,  'sale_price' => null],
            ['brand' => 'jordan', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Jordan Jumpman Socks',         'price' => 899,   'sale_price' => null],
            ['brand' => 'jordan', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Jordan Sport Water Bottle',    'price' => 1499,  'sale_price' => 1199],

            // ── REEBOK (12) ────────────────────────────────────────────
            ['brand' => 'reebok', 'category' => 'shoes',       'gender' => 'men',    'name' => 'Reebok Classic Leather',       'price' => 7999,  'sale_price' => 6499],
            ['brand' => 'reebok', 'category' => 'shoes',       'gender' => 'women',  'name' => 'Reebok Club C 85',             'price' => 6999,  'sale_price' => null],
            ['brand' => 'reebok', 'category' => 'shoes',       'gender' => 'men',    'name' => 'Reebok Nano X3',               'price' => 10999, 'sale_price' => 9499],
            ['brand' => 'reebok', 'category' => 'shoes',       'gender' => 'women',  'name' => 'Reebok Floatride Energy 5',    'price' => 8999,  'sale_price' => null],
            ['brand' => 'reebok', 'category' => 'apparel',     'gender' => 'men',    'name' => 'Reebok Identity T-Shirt',      'price' => 1999,  'sale_price' => 1599],
            ['brand' => 'reebok', 'category' => 'apparel',     'gender' => 'women',  'name' => 'Reebok Lux Hoodie',            'price' => 3999,  'sale_price' => null],
            ['brand' => 'reebok', 'category' => 'apparel',     'gender' => 'men',    'name' => 'Reebok Training Shorts',       'price' => 2299,  'sale_price' => null],
            ['brand' => 'reebok', 'category' => 'apparel',     'gender' => 'women',  'name' => 'Reebok Workout Jacket',        'price' => 4999,  'sale_price' => 3999],
            ['brand' => 'reebok', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Reebok Training Backpack',     'price' => 2999,  'sale_price' => null],
            ['brand' => 'reebok', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Reebok Sport Cap',             'price' => 1199,  'sale_price' => 999],
            ['brand' => 'reebok', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Reebok Performance Socks',     'price' => 699,   'sale_price' => null],
            ['brand' => 'reebok', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Reebok Sport Bottle',          'price' => 1099,  'sale_price' => 899],

            // ── FILA (12) ──────────────────────────────────────────────
            ['brand' => 'fila', 'category' => 'shoes',       'gender' => 'men',    'name' => 'Fila Disruptor II',             'price' => 6999,  'sale_price' => 5999],
            ['brand' => 'fila', 'category' => 'shoes',       'gender' => 'women',  'name' => 'Fila Mindblower',               'price' => 7999,  'sale_price' => null],
            ['brand' => 'fila', 'category' => 'shoes',       'gender' => 'men',    'name' => 'Fila Ray Tracer',               'price' => 5999,  'sale_price' => 4999],
            ['brand' => 'fila', 'category' => 'shoes',       'gender' => 'unisex', 'name' => 'Fila Original Fitness',         'price' => 5499,  'sale_price' => null],
            ['brand' => 'fila', 'category' => 'apparel',     'gender' => 'men',    'name' => 'Fila Heritage Logo Tee',        'price' => 1799,  'sale_price' => 1399],
            ['brand' => 'fila', 'category' => 'apparel',     'gender' => 'women',  'name' => 'Fila Crop Hoodie',              'price' => 3499,  'sale_price' => null],
            ['brand' => 'fila', 'category' => 'apparel',     'gender' => 'men',    'name' => 'Fila Sport Track Jacket',       'price' => 4499,  'sale_price' => 3499],
            ['brand' => 'fila', 'category' => 'apparel',     'gender' => 'women',  'name' => 'Fila Tennis Skirt',             'price' => 2499,  'sale_price' => null],
            ['brand' => 'fila', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Fila Heritage Backpack',        'price' => 2799,  'sale_price' => null],
            ['brand' => 'fila', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Fila Sport Cap',                'price' => 999,   'sale_price' => 799],
            ['brand' => 'fila', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Fila Crew Socks',               'price' => 599,   'sale_price' => null],
            ['brand' => 'fila', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Fila Sport Bottle',             'price' => 999,   'sale_price' => 799],

            // ── SKECHERS (12) ──────────────────────────────────────────
            ['brand' => 'skechers', 'category' => 'shoes',       'gender' => 'men',    'name' => 'Skechers Go Walk 6',           'price' => 5999,  'sale_price' => 4999],
            ['brand' => 'skechers', 'category' => 'shoes',       'gender' => 'women',  'name' => 'Skechers DLites',               'price' => 6499,  'sale_price' => null],
            ['brand' => 'skechers', 'category' => 'shoes',       'gender' => 'men',    'name' => 'Skechers Arch Fit',             'price' => 7999,  'sale_price' => 6999],
            ['brand' => 'skechers', 'category' => 'shoes',       'gender' => 'women',  'name' => 'Skechers Go Run Consistent',    'price' => 5499,  'sale_price' => null],
            ['brand' => 'skechers', 'category' => 'apparel',     'gender' => 'men',    'name' => 'Skechers Sport Tee',            'price' => 1599,  'sale_price' => 1299],
            ['brand' => 'skechers', 'category' => 'apparel',     'gender' => 'women',  'name' => 'Skechers Active Hoodie',        'price' => 2999,  'sale_price' => null],
            ['brand' => 'skechers', 'category' => 'apparel',     'gender' => 'men',    'name' => 'Skechers Training Shorts',      'price' => 1799,  'sale_price' => null],
            ['brand' => 'skechers', 'category' => 'apparel',     'gender' => 'women',  'name' => 'Skechers Flex Appeal Jacket',   'price' => 3999,  'sale_price' => 3299],
            ['brand' => 'skechers', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Skechers Sport Backpack',       'price' => 2499,  'sale_price' => null],
            ['brand' => 'skechers', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Skechers Sport Cap',            'price' => 899,   'sale_price' => 699],
            ['brand' => 'skechers', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Skechers Comfort Socks',        'price' => 599,   'sale_price' => null],
            ['brand' => 'skechers', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Skechers Hydration Bottle',     'price' => 1299,  'sale_price' => 999],

            // ── NIVIA SPORTS (12) ──────────────────────────────────────
            ['brand' => 'nivia-sports', 'category' => 'shoes',       'gender' => 'men',    'name' => 'Nivia Encounter Running Shoes', 'price' => 2999,  'sale_price' => 2499],
            ['brand' => 'nivia-sports', 'category' => 'shoes',       'gender' => 'women',  'name' => 'Nivia Swift Running Shoes',     'price' => 2499,  'sale_price' => null],
            ['brand' => 'nivia-sports', 'category' => 'shoes',       'gender' => 'men',    'name' => 'Nivia Pace Football Shoes',     'price' => 3499,  'sale_price' => 2999],
            ['brand' => 'nivia-sports', 'category' => 'shoes',       'gender' => 'men',    'name' => 'Nivia Storm Basketball Shoes',  'price' => 3999,  'sale_price' => null],
            ['brand' => 'nivia-sports', 'category' => 'apparel',     'gender' => 'men',    'name' => 'Nivia Dryfit T-Shirt',          'price' => 899,   'sale_price' => 699],
            ['brand' => 'nivia-sports', 'category' => 'apparel',     'gender' => 'men',    'name' => 'Nivia Football Jersey',         'price' => 1299,  'sale_price' => null],
            ['brand' => 'nivia-sports', 'category' => 'apparel',     'gender' => 'men',    'name' => 'Nivia Training Shorts',         'price' => 799,   'sale_price' => 599],
            ['brand' => 'nivia-sports', 'category' => 'apparel',     'gender' => 'women',  'name' => 'Nivia Women Sport Top',         'price' => 999,   'sale_price' => null],
            ['brand' => 'nivia-sports', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Nivia Gym Bag',                 'price' => 1499,  'sale_price' => 1199],
            ['brand' => 'nivia-sports', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Nivia Sports Cap',              'price' => 599,   'sale_price' => null],
            ['brand' => 'nivia-sports', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Nivia Crew Socks',              'price' => 399,   'sale_price' => null],
            ['brand' => 'nivia-sports', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Nivia Water Bottle',            'price' => 699,   'sale_price' => 499],
        ];

        $shoeSizes    = [7, 8, 9, 10, 11];
        $apparelSizes = ['S', 'M', 'L', 'XL'];

        foreach ($products as $data) {
            $brand    = $brands[$data['brand']] ?? null;
            $category = $categories[$data['category']] ?? null;

            if (!$brand || !$category) continue;

            $product = Product::create([
                'brand_id'    => $brand->id,
                'category_id' => $category->id,
                'name'        => $data['name'],
                'slug'        => Str::slug($data['name']),
                'description' => "Premium {$data['name']} — built for performance and everyday style.",
                'price'       => $data['price'],
                'sale_price'  => $data['sale_price'],
                'stock'       => rand(20, 100),
                'gender'      => $data['gender'],
                'is_featured' => rand(0, 1),
                'is_active'   => true,
            ]);

            $sizes = $data['category'] === 'shoes' ? $shoeSizes : $apparelSizes;
            foreach ($sizes as $size) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'size'       => (string) $size,
                    'stock'      => rand(5, 25),
                    'sku'        => strtoupper(Str::random(8)),
                ]);
            }
        }
    }
}