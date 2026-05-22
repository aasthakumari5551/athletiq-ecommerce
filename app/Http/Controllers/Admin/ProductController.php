<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['brand', 'category'])->latest()->paginate(12);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create', [
            'brands' => Brand::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
            'product' => new Product(['is_active' => true]),
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        $data = $this->productData($request);
        $product = Product::create($data);

        $this->storeImages($request, $product);
        $this->syncVariants($request, $product);

        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        $product->load(['variants', 'images']);

        return view('admin.products.edit', [
            'product' => $product,
            'brands' => Brand::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function show(Product $product)
    {
        return redirect()->route('admin.products.edit', $product);
    }

    public function update(StoreProductRequest $request, Product $product)
    {
        $product->update($this->productData($request));
        $this->storeImages($request, $product);
        $this->syncVariants($request, $product);

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return back()->with('success', 'Product deleted.');
    }

    private function productData(StoreProductRequest $request): array
    {
        $data = $request->validated();

        return [
            'brand_id' => $data['brand_id'],
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'slug' => $data['slug'] ?: Str::slug($data['name']),
            'description' => $data['description'] ?? null,
            'price' => $data['price'],
            'sale_price' => $data['sale_price'] ?? null,
            'stock' => $data['stock'],
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active'),
        ];
    }

    private function storeImages(StoreProductRequest $request, Product $product): void
    {
        if (! $request->hasFile('images')) {
            return;
        }

        $start = $product->images()->count();
        foreach ($request->file('images') as $i => $file) {
            $product->images()->create([
                'path' => $file->store('products', 'public'),
                'is_primary' => $start === 0 && $i === 0,
                'sort_order' => $start + $i,
            ]);
        }
    }

    private function syncVariants(StoreProductRequest $request, Product $product): void
    {
        $product->variants()->delete();

        foreach ($request->input('variants', []) as $variant) {
            if (empty($variant['size'])) {
                continue;
            }

            $product->variants()->create([
                'size' => $variant['size'],
                'stock' => $variant['stock'] ?? 0,
                'sku' => Str::upper(Str::slug($product->slug.'-'.$variant['size'].'-'.Str::random(5))),
            ]);
        }
    }
}
