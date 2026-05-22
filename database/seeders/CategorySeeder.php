<?php
// database/seeders/CategorySeeder.php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Shoes',       'description' => 'Athletic and lifestyle footwear'],
            ['name' => 'Apparel',     'description' => 'Performance and casual clothing'],
            ['name' => 'Accessories', 'description' => 'Bags, socks, caps and more'],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name'        => $cat['name'],
                'slug'        => Str::slug($cat['name']),
                'description' => $cat['description'],
                'is_active'   => true,
            ]);
        }
    }
}