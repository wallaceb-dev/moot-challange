<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <aside class="bg-white p-6 rounded-lg shadow-md h-fit">
            <h2 class="text-lg font-bold mb-4 border-b pb-2">Filtros</h2>

            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Ex: iPhone..."
                class="w-full rounded-lg shadow-sm border border-gray-200 py-2 px-4 mb-3 text-gray-700 focus:ring-2 focus:ring-indigo-400 transition-all outline-none">

            <div class="mb-6">
                <h3 class="text-sm font-semibold text-gray-900 mb-2">Categorias</h3>
                @foreach ($categories as $category)
                    <div class="flex items-center mb-1">
                        <input wire:model.live="selectedCategories" type="checkbox" value="{{ $category->id }}"
                            id="cat-{{ $category->id }}" class="rounded text-indigo-600">
                        <label for="cat-{{ $category->id }}"
                            class="ml-2 text-sm text-gray-600">{{ $category->name }}</label>
                    </div>
                @endforeach
            </div>

            <div class="mb-6">
                <h3 class="text-sm font-semibold text-gray-900 mb-2">Marcas</h3>
                @foreach ($brands as $brand)
                    <div class="flex items-center mb-1">
                        <input wire:model.live="selectedBrands" type="checkbox" value="{{ $brand->id }}"
                            id="brand-{{ $brand->id }}" class="rounded text-indigo-600">
                        <label for="brand-{{ $brand->id }}"
                            class="ml-2 text-sm text-gray-600">{{ $brand->name }}</label>
                    </div>
                @endforeach
            </div>

            <button wire:click="clearFilters"
                class="w-full bg-red-50 text-red-600 font-semibold py-2 rounded-md border border-red-200 hover:bg-red-100 transition">
                Limpar Filtros
            </button>
        </aside>

        <section class="md:col-span-3">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($products as $product)
                    <div class="bg-white p-4 rounded-lg shadow hover:shadow-md transition border border-gray-100">
                        <div class="text-xs font-bold text-indigo-500 uppercase tracking-wide">
                            {{ $product->brand->name }}</div>
                        <h4 class="text-lg font-bold text-gray-900 mb-1">{{ $product->name }}</h4>
                        @foreach ($product->categories as $category)
                            <span
                                class="inline-block bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded">{{ $category->name }}</span>
                        @endforeach
                    </div>
                @empty
                    <div class="col-span-full bg-white p-10 text-center rounded-lg shadow">
                        <p class="text-gray-500">Nenhum produto encontrado com esses filtros.</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</div>
