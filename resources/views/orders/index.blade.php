@extends('layouts.app')

@section('content')
    <section class="bg-black px-4 pb-16 pt-36 text-white sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <p class="text-sm font-black uppercase text-white/50">Account</p>
            <h1 class="mt-4 text-5xl font-black uppercase leading-none sm:text-7xl">Your orders.</h1>
        </div>
    </section>

    <section class="bg-white py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @forelse ($orders as $order)
                <div class="mb-6 border border-gray-200">
                    {{-- Order Header --}}
                    <div class="flex items-center justify-between gap-4 border-b border-gray-200 bg-brand-light px-5 py-4">
                        <div class="flex items-center gap-6">
                            <div>
                                <p class="text-xs font-black uppercase text-gray-500">Order</p>
                                <p class="font-black">#{{ $order->id }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-black uppercase text-gray-500">Date</p>
                                <p class="font-bold text-gray-700">{{ $order->created_at->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-black uppercase text-gray-500">Total</p>
                                <p class="font-black">Rs. {{ number_format((float) $order->total, 2) }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="bg-black px-3 py-1 text-xs font-black uppercase text-white">{{ $order->status }}</span>
                            <a href="{{ route('orders.show', $order) }}" class="text-sm font-black uppercase underline">View</a>
                        </div>
                    </div>

                    {{-- Order Items --}}
                    @foreach($order->items as $item)
                        <div class="flex items-center justify-between gap-4 px-5 py-4 border-b border-gray-100 last:border-0">
                            <div class="flex items-center gap-4">
                                {{-- Product Image --}}
                                <div class="h-16 w-16 shrink-0 overflow-hidden bg-brand-light">
                                    @if($item->product?->primaryImage)
                                        <img src="{{ asset('storage/'.$item->product->primaryImage->path) }}"
                                             alt="{{ $item->product_name }}"
                                             class="h-full w-full object-cover">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center text-xs font-black uppercase text-gray-400">
                                            IMG
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-black uppercase text-sm">{{ $item->product_name }}</p>
                                    <p class="text-xs text-gray-500">
                                        Qty {{ $item->qty }}
                                        {{ $item->variant?->size ? '/ Size '.$item->variant->size : '' }}
                                    </p>
                                </div>
                            </div>

                            {{-- Rate & Review Button --}}
                            @if($order->status === 'delivered')
                                @php
                                    $alreadyReviewed = \App\Models\Review::where('user_id', auth()->id())
                                        ->where('product_id', $item->product_id)
                                        ->exists();
                                @endphp
                                @if(!$alreadyReviewed && $item->product)
                                    <a href="{{ route('products.show', $item->product->slug) }}#review-form"
                                       class="rounded-full border border-black px-4 py-2 text-xs font-black uppercase transition hover:bg-black hover:text-white">
                                        ⭐ Rate & Review
                                    </a>
                                @elseif($alreadyReviewed)
                                    <span class="text-xs font-black uppercase text-green-600">✅ Reviewed</span>
                                @endif
                            @endif
                        </div>
                    @endforeach
                </div>
            @empty
                <div class="border border-gray-200 p-10 text-center">
                    <h2 class="text-2xl font-black uppercase text-black">No orders yet</h2>
                    <a href="{{ route('products.index') }}" class="mt-3 inline-block text-sm font-black uppercase underline">Start shopping</a>
                </div>
            @endforelse

            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        </div>
    </section>
@endsection