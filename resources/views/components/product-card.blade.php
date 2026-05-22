@props(['product'])

@php
    $image = $product->primaryImage?->path;
@endphp

<article class="group">
    <a href="{{ route('products.show', $product->slug) }}" class="block">
        <div class="relative aspect-[4/5] overflow-hidden bg-brand-light">
            @if ($image)
                <img src="{{ asset('storage/'.$image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
            @else
                <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-gray-100 to-gray-300 px-8 text-center">
                    <span class="text-3xl font-black uppercase text-gray-400">{{ $product->brand->name ?? 'Athletiq' }}</span>
                </div>
            @endif

            <div class="absolute inset-x-4 bottom-4 translate-y-3 bg-black px-4 py-3 text-center text-xs font-bold uppercase text-white opacity-0 transition duration-300 group-hover:translate-y-0 group-hover:opacity-100">
                Quick View
            </div>
        </div>

        <div class="mt-4">
            <p class="text-xs font-black uppercase text-gray-500">{{ $product->brand->name }}</p>
            <h3 class="mt-1 text-base font-bold text-black">{{ $product->name }}</h3>
            <div class="mt-2 flex items-center gap-2 text-sm font-bold">
                <span>Rs. {{ $product->display_price }}</span>
                @if ($product->sale_price)
                    <span class="text-gray-400 line-through">Rs. {{ number_format((float) $product->price, 2) }}</span>
                @endif
            </div>
        </div>
    </a>
</article>
