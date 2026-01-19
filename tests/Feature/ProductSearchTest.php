<?php

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Livewire\ProductSearch;
use Livewire\Livewire;

test('renderiza o componente de busca com sucesso', function () {
    Livewire::test(ProductSearch::class)
        ->assertStatus(200);
});

test('filtra produtos por nome, categoria (pivô) e marca combinados', function () {
    $category = Category::factory()->create(['name' => 'Eletrônicos']);
    $brand = Brand::factory()->create(['name' => 'Apple']);
    
    $productMatch = Product::factory()->create(['name' => 'iPhone 15', 'brand_id' => $brand->id]);
    $productMatch->categories()->attach($category);

    $productNoMatch = Product::factory()->create(['name' => 'Samsung TV']);

    Livewire::test(ProductSearch::class)
        ->set('search', 'iPhone')
        ->set('selectedCategories', [$category->id])
        ->set('selectedBrands', [$brand->id])
        ->assertSee('iPhone 15')
        ->assertDontSee('Samsung TV');
});

test('mantém os filtros na URL ao atualizar a página', function () {
    Livewire::withQueryParams(['search' => 'Macbook'])
        ->test(ProductSearch::class)
        ->assertSet('search', 'Macbook');
});

test('limpa todos os filtros ao acionar o método de reset', function () {
    Livewire::test(ProductSearch::class)
        ->set('search', 'iPad')
        ->set('selectedCategories', [1, 2])
        ->call('clearFilters')
        ->assertSet('search', '')
        ->assertSet('selectedCategories', []);
});