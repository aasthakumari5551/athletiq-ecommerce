@extends('layouts.app')

@section('content')
    <section class="grid min-h-screen place-items-center bg-black px-4 py-32 text-center text-white">
        <div>
            <p class="text-sm font-black uppercase text-white/50">Order confirmed</p>
            <h1 class="mt-4 text-5xl font-black uppercase leading-none sm:text-7xl">You are set.</h1>
            <p class="mt-6 text-lg text-white/70">Order #{{ $order->id }} has been placed successfully.</p>
            <div class="mt-10 flex flex-wrap justify-center gap-4">
                <a href="{{ route('orders.show', $order) }}" class="rounded-full bg-white px-7 py-3 text-sm font-black uppercase text-black">View order</a>
                <a href="{{ route('products.index') }}" class="rounded-full border border-white/40 px-7 py-3 text-sm font-black uppercase text-white">Continue shopping</a>
            </div>
        </div>
    </section>
@endsection
