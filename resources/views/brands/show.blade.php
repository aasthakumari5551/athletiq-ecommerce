@extends('layouts.app')

@section('content')
    <section class="bg-black px-4 pb-20 pt-36 text-white sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <p class="text-sm font-black uppercase text-white/50">Brand storefront</p>
            <h1 class="mt-4 text-6xl font-black uppercase leading-none sm:text-8xl">{{ $brand->name }}</h1>
            @if ($brand->description)
                <p class="mt-6 max-w-2xl text-lg text-white/70">{{ $brand->description }}</p>
            @endif
        </div>
    </section>

    <section class="bg-white py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
<form method="GET" class="flex flex-wrap items-end gap-3 border-b border-gray-200 pb-8">
    <label class="grid gap-2">
        <span class="text-xs font-black uppercase text-gray-500">Search</span>
        <input name="q" value="{{ request('q') }}" class="w-64 border-gray-300 text-sm focus:border-black focus:ring-black" placeholder="Search {{ $brand->name }}">
    </label>

    <label class="grid gap-2">
        <span class="text-xs font-black uppercase text-gray-500">Category</span>
        <select name="category" class="border-gray-300 text-sm focus:border-black focus:ring-black">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>{{ $category->name }}</option>
            @endforeach
        </select>
    </label>

    <label class="grid gap-2">
        <span class="text-xs font-black uppercase text-gray-500">Gender</span>
        <select name="gender" class="border-gray-300 text-sm focus:border-black focus:ring-black">
            <option value="">All</option>
            <option value="men"    @selected(request('gender') === 'men')>Men</option>
            <option value="women"  @selected(request('gender') === 'women')>Women</option>
            <option value="unisex" @selected(request('gender') === 'unisex')>Unisex</option>
        </select>
    </label>

    <label class="grid gap-2">
        <span class="text-xs font-black uppercase text-gray-500">Sort</span>
        <select name="sort" class="border-gray-300 text-sm focus:border-black focus:ring-black">
            <option value="">Featured</option>
            <option value="newest"     @selected(request('sort') === 'newest')>Newest</option>
            <option value="price_asc"  @selected(request('sort') === 'price_asc')>Price low to high</option>
            <option value="price_desc" @selected(request('sort') === 'price_desc')>Price high to low</option>
        </select>
    </label>

    <button class="bg-black px-6 py-3 text-sm font-black uppercase text-white">Apply</button>
    <a href="{{ route('brands.show', $brand->slug) }}" class="px-4 py-3 text-sm font-black uppercase underline">Reset</a>
</form>

            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @forelse ($products as $product)
                    <x-product-card :product="$product" />
                @empty
                    <div class="col-span-full bg-brand-light p-10 text-center">
                        <h2 class="text-2xl font-black uppercase text-black">No products found</h2>
                        <a href="{{ route('brands.show', $brand->slug) }}" class="mt-3 inline-block text-sm font-black uppercase underline">Reset search</a>
                    </div>
                @endforelse
            </div>

            <div class="mt-10">
                {{ $products->links() }}
            </div>
        </div>
    </section>
@endsection
