<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $brands     = Brand::all()->keyBy('slug');
        $categories = Category::all()->keyBy('slug');

        $products = [

            // ── NIKE (12) ──────────────────────────────────────────────
            ['brand' => 'nike', 'category' => 'shoes',       'gender' => 'men',    'name' => 'Nike Air Max 270',            'price' => 14999, 'sale_price' => 12999],
            ['brand' => 'nike', 'category' => 'shoes',       'gender' => 'women',  'name' => 'Nike React Infinity Run',     'price' => 12999, 'sale_price' => null],
            ['brand' => 'nike', 'category' => 'shoes',       'gender' => 'men',    'name' => 'Nike ZoomX Vaporfly',         'price' => 17999, 'sale_price' => 15499],
            ['brand' => 'nike', 'category' => 'shoes',       'gender' => 'unisex', 'name' => 'Nike Pegasus 40',             'price' => 10999, 'sale_price' => null],
            ['brand' => 'nike', 'category' => 'apparel',     'gender' => 'men',    'name' => 'Nike Dri-FIT T-Shirt',        'price' => 2499,  'sale_price' => 1999],
            ['brand' => 'nike', 'category' => 'apparel',     'gender' => 'women',  'name' => 'Nike Therma Hoodie',          'price' => 4999,  'sale_price' => null],
            ['brand' => 'nike', 'category' => 'apparel',     'gender' => 'men',    'name' => 'Nike Pro Compression Tights', 'price' => 3499,  'sale_price' => 2999],
            ['brand' => 'nike', 'category' => 'apparel',     'gender' => 'women',  'name' => 'Nike Windrunner Jacket',      'price' => 7999,  'sale_price' => null],
            ['brand' => 'nike', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Nike Heritage Backpack',      'price' => 3999,  'sale_price' => 3499],
            ['brand' => 'nike', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Nike Dri-FIT Cap',            'price' => 1499,  'sale_price' => null],
            ['brand' => 'nike', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Nike Elite Crew Socks',       'price' => 799,   'sale_price' => null],
            ['brand' => 'nike', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Nike Hyperfuel Bottle',       'price' => 1299,  'sale_price' => 999],

            // ── ADIDAS (12) ────────────────────────────────────────────
            ['brand' => 'adidas', 'category' => 'shoes',       'gender' => 'men',    'name' => 'Adidas Ultraboost 23',        'price' => 15999, 'sale_price' => 13999],
            ['brand' => 'adidas', 'category' => 'shoes',       'gender' => 'women',  'name' => 'Adidas NMD R1',               'price' => 11999, 'sale_price' => null],
            ['brand' => 'adidas', 'category' => 'shoes',       'gender' => 'unisex', 'name' => 'Adidas Stan Smith',           'price' => 7999,  'sale_price' => 6999],
            ['brand' => 'adidas', 'category' => 'shoes',       'gender' => 'men',    'name' => 'Adidas Predator Edge',        'price' => 9999,  'sale_price' => null],
            ['brand' => 'adidas', 'category' => 'apparel',     'gender' => 'men',    'name' => 'Adidas Tiro 23 Track Jacket', 'price' => 5499,  'sale_price' => 4499],
            ['brand' => 'adidas', 'category' => 'apparel',     'gender' => 'women',  'name' => 'Adidas Essentials Hoodie',    'price' => 3999,  'sale_price' => null],
            ['brand' => 'adidas', 'category' => 'apparel',     'gender' => 'women',  'name' => 'Adidas Running T-Shirt',      'price' => 2299,  'sale_price' => 1799],
            ['brand' => 'adidas', 'category' => 'apparel',     'gender' => 'men',    'name' => 'Adidas 3-Stripe Shorts',      'price' => 2499,  'sale_price' => null],
            ['brand' => 'adidas', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Adidas Classic Backpack',     'price' => 3499,  'sale_price' => 2999],
            ['brand' => 'adidas', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Adidas Sport Cap',            'price' => 1299,  'sale_price' => null],
            ['brand' => 'adidas', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Adidas Performance Socks',    'price' => 699,   'sale_price' => null],
            ['brand' => 'adidas', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Adidas Water Bottle 1L',      'price' => 1199,  'sale_price' => 899],

            // ── PUMA (12) ──────────────────────────────────────────────
            ['brand' => 'puma', 'category' => 'shoes',       'gender' => 'men',    'name' => 'Puma RS-X Reinvention',     'price' => 8999,  'sale_price' => 7499],
            ['brand' => 'puma', 'category' => 'shoes',       'gender' => 'women',  'name' => 'Puma Suede Classic XXI',    'price' => 6999,  'sale_price' => null],
            ['brand' => 'puma', 'category' => 'shoes',       'gender' => 'men',    'name' => 'Puma Velocity Nitro 2',     'price' => 10999, 'sale_price' => 9499],
            ['brand' => 'puma', 'category' => 'shoes',       'gender' => 'women',  'name' => 'Puma Future Rider',         'price' => 7499,  'sale_price' => null],
            ['brand' => 'puma', 'category' => 'apparel',     'gender' => 'women',  'name' => 'Puma Run Favourite Tee',    'price' => 1999,  'sale_price' => 1599],
            ['brand' => 'puma', 'category' => 'apparel',     'gender' => 'unisex', 'name' => 'Puma Squad Hoodie',         'price' => 3499,  'sale_price' => null],
            ['brand' => 'puma', 'category' => 'apparel',     'gender' => 'men',    'name' => 'Puma Essentials Shorts',    'price' => 1799,  'sale_price' => null],
            ['brand' => 'puma', 'category' => 'apparel',     'gender' => 'men',    'name' => 'Puma Fit Training Jacket',  'price' => 4999,  'sale_price' => 3999],
            ['brand' => 'puma', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Puma Phase Backpack',       'price' => 2799,  'sale_price' => null],
            ['brand' => 'puma', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Puma Sport Cap',            'price' => 999,   'sale_price' => 799],
            ['brand' => 'puma', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'Puma Crew Socks 3-Pack',    'price' => 899,   'sale_price' => null],
            ['brand' => 'puma', 'category' => 'accessories', 'gender' => 'men',    'name' => 'Puma Training Gloves',      'price' => 1499,  'sale_price' => 1199],

            // ── NEW BALANCE (12) ───────────────────────────────────────
            ['brand' => 'new-balance', 'category' => 'shoes',       'gender' => 'men',    'name' => 'New Balance 990v6',              'price' => 16999, 'sale_price' => null],
            ['brand' => 'new-balance', 'category' => 'shoes',       'gender' => 'women',  'name' => 'New Balance Fresh Foam 1080',    'price' => 13999, 'sale_price' => 12499],
            ['brand' => 'new-balance', 'category' => 'shoes',       'gender' => 'unisex', 'name' => 'New Balance 574 Core',           'price' => 7999,  'sale_price' => null],
            ['brand' => 'new-balance', 'category' => 'shoes',       'gender' => 'men',    'name' => 'New Balance FuelCell Rebel',     'price' => 11499, 'sale_price' => 9999],
            ['brand' => 'new-balance', 'category' => 'apparel',     'gender' => 'men',    'name' => 'NB Athletics Jersey',            'price' => 2999,  'sale_price' => null],
            ['brand' => 'new-balance', 'category' => 'apparel',     'gender' => 'women',  'name' => 'NB Essentials Stacked Hoodie',   'price' => 4499,  'sale_price' => 3799],
            ['brand' => 'new-balance', 'category' => 'apparel',     'gender' => 'men',    'name' => 'NB Impact Run Shorts',           'price' => 2299,  'sale_price' => null],
            ['brand' => 'new-balance', 'category' => 'apparel',     'gender' => 'women',  'name' => 'NB Tenacity Woven Jacket',       'price' => 6499,  'sale_price' => 5499],
            ['brand' => 'new-balance', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'NB Team Backpack',               'price' => 3299,  'sale_price' => null],
            ['brand' => 'new-balance', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'NB Sport Trucker Cap',           'price' => 1399,  'sale_price' => 1099],
            ['brand' => 'new-balance', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'NB Cushion Ankle Socks',         'price' => 749,   'sale_price' => null],
            ['brand' => 'new-balance', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'NB Running Belt',                'price' => 1799,  'sale_price' => 1499],

            // ── UNDER ARMOUR (12) ──────────────────────────────────────
            ['brand' => 'under-armour', 'category' => 'shoes',       'gender' => 'men',    'name' => 'UA HOVR Phantom 3',           'price' => 13999, 'sale_price' => 11999],
            ['brand' => 'under-armour', 'category' => 'shoes',       'gender' => 'men',    'name' => 'UA Charged Assert 10',        'price' => 7499,  'sale_price' => null],
            ['brand' => 'under-armour', 'category' => 'shoes',       'gender' => 'men',    'name' => 'UA Reign 6 Training',         'price' => 8999,  'sale_price' => 7999],
            ['brand' => 'under-armour', 'category' => 'shoes',       'gender' => 'women',  'name' => 'UA SpeedForm Amp',            'price' => 6999,  'sale_price' => null],
            ['brand' => 'under-armour', 'category' => 'apparel',     'gender' => 'men',    'name' => 'UA HeatGear Compression Tee', 'price' => 2799,  'sale_price' => 2299],
            ['brand' => 'under-armour', 'category' => 'apparel',     'gender' => 'unisex', 'name' => 'UA Rival Fleece Hoodie',      'price' => 4499,  'sale_price' => null],
            ['brand' => 'under-armour', 'category' => 'apparel',     'gender' => 'men',    'name' => 'UA Launch 7" Shorts',         'price' => 2599,  'sale_price' => null],
            ['brand' => 'under-armour', 'category' => 'apparel',     'gender' => 'women',  'name' => 'UA Storm ColdGear Jacket',    'price' => 8499,  'sale_price' => 6999],
            ['brand' => 'under-armour', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'UA Hustle 5.0 Backpack',      'price' => 4299,  'sale_price' => 3699],
            ['brand' => 'under-armour', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'UA Blitzing Cap',             'price' => 1599,  'sale_price' => null],
            ['brand' => 'under-armour', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'UA Performance Tech Socks',   'price' => 899,   'sale_price' => null],
            ['brand' => 'under-armour', 'category' => 'accessories', 'gender' => 'unisex', 'name' => 'UA Sideline 32oz Bottle',     'price' => 1999,  'sale_price' => 1599],
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