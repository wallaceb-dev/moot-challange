<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
        return [
            'name' => fake()->name(),
            'brand_id' => Brand::factory(),
        ];
    }

    public function associaCategorias(int $count = 2)
    {
        return $this->afterCreating(function ($product) use ($count) {
            $categories = Category::factory()->count($count)->create();
            $product->categories()->attach($categories);
        });
    }
}
