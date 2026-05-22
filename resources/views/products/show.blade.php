@extends('layouts.app')

@section('content')
    <section class="bg-white px-4 pb-16 pt-28 sm:px-6 lg:px-8">
        <div class="mx-auto grid max-w-7xl gap-10 lg:grid-cols-2">
            <div x-data="{ active: '{{ $product->images->first()?->path }}' }">
                <div class="aspect-square bg-brand-light">
                    @if ($product->images->isNotEmpty())
                        <img x-bind:src="'{{ asset('storage') }}/' + active" alt="{{ $product->name }}" class="h-full w-full object-cover">
                    @else
                        <div class="grid h-full place-items-center px-8 text-center">
                            <span class="text-5xl font-black uppercase text-gray-300">{{ $product->brand->name }}</span>
                        </div>
                    @endif
                </div>

                @if ($product->images->count() > 1)
                    <div class="mt-4 grid grid-cols-4 gap-3">
                        @foreach ($product->images as $image)
                            <button type="button" x-on:click="active = '{{ $image->path }}'" class="aspect-square bg-brand-light">
                                <img src="{{ asset('storage/'.$image->path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="lg:pt-10">
                <a href="{{ route('brands.show', $product->brand->slug) }}" class="text-sm font-black uppercase text-gray-500">{{ $product->brand->name }}</a>
                <h1 class="mt-3 text-5xl font-black uppercase leading-none text-black">{{ $product->name }}</h1>
                <div class="mt-5 flex items-center gap-3 text-xl font-black">
                    <span>Rs. {{ $product->display_price }}</span>
                    @if ($product->sale_price)
                        <span class="text-gray-400 line-through">Rs. {{ number_format((float) $product->price, 2) }}</span>
                    @endif
                </div>

                <p class="mt-6 max-w-xl text-gray-600">{{ $product->description }}</p>

                <form method="POST" action="{{ route('cart.add') }}" class="mt-8" x-data="{ variant: '' }">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="variant_id" x-bind:value="variant">

                    <div>
                        <p class="text-xs font-black uppercase text-gray-500">Select size</p>
                        <div class="mt-3 flex flex-wrap gap-3">
                            @forelse ($product->variants as $variant)
                                <button type="button" x-on:click="variant = '{{ $variant->id }}'" x-bind:class="variant === '{{ $variant->id }}' ? 'bg-black text-white' : 'bg-white text-black'" class="min-w-16 border border-black px-4 py-3 text-sm font-black uppercase">
                                    {{ $variant->size }}
                                </button>
                            @empty
                                <span class="text-sm text-gray-500">Sizes will appear after variants are added.</span>
                            @endforelse
                        </div>
                    </div>

                    <button type="submit" class="mt-8 w-full rounded-full bg-black px-8 py-4 text-sm font-black uppercase text-white transition hover:bg-gray-800">
                        Add to cart
                    </button>
                </form>
            </div>
        </div>
    </section>

    @if ($related->isNotEmpty())
        <section class="bg-brand-light py-16">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-black uppercase text-black">More from {{ $product->brand->name }}</h2>
                <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($related as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
