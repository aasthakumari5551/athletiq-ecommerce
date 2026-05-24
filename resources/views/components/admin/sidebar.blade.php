<aside class="fixed inset-y-0 left-0 z-40 w-60 border-r border-gray-200 bg-black text-white">
    <div class="flex h-20 items-center px-6">
        <a href="{{ route('admin.dashboard') }}" class="text-2xl font-black uppercase">Athletiq</a>
    </div>

    <nav class="space-y-1 px-4 text-sm font-bold uppercase">
        <a href="{{ route('admin.dashboard') }}" class="block rounded-md px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-white text-black' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">Dashboard</a>
        <a href="{{ url('/admin/products') }}" class="block rounded-md px-4 py-3 {{ request()->is('admin/products*') ? 'bg-white text-black' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">Products</a>
        <a href="{{ url('/admin/categories') }}" class="block rounded-md px-4 py-3 {{ request()->is('admin/categories*') ? 'bg-white text-black' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">Categories</a>
        <a href="{{ url('/admin/brands') }}" class="block rounded-md px-4 py-3 {{ request()->is('admin/brands*') ? 'bg-white text-black' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">Brands</a>
        <a href="{{ url('/admin/orders') }}" class="block rounded-md px-4 py-3 {{ request()->is('admin/orders*') ? 'bg-white text-black' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">Orders</a>
        <a href="{{ url('/admin/banners') }}" class="block rounded-md px-4 py-3 {{ request()->is('admin/banners*') ? 'bg-white text-black' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">Banners</a>

        <aside class="fixed inset-y-0 left-0 z-40 w-60 border-r border-gray-200 bg-black text-white">
    <div class="flex h-20 items-center px-6">
        <a href="{{ route('admin.dashboard') }}" class="text-2xl font-black uppercase">Athletiq</a>
    </div>

    <nav class="space-y-1 px-4 text-sm font-bold uppercase">
        <a href="{{ route('admin.dashboard') }}" class="block rounded-md px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-white text-black' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">Dashboard</a>
        <a href="{{ url('/admin/products') }}" class="block rounded-md px-4 py-3 {{ request()->is('admin/products*') ? 'bg-white text-black' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">Products</a>
        <a href="{{ url('/admin/categories') }}" class="block rounded-md px-4 py-3 {{ request()->is('admin/categories*') ? 'bg-white text-black' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">Categories</a>
        <a href="{{ url('/admin/brands') }}" class="block rounded-md px-4 py-3 {{ request()->is('admin/brands*') ? 'bg-white text-black' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">Brands</a>
        <a href="{{ url('/admin/orders') }}" class="block rounded-md px-4 py-3 {{ request()->is('admin/orders*') ? 'bg-white text-black' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">Orders</a>
        <a href="{{ url('/admin/banners') }}" class="block rounded-md px-4 py-3 {{ request()->is('admin/banners*') ? 'bg-white text-black' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">Banners</a>
        <a href="{{ url('/admin/coupons') }}" class="block rounded-md px-4 py-3 {{ request()->is('admin/coupons*') ? 'bg-white text-black' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">Coupons</a>
        <a href="{{ url('/admin/reviews') }}" class="block rounded-md px-4 py-3 {{ request()->is('admin/reviews*') ? 'bg-white text-black' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">Reviews</a>
    </nav>

    <form method="POST" action="{{ route('logout') }}" class="absolute bottom-6 left-4 right-4">
        @csrf
        <button type="submit" class="w-full rounded-md border border-white/20 px-4 py-3 text-left text-sm font-bold uppercase text-white/70 transition hover:bg-white hover:text-black">
            Logout
        </button>
    </form>
</aside>
    </nav>

    <form method="POST" action="{{ route('logout') }}" class="absolute bottom-6 left-4 right-4">
        @csrf
        <button type="submit" class="w-full rounded-md border border-white/20 px-4 py-3 text-left text-sm font-bold uppercase text-white/70 transition hover:bg-white hover:text-black">
            Logout
        </button>
    </form>
</aside>
