<footer class="bg-black text-white">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-14 sm:px-6 md:grid-cols-4 lg:px-8">
        <div>
            <p class="text-2xl font-black uppercase">Athletiq</p>
            <p class="mt-4 max-w-xs text-sm text-white/60">Multi-brand sportswear built around bold gear, clean lines, and fast shopping.</p>
        </div>

        <div>
            <h3 class="text-sm font-bold uppercase text-white/50">Brands</h3>
            <div class="mt-4 grid gap-3 text-sm text-white/80">
                <a href="{{ url('/brands/nike') }}">Nike</a>
                <a href="{{ url('/brands/adidas') }}">Adidas</a>
                <a href="{{ url('/brands/puma') }}">Puma</a>
                <a href="{{ url('/brands/new-balance') }}">New Balance</a>
            </div>
        </div>

        <div>
            <h3 class="text-sm font-bold uppercase text-white/50">Shop</h3>
            <div class="mt-4 grid gap-3 text-sm text-white/80">
                <a href="{{ url('/products') }}">All Products</a>
                <a href="{{ url('/products?category=shoes') }}">Shoes</a>
                <a href="{{ url('/products?category=apparel') }}">Apparel</a>
                <a href="{{ url('/products?category=accessories') }}">Accessories</a>
            </div>
        </div>

        <div>
            <h3 class="text-sm font-bold uppercase text-white/50">Social</h3>
            <div class="mt-4 flex gap-4 text-sm font-bold uppercase text-white/80">
                <a href="#">Instagram</a>
                <a href="#">X</a>
            </div>
        </div>
    </div>

    <div class="border-t border-white/10 px-4 py-6 text-center text-xs uppercase text-white/50">
        &copy; {{ date('Y') }} Athletiq. All rights reserved.
    </div>
</footer>
