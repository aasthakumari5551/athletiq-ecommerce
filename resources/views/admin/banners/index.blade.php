@extends('layouts.admin')
@section('title', 'Banners')
@section('content')
    <div class="mb-5 flex justify-end"><a href="{{ route('admin.banners.create') }}" class="bg-black px-5 py-3 text-sm font-black uppercase text-white">New banner</a></div>
    <div class="border border-gray-200 bg-white"><table class="w-full text-left text-sm"><thead class="bg-gray-50 text-xs font-black uppercase text-gray-500"><tr><th class="px-5 py-3">Title</th><th class="px-5 py-3">Order</th><th class="px-5 py-3">Active</th><th class="px-5 py-3"></th></tr></thead><tbody class="divide-y divide-gray-200">@foreach ($banners as $banner)<tr><td class="px-5 py-4 font-bold">{{ $banner->title }}</td><td class="px-5 py-4">{{ $banner->sort_order }}</td><td class="px-5 py-4">{{ $banner->is_active ? 'Yes' : 'No' }}</td><td class="px-5 py-4 text-right"><a class="font-black uppercase underline" href="{{ route('admin.banners.edit', $banner) }}">Edit</a></td></tr>@endforeach</tbody></table></div>
    <div class="mt-6">{{ $banners->links() }}</div>
@endsection
