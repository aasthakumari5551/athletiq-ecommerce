@extends('layouts.admin')
@section('title', 'Reviews')
@section('content')
<h1 class="text-2xl font-black uppercase mb-6">Reviews</h1>

<div class="overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="border-b border-gray-200 text-xs font-black uppercase text-gray-500">
            <tr>
                <th class="pb-3 text-left">User</th>
                <th class="pb-3 text-left">Product</th>
                <th class="pb-3 text-left">Rating</th>
                <th class="pb-3 text-left">Review</th>
                <th class="pb-3 text-left">Status</th>
                <th class="pb-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($reviews as $review)
            <tr>
                <td class="py-3 font-bold">{{ $review->user->name }}</td>
                <td class="py-3">{{ $review->product->name }}</td>
                <td class="py-3">
                    <div class="flex">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="h-4 w-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                </td>
                <td class="py-3 max-w-xs truncate">{{ $review->body ?? '—' }}</td>
                <td class="py-3">
                    <span class="rounded-full px-2 py-1 text-xs font-bold {{ $review->is_approved ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ $review->is_approved ? 'Approved' : 'Pending' }}
                    </span>
                </td>
                <td class="py-3 flex gap-2">
                    <form method="POST" action="{{ route('admin.reviews.update', $review) }}">
                        @csrf @method('PUT')
                        <button class="text-xs font-black uppercase underline">
                            {{ $review->is_approved ? 'Unapprove' : 'Approve' }}
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}">
                        @csrf @method('DELETE')
                        <button class="text-xs font-black uppercase text-red-500 underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="py-6 text-center text-gray-500">No reviews yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $reviews->links() }}</div>
@endsection