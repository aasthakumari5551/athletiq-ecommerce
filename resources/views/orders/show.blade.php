@extends('layouts.app')

@section('content')
    <section class="bg-black px-4 pb-16 pt-36 text-white sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <p class="text-sm font-black uppercase text-white/50">Order #{{ $order->id }}</p>
            <h1 class="mt-4 text-5xl font-black uppercase leading-none sm:text-7xl">{{ $order->status }}</h1>
        </div>
    </section>

    <section class="bg-white py-12">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-[1fr_360px] lg:px-8">
            <div class="space-y-4">
                @foreach ($order->items as $item)
                    <div class="flex justify-between gap-6 border border-gray-200 p-5">
                        <div>
                            <h2 class="text-lg font-black uppercase text-black">{{ $item->product_name }}</h2>
                            <p class="mt-1 text-sm text-gray-500">Qty {{ $item->qty }} {{ $item->variant?->size ? '/ Size '.$item->variant->size : '' }}</p>
                        </div>
                        <p class="font-black">Rs. {{ number_format((float) $item->price * $item->qty, 2) }}</p>
                    </div>
                @endforeach
            </div>

            <aside class="space-y-6">
                <div class="border border-gray-200 p-6">
                    <h2 class="text-xl font-black uppercase text-black">Shipping</h2>
                    <div class="mt-4 text-sm text-gray-600">
                        <p class="font-bold text-black">{{ $order->address->name }}</p>
                        <p>{{ $order->address->phone }}</p>
                        <p class="mt-3">{{ $order->address->address }}</p>
                        <p>{{ $order->address->city }}, {{ $order->address->state }} {{ $order->address->pincode }}</p>
                    </div>
                </div>

                <div class="border border-gray-200 p-6">
                    <h2 class="text-xl font-black uppercase text-black">Total</h2>
                    <div class="mt-4 flex justify-between text-lg font-black">
                        <span>Paid by COD</span>
                        <span>Rs. {{ number_format((float) $order->total, 2) }}</span>
                    </div>
                </div>
            </aside>
        </div>
    </section>
@endsection
