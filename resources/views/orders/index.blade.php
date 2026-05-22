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
            <div class="overflow-hidden border border-gray-200">
                <table class="w-full text-left text-sm">
                    <thead class="bg-brand-light text-xs font-black uppercase text-gray-500">
                        <tr>
                            <th class="px-5 py-4">Order</th>
                            <th class="px-5 py-4">Date</th>
                            <th class="px-5 py-4">Total</th>
                            <th class="px-5 py-4">Status</th>
                            <th class="px-5 py-4"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($orders as $order)
                            <tr>
                                <td class="px-5 py-4 font-black">#{{ $order->id }}</td>
                                <td class="px-5 py-4 text-gray-500">{{ $order->created_at->format('d M Y') }}</td>
                                <td class="px-5 py-4 font-bold">Rs. {{ number_format((float) $order->total, 2) }}</td>
                                <td class="px-5 py-4"><span class="bg-black px-3 py-1 text-xs font-black uppercase text-white">{{ $order->status }}</span></td>
                                <td class="px-5 py-4 text-right"><a href="{{ route('orders.show', $order) }}" class="font-black uppercase underline">View</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-10 text-center">
                                    <h2 class="text-2xl font-black uppercase text-black">No orders yet</h2>
                                    <a href="{{ route('products.index') }}" class="mt-3 inline-block text-sm font-black uppercase underline">Start shopping</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        </div>
    </section>
@endsection
