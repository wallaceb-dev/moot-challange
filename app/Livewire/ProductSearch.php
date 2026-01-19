<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

class ProductSearch extends Component
{
    #[Url(history: true)]
    public $search = '';

    #[Url]
    public $selectedCategories = [];

    #[Url]
    public $selectedBrands = [];

    public function clearFilters()
    {
        $this->reset(['search', 'selectedCategories', 'selectedBrands']);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $products = Product::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->selectedCategories, function ($query) {
                $query->whereHas('categories', function ($q) {
                    $q->whereIn('categories.id', $this->selectedCategories);
                });
            })
            ->when($this->selectedBrands, function ($query) {
                $query->whereIn('brand_id', $this->selectedBrands);
            })
            ->with(['categories', 'brand'])
            ->get();

        return view('livewire.product-search', [
            'products' => $products,
            'categories' => Category::all(),
            'brands' => Brand::all(),
        ]);
    }
}