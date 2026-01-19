<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apple = Brand::where('nome', 'Apple')->first();
        $samsung = Brand::where('nome', 'Samsung')->first();
        $dell = Brand::where('nome', 'Dell')->first();

        $notebook = Category::where('nome', 'Notebook')->first();
        $smartphone = Category::where('nome', 'Smartphone')->first();
        $accessories = Category::where('nome', 'Accessories')->first();

        Product::create([
            'nome' => 'MacBook Pro',
            'marca_id' => $apple->id,
        ])->categories()->attach([$notebook->id]);

        Product::create([
            'nome' => 'iPhone 15',
            'marca_id' => $apple->id,
        ])->categories()->attach([$smartphone->id]);

        Product::create([
            'nome' => 'Galaxy S24',
            'marca_id' => $samsung->id,
        ])->categories()->attach([$smartphone->id]);

        Product::create([
            'nome' => 'Dell XPS 13',
            'marca_id' => $dell->id,
        ])->categories()->attach([$notebook->id]);

        Product::create([
            'nome' => 'USB-C Charger',
            'marca_id' => $samsung->id,
        ])->categories()->attach([$accessories->id]);
    }
}
