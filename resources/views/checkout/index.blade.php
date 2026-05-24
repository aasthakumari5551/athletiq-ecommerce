@extends('layouts.app')

@section('content')
    <section class="bg-black px-4 pb-16 pt-36 text-white sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <p class="text-sm font-black uppercase text-white/50">Checkout</p>
            <h1 class="mt-4 text-5xl font-black uppercase leading-none sm:text-7xl">Ship it.</h1>
        </div>
    </section>

    <section class="bg-white py-12">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-[1fr_380px] lg:px-8">
            <form method="POST" action="{{ route('checkout.store') }}" class="space-y-6" x-data="{ submitting: false }" x-on:submit="submitting = true">
                @csrf

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="text-xs font-black uppercase text-gray-500">Name</label>
                        <input name="name" value="{{ old('name', auth()->user()->name) }}" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black">
                        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="text-xs font-black uppercase text-gray-500">Phone</label>
                        <input name="phone" value="{{ old('phone') }}" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black">
                        @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="text-xs font-black uppercase text-gray-500">Address</label>
                    <textarea name="address" rows="4" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black">{{ old('address') }}</textarea>
                    @error('address') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="grid gap-6 md:grid-cols-3">
                    <div>
                        <label class="text-xs font-black uppercase text-gray-500">City</label>
                        <input name="city" value="{{ old('city') }}" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black">
                        @error('city') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="text-xs font-black uppercase text-gray-500">State</label>
                        <input name="state" value="{{ old('state') }}" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black">
                        @error('state') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="text-xs font-black uppercase text-gray-500">Pincode</label>
                        <input name="pincode" value="{{ old('pincode') }}" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black">
                        @error('pincode') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="text-xs font-black uppercase text-gray-500">Notes</label>
                    <textarea name="notes" rows="3" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black">{{ old('notes') }}</textarea>
                </div>

                <button x-bind:disabled="submitting" class="rounded-full bg-black px-8 py-4 text-sm font-black uppercase text-white disabled:opacity-50">
                    <span x-show="! submitting">Place order</span>
                    <span x-show="submitting">Placing order</span>
                </button>
            </form>

            <aside class="h-fit border border-gray-200 p-6">
    <h2 class="text-xl font-black uppercase text-black">Order summary</h2>
    <div class="mt-6 space-y-4">
        @foreach ($items as $item)
            <div class="flex justify-between gap-4 text-sm">
                <div>
                    <p class="font-bold">{{ $item['name'] }}</p>
                    <p class="text-gray-500">Qty {{ $item['qty'] }} {{ $item['variant_size'] ? '/ Size '.$item['variant_size'] : '' }}</p>
                </div>
                <p class="font-bold">Rs. {{ number_format($item['price'] * $item['qty'], 2) }}</p>
            </div>
        @endforeach
    </div>
    <div class="mt-6 border-t border-gray-200 pt-6 space-y-3">
        <div class="flex justify-between text-sm">
            <span class="text-gray-500">Subtotal</span>
            <span class="font-bold">Rs. {{ number_format($total, 2) }}</span>
        </div>

        @if(session('coupon'))
            <div class="flex justify-between text-sm text-green-600">
                <span>Discount ({{ session('coupon.code') }})</span>
                <span class="font-bold">- Rs. {{ number_format(session('coupon.discount'), 2) }}</span>
            </div>
            @php $finalTotal = max(0, $total - session('coupon.discount', 0)); @endphp
        @else
            @php $finalTotal = $total; @endphp
        @endif

        <div class="flex justify-between text-lg font-black border-t border-gray-200 pt-3">
            <span>Total</span>
            <span>Rs. {{ number_format($finalTotal, 2) }}</span>
        </div>
        <p class="text-xs font-bold uppercase text-gray-500">Cash on delivery</p>

        @if(session('coupon'))
            <div class="bg-green-50 border border-green-200 rounded px-3 py-2 text-xs text-green-700 font-bold">
                ✅ Coupon "{{ session('coupon.code') }}" applied!
            </div>
        @endif
    </div>
</aside>
        </div>
    </section>
@endsection
