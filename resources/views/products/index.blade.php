@extends('layouts.app')

@section('content')
    <section class="bg-black px-4 pb-16 pt-36 text-white sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <p class="text-sm font-black uppercase text-white/50">Catalog</p>
            <h1 class="mt-4 text-5xl font-black uppercase leading-none sm:text-7xl">All products.</h1>
        </div>
    </section>

    <section class="bg-white py-12">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-[260px_1fr] lg:px-8">
            <aside>
                <form method="GET" class="space-y-6">
                    <div>
                        <label class="text-xs font-black uppercase text-gray-500">Search</label>
                        <input name="q" value="{{ request('q') }}" class="mt-2 w-full border-gray-300 text-sm focus:border-black focus:ring-black" placeholder="Product name">
                    </div>

                    <div>
                        <label class="text-xs font-black uppercase text-gray-500">Brand</label>
                        <select name="brand" class="mt-2 w-full border-gray-300 text-sm focus:border-black focus:ring-black">
                            <option value="">All brands</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->slug }}" @selected(request('brand') === $brand->slug)>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-xs font-black uppercase text-gray-500">Category</label>
                        <select name="category" class="mt-2 w-full border-gray-300 text-sm focus:border-black focus:ring-black">
                            <option value="">All categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-xs font-black uppercase text-gray-500">Min</label>
                            <input name="min_price" value="{{ request('min_price') }}" type="number" min="0" class="mt-2 w-full border-gray-300 text-sm focus:border-black focus:ring-black">
                        </div>
                        <div>
                            <label class="text-xs font-black uppercase text-gray-500">Max</label>
                            <input name="max_price" value="{{ request('max_price') }}" type="number" min="0" class="mt-2 w-full border-gray-300 text-sm focus:border-black focus:ring-black">
                        </div>
                    </div>

                    <div>
                        <label class="text-xs font-black uppercase text-gray-500">Sort</label>
                        <select name="sort" class="mt-2 w-full border-gray-300 text-sm focus:border-black focus:ring-black">
                            <option value="">Featured</option>
                            <option value="newest" @selected(request('sort') === 'newest')>Newest</option>
                            <option value="price_asc" @selected(request('sort') === 'price_asc')>Price low to high</option>
                            <option value="price_desc" @selected(request('sort') === 'price_desc')>Price high to low</option>
                        </select>
                    </div>

                    <button class="w-full bg-black px-5 py-3 text-sm font-black uppercase text-white">Apply filters</button>
                    <a href="{{ route('products.index') }}" class="block text-center text-sm font-black uppercase underline">Reset</a>
                </form>
            </aside>

            <div>
                <div class="mb-6 flex items-center justify-between">
                    <p class="text-sm font-bold text-gray-500">{{ $products->total() }} products</p>
                </div>

                <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                    @forelse ($products as $product)
                        <x-product-card :product="$product" />
                    @empty
                        <div class="col-span-full bg-brand-light p-10 text-center">
                            <h2 class="text-2xl font-black uppercase text-black">No products found</h2>
                            <a href="{{ route('products.index') }}" class="mt-3 inline-block text-sm font-black uppercase underline">Reset filters</a>
                        </div>
                    @endforelse
                </div>

                <div class="mt-10">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
