@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="grid gap-5 md:grid-cols-4">
        <x-admin.stat-card label="Revenue" value="Rs. {{ number_format((float) $stats['revenue'], 2) }}" />
        <x-admin.stat-card label="Orders" :value="$stats['orders']" />
        <x-admin.stat-card label="Products" :value="$stats['products']" />
        <x-admin.stat-card label="Users" :value="$stats['users']" />
    </div>

    <div class="mt-8 border border-gray-200 bg-white">
        <div class="border-b border-gray-200 p-5">
            <h2 class="text-xl font-black uppercase">Recent orders</h2>
        </div>
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 text-xs font-black uppercase text-gray-500">
                <tr>
                    <th class="px-5 py-3">Order</th>
                    <th class="px-5 py-3">Customer</th>
                    <th class="px-5 py-3">Total</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($recent as $order)
                    <tr>
                        <td class="px-5 py-4 font-black">#{{ $order->id }}</td>
                        <td class="px-5 py-4">{{ $order->user->name }}</td>
                        <td class="px-5 py-4">Rs. {{ number_format((float) $order->total, 2) }}</td>
                        <td class="px-5 py-4 uppercase">{{ $order->status }}</td>
                        <td class="px-5 py-4 text-right"><a class="font-black uppercase underline" href="{{ route('admin.orders.show', $order) }}">View</a></td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-10 text-center text-gray-500">No orders yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
