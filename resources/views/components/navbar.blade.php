<nav
    x-data="{ scrolled: false, open: false }"
    x-init="scrolled = window.scrollY > 80"
    x-on:scroll.window="scrolled = window.scrollY > 80"
    x-bind:class="scrolled ? 'bg-black shadow-lg' : 'bg-transparent'"
    class="fixed inset-x-0 top-0 z-50 border-b border-white/10 transition-colors duration-300"
>
    <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
        <a href="{{ url('/') }}" class="text-2xl font-black uppercase text-white">Athletiq</a>

        <div class="hidden items-center gap-10 text-sm font-bold uppercase text-white/80 md:flex">
            <a href="{{ url('/products') }}" class="transition hover:text-white {{ request()->is('products*') ? 'text-white' : '' }}">Products</a>
            <a href="{{ url('/brands') }}" class="transition hover:text-white {{ request()->is('brands*') ? 'text-white' : '' }}">Brands</a>
            <a href="{{ url('/products?category=shoes') }}" class="transition hover:text-white">Shoes</a>
            <a href="{{ url('/products?category=apparel') }}" class="transition hover:text-white">Apparel</a>
        </div>

        <div class="hidden items-center gap-4 text-sm font-bold uppercase text-white md:flex">
            <a href="{{ route('cart.index') }}" class="rounded-full border border-white/30 px-4 py-2 transition hover:bg-white hover:text-black">Cart {{ $cartCount ? '(' . $cartCount . ')' : '' }}</a>
            @auth
                <a href="{{ route('profile.edit') }}" class="text-white/80 transition hover:text-white">Account</a>
            @else
                <a href="{{ route('login') }}" class="text-white/80 transition hover:text-white">Login</a>
                <a href="{{ route('register') }}" class="rounded-full bg-white px-4 py-2 text-black transition hover:bg-brand-accent">Join</a>
            @endauth
        </div>

        <button type="button" x-on:click="open = ! open" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/30 text-white md:hidden">
            <span class="sr-only">Open menu</span>
            <span class="text-xl leading-none">=</span>
        </button>
    </div>

    <div x-show="open" x-transition class="border-t border-white/10 bg-black px-4 py-5 md:hidden">
        <div class="flex flex-col gap-4 text-sm font-bold uppercase text-white">
            <a href="{{ url('/products') }}">Products</a>
            <a href="{{ url('/brands') }}">Brands</a>
            <a href="{{ route('cart.index') }}">Cart {{ $cartCount ? '(' . $cartCount . ')' : '' }}</a>
            @auth
                <a href="{{ route('profile.edit') }}">Account</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Join</a>
            @endauth
        </div>
    </div>
</nav>
