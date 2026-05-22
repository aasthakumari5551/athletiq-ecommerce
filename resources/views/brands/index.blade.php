@extends('layouts.app')

@section('content')
    <section class="bg-black px-4 pb-20 pt-36 text-white sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <p class="text-sm font-black uppercase text-white/50">All brands</p>
            <h1 class="mt-4 text-5xl font-black uppercase leading-none sm:text-7xl">Shop your lane.</h1>
        </div>
    </section>

    <section class="bg-white py-16">
        <div class="mx-auto grid max-w-7xl gap-6 px-4 sm:grid-cols-2 sm:px-6 lg:grid-cols-4 lg:px-8">
            @forelse ($brands as $brand)
                <a href="{{ route('brands.show', $brand->slug) }}" class="group border border-gray-200 bg-white p-5 transition hover:border-black">
                    <div class="grid aspect-square place-items-center bg-brand-light">
                        <span class="px-4 text-center text-3xl font-black uppercase text-black">{{ $brand->name }}</span>
                    </div>
                    <div class="mt-5 flex items-center justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-black uppercase text-black">{{ $brand->name }}</h2>
                            <p class="mt-1 text-sm text-gray-500">{{ $brand->products_count }} products</p>
                        </div>
                        <span class="text-sm font-black uppercase underline">Shop</span>
                    </div>
                </a>
            @empty
                <div class="col-span-full bg-brand-light p-10 text-center">
                    <h2 class="text-2xl font-black uppercase text-black">No brands yet</h2>
                    <p class="mt-2 text-gray-600">Brands will appear after seed data or admin entries are added.</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection
