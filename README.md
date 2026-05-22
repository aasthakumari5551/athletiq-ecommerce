Athletiq
Multi-Brand Sportswear Store
Laravel 12  |  MySQL  |  Blade  |  Tailwind CSS
Nike-Style UI  |  Multi-Brand  |  Brand-by-Brand Product Pages  |  Custom Admin Panel


You are building Athletiq — a Nike-style, multi-brand sportswear store. Users can browse all products, filter by brand (Nike, Adidas, Puma, New Balance, etc.), category, and price. Every brand has a dedicated storefront page. The admin panel is built in pure Blade + Tailwind — no external package.

Tech Stack
Framework	Laravel 12

Database	MySQL 8+

Frontend	Blade Templates   |   Tailwind CSS v3   |   Alpine.js (CDN)

Auth	Laravel Breeze (Blade stack)

Storage	local disk + storage:link  (swap to S3 later)

UI Library	Flowbite (Tailwind components, free)


What Makes It Nike-Style
•	Full-width dark hero section with bold white typography
•	Black/white/gray dominant palette — accent color only for CTAs
•	Large product images, minimal UI chrome
•	Bold uppercase brand names as section headings
•	Clean sans-serif throughout — Inter or DM Sans via Google Fonts
•	Sticky navbar with transparent-to-black scroll effect (Alpine.js)
•	Hover: product image zoom + quick-view overlay


Complete Database Schema
14 tables total. Create migrations in this exact order to avoid foreign key errors.

Migration Order
1.	users (from Breeze)
2.	categories
3.	brands
4.	products
5.	product_images
6.	product_variants  (sizes: S/M/L or 7/8/9/10)
7.	banners
8.	carts
9.	cart_items
10.	orders
11.	order_items
12.	addresses
13.	wishlists
14.	reviews

Full Table Reference
Table Name	Key Columns	Notes
users	id, name, email, password, role(enum:user/admin)	Add role column to Breeze migration
categories	id, name, slug, image, description, is_active	Shoes / Apparel / Accessories
brands	id, name, slug, logo, description, is_featured, is_active	Nike, Adidas, Puma etc.
products	id, brand_id, category_id, name, slug, description, price, sale_price, stock, is_featured, is_active	Core product table
product_images	id, product_id, path, is_primary, sort_order	Multiple images per product
product_variants	id, product_id, size, stock, sku	Shoe sizes or S/M/L
banners	id, title, subtitle, image, link, sort_order, is_active	Home page hero banners
carts	id, user_id (nullable), session_id, created_at	Supports guest + auth carts
cart_items	id, cart_id, product_id, variant_id, quantity, price	Snapshot price at add time
orders	id, user_id, total, subtotal, status(enum), payment_method, notes	COD default
order_items	id, order_id, product_id, variant_id, qty, price, product_name	Snapshot name+price
addresses	id, order_id, name, phone, address, city, state, pincode	Shipping address
wishlists	id, user_id, product_id	Optional — build if time allows
reviews	id, user_id, product_id, rating, body, is_approved	Optional — build if time allows



Production Folder Structure
app/
  Http/
    Controllers/
      HomeController.php
      ProductController.php
      BrandController.php
      CartController.php
      CheckoutController.php
      OrderController.php
      WishlistController.php
      Admin/
        DashboardController.php
        ProductController.php
        CategoryController.php
        BrandController.php
        OrderController.php
        BannerController.php
    Middleware/
      AdminMiddleware.php
    Requests/
      Admin/StoreProductRequest.php
      Admin/UpdateOrderRequest.php
      StoreCheckoutRequest.php
  Models/
    User.php  Product.php  Brand.php  Category.php
    Order.php  OrderItem.php  Cart.php  CartItem.php
    Banner.php  Address.php  ProductImage.php  ProductVariant.php
  Services/
    CartService.php          <- all cart logic here
    OrderService.php         <- order creation logic here
  QueryBuilders/
    ProductFilter.php        <- search/filter/sort

resources/views/
  layouts/
    app.blade.php            <- user layout (navbar + footer)
    admin.blade.php          <- admin layout (sidebar)
    guest.blade.php          <- login/register
  components/
    product-card.blade.php
    brand-card.blade.php
    navbar.blade.php
    footer.blade.php
    admin/sidebar.blade.php
    admin/stat-card.blade.php
  home/index.blade.php
  products/index.blade.php
  products/show.blade.php
  brands/index.blade.php
  brands/show.blade.php
  cart/index.blade.php
  checkout/index.blade.php
  checkout/success.blade.php
  orders/index.blade.php
  orders/show.blade.php
  admin/dashboard.blade.php
  admin/products/(index/create/edit).blade.php
  admin/categories/(index/create/edit).blade.php
  admin/brands/(index/create/edit).blade.php
  admin/orders/(index/show).blade.php
  admin/banners/(index/create/edit).blade.php

routes/
  web.php                   <- user routes
  admin.php                 <- admin routes (included in web.php)



Route Map
User Routes (routes/web.php)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
Route::get('/brands/{slug}', [BrandController::class, 'show'])->name('brands.show');
Route::prefix('cart')->name('cart.')->group(function () {
  Route::get('/', [CartController::class, 'index'])->name('index');
  Route::post('/add', [CartController::class, 'add'])->name('add');
  Route::patch('/update', [CartController::class, 'update'])->name('update');
  Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('remove');
});
Route::middleware('auth')->group(function () {
  Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
  Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
  Route::get('/checkout/success/{order}', [CheckoutController::class, 'success']);
  Route::resource('orders', OrderController::class)->only(['index','show']);
});

Admin Routes (routes/admin.php)
Route::prefix('admin')->name('admin.')->middleware(['auth','admin'])->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::resource('products', ProductController::class);
  Route::resource('categories', CategoryController::class);
  Route::resource('brands', BrandController::class);
  Route::resource('orders', OrderController::class)->only(['index','show','update']);
  Route::resource('banners', BannerController::class);
});



Phase-by-Phase Build Plan
Follow phases in order. Do not skip phase 1 or 2. Each phase builds on the last.

P1	Foundation, Auth & Layouts
Day 1 — Morning	~2 hrs

Goal
Scaffold the project, configure Tailwind with Nike-style design tokens, run all base migrations, set up auth, create AdminMiddleware, and build both layout shells. Nothing user-visible yet — this is your entire skeleton.

Step-by-Step Commands
15.	laravel new strikezone --breeze --stack=blade --pest
16.	composer require laravel/breeze && php artisan breeze:install blade
17.	npm install -D tailwindcss@3 flowbite && npm install && npm run dev
18.	Add "role" enum column to users migration before php artisan migrate
19.	php artisan make:middleware AdminMiddleware
20.	php artisan make:controller Admin/DashboardController
21.	php artisan storage:link
22.	Create routes/admin.php and require it at the bottom of web.php

AdminMiddleware — exact code
public function handle($request, Closure $next) {
  if (auth()->check() && auth()->user()->role === "admin") {
    return $next($request);
  }
  abort(403);
}

Register middleware in bootstrap/app.php
->withMiddleware(function (Middleware $middleware) {
  $middleware->alias(['admin' => AdminMiddleware::class]);
})

tailwind.config.js — Nike-style tokens
content: ['./resources/**/*.blade.php', './resources/**/*.js', './node_modules/flowbite/**/*.js'],
theme: { extend: {
  fontFamily: { sans: ['DM Sans', 'sans-serif'] },
  colors: {
    brand: { DEFAULT: '#111111', light: '#f5f5f5', accent: '#E5E5E5' },
    cta:   '#111111',
  },
  fontSize: { hero: ['4.5rem', { lineHeight: '1' }] },
}},
plugins: [require('flowbite/plugin')],

layouts/app.blade.php structure
•	Sticky navbar: logo left, nav links center, cart icon + auth right
•	Alpine.js scroll listener: bg-transparent to bg-black after 80px scroll
•	@yield("content") in main body
•	Footer: brand links grid, copyright, social icons
•	Load DM Sans from Google Fonts in <head>

