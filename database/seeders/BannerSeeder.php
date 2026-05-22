<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'title'      => 'JUST DO IT.',
                'subtitle'   => 'New Season. New Gear. No Excuses.',
                'link'       => '/brands/nike',
                'sort_order' => 1,
                'is_active'  => true,
            ],
            [
                'title'      => 'IMPOSSIBLE IS NOTHING',
                'subtitle'   => 'The latest Adidas Ultraboost is here.',
                'link'       => '/brands/adidas',
                'sort_order' => 2,
                'is_active'  => true,
            ],
            [
                'title'      => 'FOREVER FASTER',
                'subtitle'   => 'Puma SS24 Collection — Shop Now.',
                'link'       => '/brands/puma',
                'sort_order' => 3,
                'is_active'  => true,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}