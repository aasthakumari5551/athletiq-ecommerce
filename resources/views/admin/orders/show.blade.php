@extends('layouts.admin')
@section('title', 'Order #'.$order->id)
@section('content')
    <div class="grid gap-8 lg:grid-cols-[1fr_360px]">
        <div class="space-y-4">@foreach ($order->items as $item)<div class="flex justify-between border border-gray-200 bg-white p-5"><div><h2 class="font-black uppercase">{{ $item->product_name }}</h2><p class="text-sm text-gray-500">Qty {{ $item->qty }} {{ $item->variant?->size ? '/ Size '.$item->variant->size : '' }}</p></div><p class="font-black">Rs. {{ number_format((float) $item->price * $item->qty, 2) }}</p></div>@endforeach</div>
        <aside class="space-y-5">
            <form method="POST" action="{{ route('admin.orders.update', $order) }}" class="border border-gray-200 bg-white p-5">
                @csrf @method('PUT')
                <label class="text-xs font-black uppercase text-gray-500">Status</label>
                <select name="status" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black">@foreach (['pending','processing','shipped','delivered','cancelled'] as $status)<option value="{{ $status }}" @selected($order->status === $status)>{{ ucfirst($status) }}</option>@endforeach</select>
                <button class="mt-4 bg-black px-5 py-3 text-sm font-black uppercase text-white">Update</button>
            </form>
            <div class="border border-gray-200 bg-white p-5"><h2 class="font-black uppercase">Shipping</h2><p class="mt-3 text-sm text-gray-600">{{ $order->address->name }}<br>{{ $order->address->phone }}<br>{{ $order->address->address }}<br>{{ $order->address->city }}, {{ $order->address->state }} {{ $order->address->pincode }}</p></div>
            <div class="border border-gray-200 bg-white p-5"><h2 class="font-black uppercase">Total</h2><p class="mt-3 text-2xl font-black">Rs. {{ number_format((float) $order->total, 2) }}</p></div>
        </aside>
    </div>
@endsection