layouts/admin.blade.php structure
•	Fixed left sidebar 240px: logo, nav items with icons, logout
•	Main content area: ml-60, white bg
•	Top bar: page title + user avatar dropdown
•	Use Flowbite sidebar component as base

Files Created This Phase
•	app/Http/Middleware/AdminMiddleware.php
•	resources/views/layouts/app.blade.php
•	resources/views/layouts/admin.blade.php
•	resources/views/layouts/guest.blade.php
•	resources/views/components/navbar.blade.php
•	resources/views/components/footer.blade.php
•	resources/views/components/admin/sidebar.blade.php
•	routes/admin.php
•	tailwind.config.js (updated)



P2	Product Catalog + Brand Pages
Day 1 — Midday	~3 hrs

Goal
Build all product browsing — home page hero, brands listing, brand-specific pages, product listing with search/filter/sort, and product detail. This is the heart of the storefront.

Migrations to Create
23.	php artisan make:migration create_categories_table
24.	php artisan make:migration create_brands_table
25.	php artisan make:migration create_products_table
26.	php artisan make:migration create_product_images_table
27.	php artisan make:migration create_product_variants_table
28.	php artisan make:migration create_banners_table
29.	php artisan migrate

Models to Create
php artisan make:model Category -f
php artisan make:model Brand -f
php artisan make:model Product -f
php artisan make:model ProductImage
php artisan make:model ProductVariant
php artisan make:model Banner

Product Model — key relationships
public function brand()    { return $this->belongsTo(Brand::class); }
public function category() { return $this->belongsTo(Category::class); }
public function images()   { return $this->hasMany(ProductImage::class); }
public function variants() { return $this->hasMany(ProductVariant::class); }
public function primaryImage() {
  return $this->hasOne(ProductImage::class)->where("is_primary", true);
}

ProductFilter.php — clean query builder
class ProductFilter {
  public function apply(Builder $query, Request $request): Builder {
    return $query
      ->when($request->q, fn($q, $v) => $q->where("name", "like", "%$v%"))
      ->when($request->brand, fn($q, $v) => $q->where("brand_id", $v))
      ->when($request->category, fn($q, $v) => $q->where("category_id", $v))
      ->when($request->min_price, fn($q, $v) => $q->where("price", ">=", $v))
      ->when($request->max_price, fn($q, $v) => $q->where("price", "<=", $v))
      ->when($request->sort === "price_asc", fn($q) => $q->orderBy("price"))
      ->when($request->sort === "price_desc", fn($q) => $q->orderByDesc("price"))
      ->when($request->sort === "newest", fn($q) => $q->latest())
      ->where("is_active", true);
  }
}

Controllers to Create
php artisan make:controller HomeController
php artisan make:controller ProductController
php artisan make:controller BrandController

Views to Build
•	home/index.blade.php — full-width dark hero, featured brands row, new arrivals grid
•	brands/index.blade.php — brand logo grid, "Shop [Brand]" CTA per card
•	brands/show.blade.php — brand hero image + name, filtered product grid below
•	products/index.blade.php — filter sidebar left, product grid right, search bar top
•	products/show.blade.php — image gallery, size picker (variant selector), add to cart
•	components/product-card.blade.php — reusable: image, brand, name, price, hover overlay

Home Page Nike-Style Structure
30.	Hero: full-viewport dark section, bold white headline, two CTA buttons
31.	Featured Brands: horizontal scroll strip with brand logos
32.	New Arrivals: 4-col product grid with "Shop All" link
33.	Sale Banner: full-width red/black strip
34.	Shop by Category: 3-col image cards (Shoes / Apparel / Accessories)
35.	Footer: full-width black, brand links, social icons

