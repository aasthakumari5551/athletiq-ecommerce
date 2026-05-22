<?php
namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['name' => 'Nike',          'description' => 'Just Do It.',                          'is_featured' => true],
            ['name' => 'Adidas',        'description' => 'Impossible is Nothing.',               'is_featured' => true],
            ['name' => 'Puma',          'description' => 'Forever Faster.',                      'is_featured' => true],
            ['name' => 'New Balance',   'description' => 'Fearlessly Independent Since 1906.',   'is_featured' => true],
            ['name' => 'Under Armour',  'description' => 'The Only Way is Through.',             'is_featured' => false],
        ];

        foreach ($brands as $brand) {
            Brand::create([
                'name'        => $brand['name'],
                'slug'        => Str::slug($brand['name']),
                'description' => $brand['description'],
                'is_featured' => $brand['is_featured'],
                'is_active'   => true,
            ]);
        }
    }
}