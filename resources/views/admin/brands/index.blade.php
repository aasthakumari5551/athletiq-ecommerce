@extends('layouts.admin')
@section('title', 'Brands')
@section('content')
    <div class="mb-5 flex justify-end"><a href="{{ route('admin.brands.create') }}" class="bg-black px-5 py-3 text-sm font-black uppercase text-white">New brand</a></div>
    <div class="border border-gray-200 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 text-xs font-black uppercase text-gray-500"><tr><th class="px-5 py-3">Name</th><th class="px-5 py-3">Featured</th><th class="px-5 py-3">Active</th><th class="px-5 py-3"></th></tr></thead>
            <tbody class="divide-y divide-gray-200">@foreach ($brands as $brand)<tr><td class="px-5 py-4 font-bold">{{ $brand->name }}</td><td class="px-5 py-4">{{ $brand->is_featured ? 'Yes' : 'No' }}</td><td class="px-5 py-4">{{ $brand->is_active ? 'Yes' : 'No' }}</td><td class="px-5 py-4 text-right"><a class="font-black uppercase underline" href="{{ route('admin.brands.edit', $brand) }}">Edit</a></td></tr>@endforeach</tbody>
        </table>
    </div>
    <div class="mt-6">{{ $brands->links() }}</div>
@endsection