Brand Show Page Pattern
// BrandController@show
public function show(string $slug) {
  $brand = Brand::where('slug', $slug)->firstOrFail();
  $products = (new ProductFilter)->apply(
    $brand->products()->with(['primaryImage', 'brand']),
    request()
  )->paginate(16);
  return view('brands.show', compact('brand', 'products'));
}

Files Created This Phase
•	app/Models/Product.php, Brand.php, Category.php, Banner.php, ProductImage.php, ProductVariant.php
•	app/Http/Controllers/HomeController.php
•	app/Http/Controllers/ProductController.php
•	app/Http/Controllers/BrandController.php
•	app/QueryBuilders/ProductFilter.php
•	database/factories/ProductFactory.php, BrandFactory.php
•	resources/views/home/index.blade.php
•	resources/views/brands/index.blade.php  +  show.blade.php
•	resources/views/products/index.blade.php  +  show.blade.php
•	resources/views/components/product-card.blade.php



P3	Cart, Checkout & Orders
Day 1 — Evening	~3 hrs

Goal
Full transactional flow. Session-based cart (works for guests too), checkout with address capture, order creation inside a DB transaction, order confirmation, and authenticated order history.

Migrations to Create
36.	php artisan make:migration create_carts_table
37.	php artisan make:migration create_cart_items_table
38.	php artisan make:migration create_orders_table
39.	php artisan make:migration create_order_items_table
40.	php artisan make:migration create_addresses_table
41.	php artisan migrate

CartService — full pattern
class CartService {
  private string $key = "cart";

  public function add(Product $product, int $variantId, int $qty = 1): void {
    $cart = session($this->key, []);
    $itemKey = $product->id . "_" . $variantId;
    if (isset($cart[$itemKey])) {
      $cart[$itemKey]["qty"] += $qty;
    } else {
      $cart[$itemKey] = [
        "product_id"  => $product->id,
        "variant_id"  => $variantId,
        "name"        => $product->name,
        "price"       => $product->sale_price ?? $product->price,
        "image"       => $product->primaryImage->path ?? null,
        "qty"         => $qty,
      ];
    }
    session([$this->key => $cart]);
  }

  public function remove(string $itemKey): void {
    $cart = session($this->key, []);
    unset($cart[$itemKey]);
    session([$this->key => $cart]);
  }

  public function items(): array  { return session($this->key, []); }
  public function count(): int    { return array_sum(array_column($this->items(), "qty")); }
  public function total(): float  { return array_sum(array_map(fn($i) => $i["price"] * $i["qty"], $this->items())); }
  public function clear(): void   { session()->forget($this->key); }
}

Bind CartService in AppServiceProvider
// app/Providers/AppServiceProvider.php boot()
$this->app->singleton(CartService::class);
view()->composer('*', function($view) {
  $view->with('cartCount', app(CartService::class)->count());
});

CheckoutController@store — DB transaction pattern
public function store(StoreCheckoutRequest $request) {
  return DB::transaction(function () use ($request) {
    $cart = app(CartService::class);
    $order = Order::create([
      "user_id"        => auth()->id(),
      "subtotal"       => $cart->total(),
      "total"          => $cart->total(),
      "status"         => "pending",
      "payment_method" => "cod",
    ]);
    foreach ($cart->items() as $item) {
      $order->items()->create([...]);
      // decrement stock
      ProductVariant::find($item["variant_id"])->decrement("stock", $item["qty"]);
    }
    Address::create(array_merge($request->validated(), ["order_id" => $order->id]));
    $cart->clear();
    return redirect()->route("checkout.success", $order)->with("success", "Order placed!");
  });
}

Views to Build
•	cart/index.blade.php — items table, qty stepper (Alpine), subtotal, checkout button
•	checkout/index.blade.php — 2-col: shipping form left, order summary right
•	checkout/success.blade.php — dark confirmation screen, order number, "Continue Shopping"
•	orders/index.blade.php — table: order#, date, total, status badge, view button
•	orders/show.blade.php — items list, shipping address, status timeline

