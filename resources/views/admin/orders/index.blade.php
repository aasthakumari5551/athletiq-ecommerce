@extends('layouts.admin')
@section('title', 'Orders')
@section('content')
    <div class="border border-gray-200 bg-white"><table class="w-full text-left text-sm"><thead class="bg-gray-50 text-xs font-black uppercase text-gray-500"><tr><th class="px-5 py-3">Order</th><th class="px-5 py-3">Customer</th><th class="px-5 py-3">Total</th><th class="px-5 py-3">Status</th><th class="px-5 py-3"></th></tr></thead><tbody class="divide-y divide-gray-200">@foreach ($orders as $order)<tr><td class="px-5 py-4 font-black">#{{ $order->id }}</td><td class="px-5 py-4">{{ $order->user->name }}</td><td class="px-5 py-4">Rs. {{ number_format((float) $order->total, 2) }}</td><td class="px-5 py-4 uppercase">{{ $order->status }}</td><td class="px-5 py-4 text-right"><a class="font-black uppercase underline" href="{{ route('admin.orders.show', $order) }}">View</a></td></tr>@endforeach</tbody></table></div>
    <div class="mt-6">{{ $orders->links() }}</div>
@endsection
