<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Monolog\Processor\IntrospectionProcessor;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apple = Brand::where('name', 'Apple')->first();
        $samsung = Brand::where('name', 'Samsung')->first();
        $dell = Brand::where('name', 'Dell')->first();
        $lg = Brand::where('name', 'LG')->first();
        $microsoft = Brand::where('name', 'Microsoft')->first();

        $notebook = Category::where('name', 'Notebook')->first();
        $smartphone = Category::where('name', 'Smartphone')->first();
        $accessories = Category::where('name', 'Accessories')->first();
        $televisions = Category::where('name', 'Televisions')->first();
        $wearables = Category::where('name', 'Wearables')->first();

        Product::create([
            'name' => 'TV 4K UHD 55"',
            'brand_id' => $lg->id,
        ])->categories()->attach([$televisions->id]);

        Product::create([
            'name' => 'Headphones Pro',
            'brand_id' => $microsoft->id,
        ])->categories()->attach([$wearables->id, $accessories->id]);

        Product::create([
            'name' => 'MacBook Pro',
            'brand_id' => $apple->id,
        ])->categories()->attach([$notebook->id]);

        Product::create([
            'name' => 'iPhone 15',
            'brand_id' => $apple->id,
        ])->categories()->attach([$smartphone->id]);

        Product::create([
            'name' => 'Galaxy S24',
            'brand_id' => $samsung->id,
        ])->categories()->attach([$smartphone->id]);

        Product::create([
            'name' => 'Dell XPS 13',
            'brand_id' => $dell->id,
        ])->categories()->attach([$notebook->id]);

        Product::create([
            'name' => 'USB-C Charger',
            'brand_id' => $samsung->id,
        ])->categories()->attach([$accessories->id]);
    }
}
