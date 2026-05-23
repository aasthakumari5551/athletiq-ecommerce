@extends('layouts.app')
@use('Illuminate\Support\Facades\Storage')

@section('content')
    <section class="relative flex min-h-screen items-end overflow-hidden bg-black px-4 pb-20 pt-32 text-white sm:px-6 lg:px-8">
<div class="absolute right-0 top-20 hidden h-[72vh] w-1/2 grid-cols-2 gap-4 pr-8 opacity-80 lg:grid">
    <div class="mt-24 overflow-hidden">
        <img src="{{ asset('storage/hero/hero1.jpg') }}" class="h-full w-full object-cover" alt="Sport">
    </div>
    <div class="mb-24 overflow-hidden">
        <img src="{{ asset('storage/hero/hero2.jpg') }}" class="h-full w-full object-cover" alt="Sport">
    </div>
    <div class="overflow-hidden">
        <img src="{{ asset('storage/hero/hero3.jpg') }}" class="h-full w-full object-cover" alt="Sport">
    </div>
    <div class="mb-10 overflow-hidden">
        <img src="{{ asset('storage/hero/hero4.jpg') }}" class="h-full w-full object-cover" alt="Sport">
    </div>
</div>
        <div class="relative mx-auto w-full max-w-7xl">
            <div class="max-w-5xl">
                <p class="text-sm font-black uppercase text-white/60">Multi-brand sportswear store</p>
                <h1 class="mt-4 text-5xl font-black uppercase leading-none sm:text-7xl lg:text-hero">Built for every move.</h1>
                <p class="mt-6 max-w-xl text-lg text-white/70">Shop Nike-style performance gear across top brands, clean categories, and bold essentials.</p>
                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="{{ route('products.index') }}" class="rounded-full bg-white px-7 py-3 text-sm font-black uppercase text-black transition hover:bg-brand-accent">Shop Products</a>
                    <a href="{{ route('brands.index') }}" class="rounded-full border border-white/40 px-7 py-3 text-sm font-black uppercase text-white transition hover:bg-white hover:text-black">Explore Brands</a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between gap-6">
                <div>
                    <p class="text-xs font-black uppercase text-gray-400">Featured Brands</p>
                    <h2 class="mt-2 text-3xl font-black uppercase text-black">Brand by brand</h2>
                </div>
                <a href="{{ route('brands.index') }}" class="text-sm font-black uppercase text-black underline">View all</a>
            </div>

            <div class="mt-8 flex gap-4 overflow-x-auto pb-2">
                @forelse ($featuredBrands as $brand)
                    <a href="{{ route('brands.show', $brand->slug) }}" class="min-w-48 border border-gray-200 bg-white p-6 transition hover:border-black">
                        <div class="grid aspect-square place-items-center bg-brand-light">
    @if($brand->logo)
        <img src="{{ Storage::url($brand->logo) }}" alt="{{ $brand->name }}" class="h-16 w-auto object-contain">
    @else
        <span class="text-2xl font-black uppercase text-black">{{ $brand->name }}</span>
    @endif
</div>
                        <p class="mt-4 text-sm font-black uppercase">Shop {{ $brand->name }}</p>
                    </a>
                @empty
                    <p class="text-gray-500">Featured brands will appear here after products are added.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="bg-brand-light py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between gap-6">
                <div>
                    <p class="text-xs font-black uppercase text-gray-400">New Arrivals</p>
                    <h2 class="mt-2 text-3xl font-black uppercase text-black">Fresh drops</h2>
                </div>
                <a href="{{ route('products.index') }}" class="text-sm font-black uppercase text-black underline">Shop all</a>
            </div>

            <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @forelse ($newArrivals as $product)
                    <x-product-card :product="$product" />
                @empty
                    <p class="text-gray-500">Products will appear here after Phase 5 seed data or admin entries.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="bg-black px-4 py-12 text-white sm:px-6 lg:px-8">
        <div class="mx-auto flex max-w-7xl flex-col justify-between gap-6 md:flex-row md:items-center">
            <div>
                <p class="text-sm font-black uppercase text-red-400">Sale Zone</p>
                <h2 class="mt-2 text-4xl font-black uppercase">Black, red, ready.</h2>
            </div>
            <a href="{{ route('products.index', ['sort' => 'newest']) }}" class="w-fit rounded-full bg-white px-7 py-3 text-sm font-black uppercase text-black">Browse latest</a>
        </div>
    </section>

    <section class="bg-white py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-black uppercase text-black">Shop by category</h2>
            <div class="mt-8 grid gap-6 md:grid-cols-3">
                @forelse ($categories as $category)
    @php
        $categoryImages = [
            'shoes'       => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&h=600&fit=crop',
            'apparel'     => 'http://127.0.0.1:8000/storage/hero/apparel.jpg',
            'accessories' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=800&h=600&fit=crop',
        ];
        $img = $categoryImages[$category->slug] ?? null;
    @endphp
    <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="group relative block overflow-hidden">
        @if($img)
            <img src="{{ $img }}" alt="{{ $category->name }}" class="aspect-[4/3] w-full object-cover transition duration-500 group-hover:scale-105">
        @else
            <div class="aspect-[4/3] bg-brand-light"></div>
        @endif
        <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
            <span class="text-4xl font-black uppercase text-white">{{ $category->name }}</span>
        </div>
    </a>
@empty
    @foreach (['shoes' => 'Shoes', 'apparel' => 'Apparel', 'accessories' => 'Accessories'] as $slug => $name)
        @php
            $categoryImages = [
                'shoes'       => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&h=600&fit=crop',
                'apparel'     => 'http://127.0.0.1:8000/storage/hero/apparel.jpg',
                'accessories' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=800&h=600&fit=crop',
            ];
        @endphp
        <a href="{{ route('products.index', ['category' => $slug]) }}" class="group relative block overflow-hidden">
            <img src="{{ $categoryImages[$slug] }}" alt="{{ $name }}" class="aspect-[4/3] w-full object-cover transition duration-500 group-hover:scale-105">
            <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                <span class="text-4xl font-black uppercase text-white">{{ $name }}</span>
            </div>
        </a>
    @endforeach
@endforelse
            </div>
        </div>
    </section>
@endsection
