@extends('layouts.app')

@section('content')
    <section class="bg-black px-4 pb-16 pt-36 text-white sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <p class="text-sm font-black uppercase text-white/50">My Account</p>
            <h1 class="mt-4 text-5xl font-black uppercase leading-none sm:text-7xl">Wishlist.</h1>
        </div>
    </section>

    <section class="bg-white py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if($wishlists->isEmpty())
                <div class="bg-brand-light p-10 text-center">
                    <h2 class="text-2xl font-black uppercase text-black">Your wishlist is empty</h2>
                    <a href="{{ route('products.index') }}" class="mt-3 inline-block text-sm font-black uppercase underline">Browse Products</a>
                </div>
            @else
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach($wishlists as $wishlist)
                        <div class="group relative">
                            <x-product-card :product="$wishlist->product" />
                            <form method="POST" action="{{ route('wishlist.remove', $wishlist) }}" class="absolute right-2 top-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-full bg-white p-2 shadow hover:bg-red-50">
                                    <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection