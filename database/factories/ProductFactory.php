<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);
        $price = fake()->randomFloat(2, 49, 299);

        return [
            'brand_id' => Brand::factory(),
            'category_id' => Category::factory(),
            'name' => Str::title($name),
            'slug' => Str::slug($name).'-'.fake()->unique()->numberBetween(1000, 9999),
            'description' => fake()->paragraphs(2, true),
            'price' => $price,
            'sale_price' => fake()->boolean(25) ? round($price * 0.8, 2) : null,
            'stock' => fake()->numberBetween(0, 100),
            'is_featured' => fake()->boolean(35),
            'is_active' => true,
        ];
    }
}