Files Created This Phase
•	app/Services/CartService.php
•	app/Services/OrderService.php
•	app/Http/Controllers/CartController.php
•	app/Http/Controllers/CheckoutController.php
•	app/Http/Controllers/OrderController.php
•	app/Http/Requests/StoreCheckoutRequest.php
•	app/Models/Order.php, OrderItem.php, Cart.php, CartItem.php, Address.php
•	resources/views/cart/index.blade.php
•	resources/views/checkout/index.blade.php  +  success.blade.php
•	resources/views/orders/index.blade.php  +  show.blade.php



P4	Admin Panel
Day 2 — Morning	~3 hrs

Goal
Full custom admin panel under /admin. Standard Blade forms — no Livewire, no Filament. One shared layout with sidebar. Priority: products, orders, brands. Category and banner management are quick wins.

Dashboard — stat cards
// Admin/DashboardController@index
$stats = [
  'revenue'  => Order::where('status', '!=', 'cancelled')->sum('total'),
  'orders'   => Order::count(),
  'products' => Product::count(),
  'users'    => User::where('role', 'user')->count(),
];
// Recent 5 orders
$recent = Order::with(['user', 'address'])->latest()->take(5)->get();

Build Order — Admin Controllers
42.	Admin/DashboardController — dashboard stats
43.	Admin/CategoryController — resource (CRUD, no image needed, fastest)
44.	Admin/BrandController — resource + logo upload
45.	Admin/ProductController — resource + multi-image upload + variant rows
46.	Admin/OrderController — index + show + update (status change only)
47.	Admin/BannerController — resource + image upload + active toggle

Product Create/Edit Form
•	Name, slug (auto-generate from name with JS), description (textarea)
•	Brand dropdown, Category dropdown
•	Price, Sale Price, Stock inputs
•	Is Featured, Is Active toggles
•	Multiple image upload: <input type="file" multiple> → store in product_images
•	Variant rows: size + stock pairs, add/remove rows with Alpine.js x-for

Image Upload Pattern
// In Admin/ProductController@store
if ($request->hasFile("images")) {
  foreach ($request->file("images") as $i => $file) {
    $path = $file->store("products", "public");
    $product->images()->create([
      "path"       => $path,
      "is_primary" => $i === 0,
      "sort_order" => $i,
    ]);
  }
}

Order Status Update
// Admin/OrderController@update
$order->update(["status" => $request->validated()["status"]]);
// Status enum: pending | processing | shipped | delivered | cancelled

Admin Sidebar Nav Items
•	Dashboard — /admin/dashboard
•	Products — /admin/products
•	Categories — /admin/categories
•	Brands — /admin/brands
•	Orders — /admin/orders
•	Banners — /admin/banners

Files Created This Phase
•	app/Http/Controllers/Admin/ (all 6 controllers)
•	app/Http/Requests/Admin/StoreProductRequest.php
•	app/Http/Requests/Admin/UpdateOrderRequest.php
•	resources/views/admin/dashboard.blade.php
•	resources/views/admin/products/ (index, create, edit)
•	resources/views/admin/categories/ (index, create, edit)
•	resources/views/admin/brands/ (index, create, edit)
•	resources/views/admin/orders/ (index, show)
•	resources/views/admin/banners/ (index, create, edit)
•	resources/views/components/admin/stat-card.blade.php



P5	Polish, Seed & Deploy Prep
Day 2 — Evening	~2 hrs

Goal
Seed realistic data, polish UI rough edges, add flash messages, handle 404/403 pages, add basic SEO meta tags, and do a final production checklist pass.

Seeders to Build
48.	DatabaseSeeder — calls all seeders in correct order
49.	UserSeeder — 1 admin (role=admin) + 10 users
50.	CategorySeeder — Shoes, Apparel, Accessories
51.	BrandSeeder — Nike, Adidas, Puma, New Balance, Under Armour
52.	ProductSeeder — 60 products (12 per brand, spread across categories)
53.	BannerSeeder — 3 home banners
php artisan db:seed

