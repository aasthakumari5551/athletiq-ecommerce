# Athletiq — Multi-Brand Sportswear Store

> A Nike-style multi-brand sportswear storefront built with Laravel 12, featuring brand-specific storefronts, session-based cart, COD checkout, and a fully custom admin panel.

---

## Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 12 |
| Database | MySQL 8+ |
| Frontend | Blade · Tailwind CSS v3 · Alpine.js (CDN) |
| Auth | Laravel Breeze (Blade stack) |
| UI Components | Flowbite |
| Storage | Local disk (`storage:link`) — S3-ready |

---

## Features

- Full-width dark hero with bold white typography — Nike-style aesthetic
- Multi-brand catalog: Nike, Adidas, Puma, New Balance, Under Armour
- Dedicated storefront page per brand with filtered product grid
- Product listing with search, filter (brand / category / price range), and sort
- Product detail with image gallery and size/variant picker
- Session-based cart — works for guests and authenticated users
- COD checkout with address capture inside a DB transaction
- Authenticated order history with status tracking
- Custom admin panel (pure Blade + Tailwind — no Livewire, no Filament)
  - Product CRUD with multi-image upload and variant management
  - Order management with status updates
  - Brand, category, and banner management
  - Dashboard with revenue, order, product, and user stats

---

## Database Schema

14 tables, created in this order to satisfy foreign keys:

| # | Table | Purpose |
|---|---|---|
| 1 | `users` | Auth + role (`user` / `admin`) |
| 2 | `categories` | Shoes · Apparel · Accessories |
| 3 | `brands` | Nike, Adidas, Puma, etc. |
| 4 | `products` | Core product record |
| 5 | `product_images` | Multiple images per product |
| 6 | `product_variants` | Sizes (S/M/L or shoe sizes) + stock |
| 7 | `banners` | Homepage hero banners |
| 8 | `carts` | Guest + authenticated carts |
| 9 | `cart_items` | Line items (price snapshot at add time) |
| 10 | `orders` | Order header (COD default) |
| 11 | `order_items` | Line items (name + price snapshot) |
| 12 | `addresses` | Shipping address per order |
| 13 | `wishlists` | Optional — user saved products |
| 14 | `reviews` | Optional — ratings + comments |

---

## Getting Started

### Prerequisites

- PHP 8.2+
- Composer
- Node.js 18+ & npm
- MySQL 8+

### Installation

```bash
# 1. Clone and install dependencies
git clone https://github.com/aasthakumari5551/athletiq-ecommerce
cd athletiq
composer install
npm install

# 2. Environment setup
cp .env.example .env
php artisan key:generate

# 3. Configure your database in .env, then run migrations + seed
php artisan migrate
php artisan db:seed

# 4. Link storage
php artisan storage:link

# 5. Build assets and start the dev server
npm run dev
php artisan serve
```

The app will be available at `http://localhost:8000`.

### Promote a user to admin

```bash
php artisan tinker
>>> User::first()->update(['role' => 'admin'])
```

Then log in and visit `/admin/dashboard`.

---

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── HomeController.php
│   │   ├── ProductController.php
│   │   ├── BrandController.php
│   │   ├── CartController.php
│   │   ├── CheckoutController.php
│   │   ├── OrderController.php
│   │   └── Admin/
│   │       ├── DashboardController.php
│   │       ├── ProductController.php
│   │       ├── CategoryController.php
│   │       ├── BrandController.php
│   │       ├── OrderController.php
│   │       └── BannerController.php
│   ├── Middleware/
│   │   └── AdminMiddleware.php
│   └── Requests/
│       ├── StoreCheckoutRequest.php
│       └── Admin/
│           ├── StoreProductRequest.php
│           └── UpdateOrderRequest.php
├── Models/
│   └── User · Product · Brand · Category · Order · OrderItem
│       Cart · CartItem · Banner · Address · ProductImage · ProductVariant
├── Services/
│   ├── CartService.php
│   └── OrderService.php
└── QueryBuilders/
    └── ProductFilter.php

resources/views/
├── layouts/          app · admin · guest
├── components/       product-card · brand-card · navbar · footer
│                     admin/sidebar · admin/stat-card
├── home/             index
├── products/         index · show
├── brands/           index · show
├── cart/             index
├── checkout/         index · success
├── orders/           index · show
└── admin/            dashboard · products · categories · brands · orders · banners
```

---

## Routes

### User (`routes/web.php`)

```
GET  /                          Home
GET  /products                  Product listing (search, filter, sort)
GET  /products/{slug}           Product detail
GET  /brands                    All brands
GET  /brands/{slug}             Brand storefront
GET  /cart                      Cart
POST /cart/add                  Add to cart
PATCH /cart/update              Update quantity
DELETE /cart/remove/{id}        Remove item
GET  /checkout          [auth]  Checkout form
POST /checkout          [auth]  Place order
GET  /orders            [auth]  Order history
GET  /orders/{id}       [auth]  Order detail
```

### Admin (`routes/admin.php`) — requires `auth` + `admin`

```
GET  /admin/dashboard
CRUD /admin/products
CRUD /admin/categories
CRUD /admin/brands
     /admin/orders      (index · show · update status)
CRUD /admin/banners
```

---

## Build Phases

| Phase | Goal | Time |
|---|---|---|
| P1 | Scaffold · auth · layouts · AdminMiddleware | ~2 hrs |
| P2 | Product catalog · brand pages · filters | ~3 hrs |
| P3 | Cart · checkout · orders | ~3 hrs |
| P4 | Admin panel (all CRUD) | ~3 hrs |
| P5 | Seeders · UI polish · deploy prep | ~2 hrs |

---

## Seeded Data

After `php artisan db:seed`:

- 1 admin user + 10 regular users
- 3 categories: Shoes · Apparel · Accessories
- 5 brands: Nike · Adidas · Puma · New Balance · Under Armour
- 60 products (12 per brand)
- 3 homepage banners

---

## Production Checklist

```bash
# .env
APP_ENV=production
APP_DEBUG=false
SESSION_DRIVER=database   # php artisan session:table

# Build + cache
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

---

## Optional Features

These are scoped out but wired up for easy addition:

- **Wishlist** — model + routes stubbed, just needs the UI
- **Product reviews** — model + `is_approved` flag ready
- **Search autocomplete** — Alpine.js dropdown on the search bar
- **Order status emails** — add a `Mailable`, trigger in `OrderService`
- **Payment gateway** — swap COD for Stripe/Razorpay in `CheckoutController`

---

Happy Coding...