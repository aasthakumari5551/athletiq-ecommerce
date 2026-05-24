@extends('layouts.admin')
@section('title', 'Coupons')
@section('content')
<div class="mb-6 flex items-center justify-between">
    <h1 class="text-2xl font-black uppercase">Coupons</h1>
    <a href="{{ route('admin.coupons.create') }}" class="bg-black px-4 py-2 text-sm font-black uppercase text-white">+ New Coupon</a>
</div>

<div class="overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="border-b border-gray-200 text-xs font-black uppercase text-gray-500">
            <tr>
                <th class="pb-3 text-left">Code</th>
                <th class="pb-3 text-left">Type</th>
                <th class="pb-3 text-left">Value</th>
                <th class="pb-3 text-left">Min Order</th>
                <th class="pb-3 text-left">Uses</th>
                <th class="pb-3 text-left">Status</th>
                <th class="pb-3 text-left">Expires</th>
                <th class="pb-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($coupons as $coupon)
            <tr>
                <td class="py-3 font-black">{{ $coupon->code }}</td>
                <td class="py-3 uppercase">{{ $coupon->type }}</td>
                <td class="py-3">
                    @if($coupon->type === 'percent')
                        {{ $coupon->value }}%
                    @else
                        Rs. {{ number_format($coupon->value, 2) }}
                    @endif
                </td>
                <td class="py-3">Rs. {{ number_format($coupon->min_order, 2) }}</td>
                <td class="py-3">{{ $coupon->used_count }} / {{ $coupon->max_uses ?? '∞' }}</td>
                <td class="py-3">
                    <span class="rounded-full px-2 py-1 text-xs font-bold {{ $coupon->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $coupon->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td class="py-3">{{ $coupon->expires_at ? $coupon->expires_at->format('d M Y') : '—' }}</td>
                <td class="py-3 flex gap-2">
                    <a href="{{ route('admin.coupons.edit', $coupon) }}" class="text-xs font-black uppercase underline">Edit</a>
                    <form method="POST" action="{{ route('admin.coupons.destroy', $coupon) }}">
                        @csrf @method('DELETE')
                        <button class="text-xs font-black uppercase text-red-500 underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" class="py-6 text-center text-gray-500">No coupons yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $coupons->links() }}</div>
@endsection