@extends('layouts.app')

@section('content')
    <section class="bg-black px-4 pb-16 pt-36 text-white sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <p class="text-sm font-black uppercase text-white/50">Order #{{ $order->id }}</p>
            <h1 class="mt-4 text-5xl font-black uppercase leading-none sm:text-7xl">{{ $order->status }}</h1>
            <p class="mt-4 text-sm text-white/50">Placed on {{ $order->created_at->format('d M Y') }}</p>
        </div>
    </section>

    {{-- Status Timeline --}}
    <section class="bg-brand-light py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @php
                $statuses = ['pending', 'processing', 'shipped', 'delivered'];
                $currentIndex = array_search($order->status, $statuses);
                if ($currentIndex === false) $currentIndex = -1;

                $estimatedDelivery = match($order->status) {
                    'pending'    => $order->created_at->addDays(7)->format('d M Y'),
                    'processing' => $order->created_at->addDays(5)->format('d M Y'),
                    'shipped'    => $order->created_at->addDays(2)->format('d M Y'),
                    'delivered'  => $order->updated_at->format('d M Y'),
                    default      => $order->created_at->addDays(7)->format('d M Y'),
                };

                $statusLabels = [
                    'pending'    => 'Order Placed',
                    'processing' => 'Processing',
                    'shipped'    => 'Shipped',
                    'delivered'  => 'Delivered',
                ];

                $statusIcons = [
                    'pending'    => '📦',
                    'processing' => '⚙️',
                    'shipped'    => '🚚',
                    'delivered'  => '✅',
                ];
            @endphp

            @if($order->status !== 'cancelled')
            <div class="mb-4 text-center">
                <p class="text-sm font-black uppercase text-gray-500">
                    @if($order->status === 'delivered')
                        Delivered on {{ $estimatedDelivery }}
                    @else
                        Estimated Delivery: <span class="text-black">{{ $estimatedDelivery }}</span>
                    @endif
                </p>
            </div>

            <div class="relative flex items-center justify-between">
                {{-- Progress Line --}}
                <div class="absolute left-0 right-0 top-5 h-1 bg-gray-200 z-0">
                    <div class="h-full bg-black transition-all duration-500"
                         style="width: {{ $currentIndex >= 0 ? ($currentIndex / (count($statuses) - 1)) * 100 : 0 }}%">
                    </div>
                </div>

                @foreach($statuses as $index => $status)
                    @php $done = $index <= $currentIndex; @endphp
                    <div class="relative z-10 flex flex-col items-center gap-2">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full border-2 text-lg
                            {{ $done ? 'bg-black border-black text-white' : 'bg-white border-gray-300 text-gray-400' }}">
                            {{ $statusIcons[$status] }}
                        </div>
                        <p class="text-xs font-black uppercase {{ $done ? 'text-black' : 'text-gray-400' }}">
                            {{ $statusLabels[$status] }}
                        </p>
                    </div>
                @endforeach
            </div>
            @else
                <div class="text-center bg-red-50 border border-red-200 rounded-lg py-4">
                    <p class="text-sm font-black uppercase text-red-600">❌ Order Cancelled</p>
                </div>
            @endif
        </div>
    </section>

    <section class="bg-white py-12">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-[1fr_360px] lg:px-8">
            <div class="space-y-4">
                @foreach ($order->items as $item)
                    <div class="flex gap-5 border border-gray-200 p-5">
                        {{-- Product Image --}}
<div class="h-20 w-20 shrink-0 bg-brand-light overflow-hidden rounded">
    @if($item->product?->primaryImage)
        <img src="{{ asset('storage/'.$item->product->primaryImage->path) }}"
             alt="{{ $item->product_name }}"
             class="h-20 w-20 object-cover">
    @else
        <div class="flex h-full w-full items-center justify-center text-xs font-black uppercase text-gray-400">
            {{ $item->product?->brand?->name ?? 'N/A' }}
        </div>
    @endif
</div>

                        <div class="flex flex-1 justify-between gap-4">
                            <div>
                                <h2 class="text-lg font-black uppercase text-black">{{ $item->product_name }}</h2>
                                <p class="mt-1 text-sm text-gray-500">
                                    Qty {{ $item->qty }}
                                    {{ $item->variant?->size ? '/ Size '.$item->variant->size : '' }}
                                </p>
                                <p class="mt-1 text-sm text-gray-500">Rs. {{ number_format((float) $item->price, 2) }} each</p>
                            </div>
                            <p class="font-black">Rs. {{ number_format((float) $item->price * $item->qty, 2) }}</p>
                        </div>
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
                    <div class="mt-4 space-y-2 text-sm">
                        @if($order->subtotal != $order->total)
                            <div class="flex justify-between">
                                <span class="text-gray-500">Subtotal</span>
                                <span class="font-bold">Rs. {{ number_format((float) $order->subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-green-600">
                                <span>Discount</span>
                                <span class="font-bold">- Rs. {{ number_format((float) ($order->subtotal - $order->total), 2) }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between text-lg font-black border-t border-gray-200 pt-3">
                            <span>Paid by COD</span>
                            <span>Rs. {{ number_format((float) $order->total, 2) }}</span>
                        </div>
                    </div>
                </div>

                <a href="{{ route('products.index') }}" class="block rounded-full bg-black px-6 py-3 text-center text-sm font-black uppercase text-white">
                    Continue Shopping
                </a>
            </aside>
        </div>
    </section>
@endsection