UI Polish Checklist
•	Flash messages: @if(session("success")) toast component @endif in app.blade.php
•	Form validation errors: @error("field") red text below each input @enderror
•	Empty states: "No products found" with a search reset link
•	Loading states: disable submit button on checkout form submit
•	404 page: resources/views/errors/404.blade.php — on-brand dark page
•	403 page: resources/views/errors/403.blade.php
•	Active nav link highlighting: request()->routeIs("products.*") → add active class

Production .env Checklist
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
DB_CONNECTION=mysql
SESSION_DRIVER=database  (run: php artisan session:table)
QUEUE_CONNECTION=sync    (for now)
CACHE_STORE=file

Final Commands
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
npm run build



Priority & Skip Guide

Must Build — Non-Negotiable (Core e-commerce loop)
•	Auth (login/register/logout) — Phase 1
•	Product listing + detail page — Phase 2
•	Brand-by-brand pages — Phase 2
•	Add to cart + cart page — Phase 3
•	Checkout + order creation — Phase 3
•	Admin: Product CRUD — Phase 4
•	Admin: Order management — Phase 4


Build If Time Allows
•	Wishlist (heart icon per product, /wishlist page)
•	Product reviews (rating stars, comment form)
•	Search suggestions (autocomplete dropdown with Alpine.js)
•	Admin: Banner management
•	Order status email notification (Mailable)
•	Product variant stock validation at checkout


Skip — Not Worth the Time
•	Payment gateway (Stripe/Razorpay) — use COD, add later
•	Coupon/discount system — complex DB logic, low priority
•	Real-time notifications (Pusher/Echo) — overkill for 2 days
•	Multi-currency — not needed
•	Product comparison feature — not core
•	Advanced analytics dashboard — basic counts are enough




Best Free Tailwind UI Libraries

1. Flowbite (Recommended — use this one)
•	Free tier has navbars, modals, dropdowns, tables, forms, badges, toasts
•	Tailwind plugin — zero config, works with your existing setup
•	Install: npm install flowbite, add plugin to tailwind.config.js
•	Use for: admin tables, sidebar, modals, dropdowns, toast notifications

2. DaisyUI
•	Component classes on top of Tailwind (btn, card, badge, drawer)
•	Good for quick prototyping — less design control than Flowbite
•	Use for: product cards, status badges, loading spinners

3. Tailwind UI Components (Tailwind Labs — free examples)
•	https://tailwindui.com/components — free preview components
•	Copy-paste hero sections, nav bars, product grids
•	Best source for Nike-style dark hero sections

Alpine.js — Required
•	Already bundled with Laravel Breeze Blade stack
•	Use for: cart qty stepper, navbar scroll effect, product image gallery
•	Use for: filter sidebar toggle on mobile, variant size selector
•	No Vue or React needed — Alpine handles all interactivity



Quick Reference Commands
Generate all models + migrations at once
php artisan make:model Category -mf
php artisan make:model Brand -mf
php artisan make:model Product -mf
php artisan make:model ProductImage -m
php artisan make:model ProductVariant -m
php artisan make:model Banner -mf
php artisan make:model Cart -m
php artisan make:model CartItem -m
php artisan make:model Order -m
php artisan make:model OrderItem -m
php artisan make:model Address -m

Generate all controllers at once
php artisan make:controller HomeController
php artisan make:controller ProductController --resource
php artisan make:controller BrandController --resource
php artisan make:controller CartController
php artisan make:controller CheckoutController
php artisan make:controller OrderController --resource
php artisan make:controller Admin/DashboardController
php artisan make:controller Admin/ProductController --resource
php artisan make:controller Admin/CategoryController --resource
php artisan make:controller Admin/BrandController --resource
php artisan make:controller Admin/OrderController --resource
php artisan make:controller Admin/BannerController --resource

Useful during development
php artisan route:list --path=admin
php artisan migrate:fresh --seed
php artisan tinker  →  User::first()->update(["role"=>"admin"])
php artisan storage:link
npm run dev  (keep running in separate terminal)



