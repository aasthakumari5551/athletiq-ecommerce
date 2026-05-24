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

                {{-- Rating --}}
                @php $avgRating = $product->reviews()->avg('rating'); @endphp
                @if($avgRating)
                    <div class="mt-3 flex items-center gap-2">
                        <div class="flex">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="h-5 w-5 {{ $i <= round($avgRating) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                        <span class="text-sm font-bold text-gray-500">{{ number_format($avgRating, 1) }} / 5 ({{ $product->reviews()->count() }} reviews)</span>
                    </div>
                @endif

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

    {{-- Reviews Section --}}
    <section class="bg-white py-12 border-t border-gray-200">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-black uppercase text-black">Customer Reviews</h2>

            {{-- Reviews List --}}
            @php $reviews = $product->reviews()->with('user')->latest()->get(); @endphp

            @if($reviews->isEmpty())
                <p class="mt-6 text-gray-500">No reviews yet. Be the first to review!</p>
            @else
                <div class="mt-6 space-y-6">
                    @foreach($reviews as $review)
                        <div class="border border-gray-200 p-5">
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="grid h-10 w-10 place-items-center rounded-full bg-black text-sm font-bold text-white uppercase">
                                        {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-black uppercase text-sm">{{ $review->user->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $review->created_at->format('d M Y') }}</p>
                                    </div>
                                </div>
                                <div class="flex">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="h-4 w-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                            @if($review->body)
                                <p class="mt-3 text-gray-600 text-sm">{{ $review->body }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Review Form --}}
            @auth
                @php
                    $hasPurchased = auth()->user()->orders()
                        ->where('status', 'delivered')
                        ->whereHas('items', fn($q) => $q->where('product_id', $product->id))
                        ->exists();

                    $alreadyReviewed = \App\Models\Review::where('user_id', auth()->id())
                        ->where('product_id', $product->id)
                        ->exists();
                @endphp

                @if($hasPurchased && !$alreadyReviewed)
                    <div class="mt-10 border border-gray-200 p-6" id="review-form">
                        <h3 class="text-xl font-black uppercase text-black">Write a Review</h3>
                        <form method="POST" action="{{ route('reviews.store', $product) }}" class="mt-6 space-y-4">
                            @csrf

                            <div x-data="{ rating: 0, hover: 0 }">
                                <p class="text-xs font-black uppercase text-gray-500 mb-2">Rating</p>
                                <div class="flex gap-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <button type="button"
                                            x-on:click="rating = {{ $i }}"
                                            x-on:mouseover="hover = {{ $i }}"
                                            x-on:mouseleave="hover = 0">
                                            <svg class="h-8 w-8"
                                                x-bind:class="(hover || rating) >= {{ $i }} ? 'text-yellow-400' : 'text-gray-300'"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        </button>
                                    @endfor
                                </div>
                                <input type="hidden" name="rating" x-bind:value="rating">
                            </div>

                            <div>
                                <label class="text-xs font-black uppercase text-gray-500">Review (optional)</label>
                                <textarea name="body" rows="4" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black" placeholder="Share your thoughts...">{{ old('body') }}</textarea>
                            </div>

                            <button class="rounded-full bg-black px-6 py-3 text-sm font-black uppercase text-white">
                                Submit Review
                            </button>
                        </form>
                    </div>

                @elseif($alreadyReviewed)
                    <div class="mt-10 bg-brand-light p-6 text-center">
                        <p class="font-black uppercase text-gray-600">You have already reviewed this product ✅</p>
                    </div>

                @else
                    <div class="mt-10 border border-gray-200 p-6 text-center">
                        <p class="font-black uppercase text-gray-600">Purchase & receive this product to write a review 🛍️</p>
                    </div>
                @endif

            @else
                <div class="mt-10 border border-gray-200 p-6 text-center">
                    <p class="font-black uppercase text-gray-600">
                        <a href="{{ route('login') }}" class="underline">Login</a> to write a review
                    </p>
                </div>
            @endauth
        </div>
    </section>

    @if ($related->isNotEmpty())
        <section class="bg-brand-light py-16">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-black uppercase text-black">More from {{ $product->brand->name }}</h2>
                <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($related as $relatedProduct)
                        <x-product-card :product="$relatedProduct" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection