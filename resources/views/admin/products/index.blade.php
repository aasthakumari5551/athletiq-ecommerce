@extends('layouts.admin')
@section('title', 'Products')
@section('content')
    <div class="mb-5 flex justify-end"><a href="{{ route('admin.products.create') }}" class="bg-black px-5 py-3 text-sm font-black uppercase text-white">New product</a></div>
    <div class="border border-gray-200 bg-white"><table class="w-full text-left text-sm"><thead class="bg-gray-50 text-xs font-black uppercase text-gray-500"><tr><th class="px-5 py-3">Product</th><th class="px-5 py-3">Brand</th><th class="px-5 py-3">Category</th><th class="px-5 py-3">Price</th><th class="px-5 py-3"></th></tr></thead><tbody class="divide-y divide-gray-200">@foreach ($products as $product)<tr><td class="px-5 py-4 font-bold">{{ $product->name }}</td><td class="px-5 py-4">{{ $product->brand->name }}</td><td class="px-5 py-4">{{ $product->category->name }}</td><td class="px-5 py-4">Rs. {{ number_format((float) $product->price, 2) }}</td><td class="px-5 py-4 text-right"><a class="font-black uppercase underline" href="{{ route('admin.products.edit', $product) }}">Edit</a></td></tr>@endforeach</tbody></table></div>
    <div class="mt-6">{{ $products->links() }}</div>
@endsection
