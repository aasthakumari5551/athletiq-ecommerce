@extends('layouts.app')

@section('content')
    <section class="bg-black px-4 pb-16 pt-36 text-white sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <p class="text-sm font-black uppercase text-white/50">Cart</p>
            <h1 class="mt-4 text-5xl font-black uppercase leading-none sm:text-7xl">Your bag.</h1>
        </div>
    </section>

    <section class="bg-white py-12">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-[1fr_360px] lg:px-8">
            <div class="space-y-4">
                @forelse ($items as $key => $item)
                    <div class="grid gap-5 border border-gray-200 p-4 sm:grid-cols-[120px_1fr_auto]">
                        <div class="aspect-square bg-brand-light">
                            @if ($item['image'])
                                <img src="{{ asset('storage/'.$item['image']) }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover">
                            @else
                                <div class="grid h-full place-items-center text-xs font-black uppercase text-gray-400">{{ $item['brand'] }}</div>
                            @endif
                        </div>

                        <div>
                            <p class="text-xs font-black uppercase text-gray-500">{{ $item['brand'] }}</p>
                            <h2 class="mt-1 text-xl font-black uppercase text-black">{{ $item['name'] }}</h2>
                            @if ($item['variant_size'])
                                <p class="mt-2 text-sm text-gray-500">Size: {{ $item['variant_size'] }}</p>
                            @endif
                            <p class="mt-2 text-sm font-bold">Rs. {{ number_format($item['price'], 2) }}</p>
                        </div>

                        <div class="flex flex-col items-start gap-3 sm:items-end">
                            <form method="POST" action="{{ route('cart.update') }}" class="flex items-center border border-gray-300" x-data="{ qty: {{ $item['qty'] }} }">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="item_key" value="{{ $key }}">
                                <button type="button" x-on:click="qty = Math.max(0, qty - 1)" class="h-10 w-10 text-lg font-bold">-</button>
                                <input name="qty" x-model="qty" class="h-10 w-12 border-0 p-0 text-center text-sm font-bold focus:ring-0">
                                <button type="button" x-on:click="qty = Math.min(10, qty + 1)" class="h-10 w-10 text-lg font-bold">+</button>
                                <button class="h-10 bg-black px-3 text-xs font-black uppercase text-white">Update</button>
                            </form>

                            <form method="POST" action="{{ route('cart.remove', $key) }}">
                                @csrf
                                @method('DELETE')
                                <button class="text-xs font-black uppercase text-gray-500 underline">Remove</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="bg-brand-light p-10 text-center">
                        <h2 class="text-2xl font-black uppercase text-black">Your cart is empty</h2>
                        <a href="{{ route('products.index') }}" class="mt-4 inline-block rounded-full bg-black px-6 py-3 text-sm font-black uppercase text-white">Shop products</a>
                    </div>
                @endforelse
            </div>

            <aside class="h-fit border border-gray-200 p-6">
                <h2 class="text-xl font-black uppercase text-black">Summary</h2>

                {{-- Coupon Section --}}
                @if(count($items))
                <div class="mt-6">
                    @if(session('coupon'))
                        <div class="flex items-center justify-between bg-green-50 border border-green-200 px-4 py-3 rounded-lg">
                            <div>
                                <p class="text-sm font-black uppercase text-green-700">{{ session('coupon.code') }} applied!</p>
                                <p class="text-xs text-green-600">
                                    @if(session('coupon.type') === 'percent')
                                        {{ session('coupon.value') }}% off
                                    @else
                                        Rs. {{ number_format(session('coupon.value'), 2) }} off
                                    @endif
                                </p>
                            </div>
                            <form method="POST" action="{{ route('coupon.remove') }}">
                                @csrf
                                @method('DELETE')
                                <button class="text-xs font-black uppercase text-red-500 underline">Remove</button>
                            </form>
                        </div>
                    @else
                        <form method="POST" action="{{ route('coupon.apply') }}" class="flex gap-2">
                            @csrf
                            <input
                                type="text"
                                name="coupon_code"
                                placeholder="Coupon code"
                                class="w-full border-gray-300 text-sm focus:border-black focus:ring-black uppercase"
                            >
                            <button class="bg-black px-4 py-2 text-xs font-black uppercase text-white whitespace-nowrap">Apply</button>
                        </form>
                    @endif
                </div>
                @endif

                <div class="mt-6 space-y-3 border-b border-gray-200 pb-6 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Subtotal</span>
                        <span class="font-bold">Rs. {{ number_format($total, 2) }}</span>
                    </div>
                    @if(session('coupon'))
                        <div class="flex justify-between text-green-600">
                            <span>Discount ({{ session('coupon.code') }})</span>
                            <span class="font-bold">- Rs. {{ number_format(session('coupon.discount'), 2) }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="text-gray-500">Payment</span>
                        <span class="font-bold uppercase">COD</span>
                    </div>
                </div>

                @php
                    $discount = session('coupon.discount', 0);
                    $finalTotal = max(0, $total - $discount);
                @endphp

                <div class="mt-6 flex justify-between text-lg font-black">
                    <span>Total</span>
                    <span>Rs. {{ number_format($finalTotal, 2) }}</span>
                </div>

                <a href="{{ route('checkout') }}" class="mt-6 block rounded-full bg-black px-6 py-4 text-center text-sm font-black uppercase text-white {{ count($items) ? '' : 'pointer-events-none opacity-40' }}">Checkout</a>
            </aside>
        </div>
    </section>
@endsection