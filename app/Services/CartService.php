<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductVariant;

class CartService
{
    private string $key = 'cart';

    public function add(Product $product, ?int $variantId, int $qty = 1): void
    {
        $cart = session($this->key, []);
        $itemKey = $product->id.'_'.($variantId ?? 'default');
        $variant = $variantId ? ProductVariant::find($variantId) : null;

        if (isset($cart[$itemKey])) {
            $cart[$itemKey]['qty'] += $qty;
        } else {
            $cart[$itemKey] = [
                'product_id' => $product->id,
                'variant_id' => $variantId,
                'variant_size' => $variant?->size,
                'name' => $product->name,
                'brand' => $product->brand?->name,
                'price' => (float) ($product->sale_price ?? $product->price),
                'image' => $product->primaryImage?->path,
                'qty' => $qty,
            ];
        }

        session([$this->key => $cart]);
    }

    public function update(string $itemKey, int $qty): void
    {
        $cart = session($this->key, []);

        if (isset($cart[$itemKey])) {
            if ($qty <= 0) {
                unset($cart[$itemKey]);
            } else {
                $cart[$itemKey]['qty'] = $qty;
            }
        }

        session([$this->key => $cart]);
    }

    public function remove(string $itemKey): void
    {
        $cart = session($this->key, []);
        unset($cart[$itemKey]);
        session([$this->key => $cart]);
    }

    public function items(): array
    {
        return session($this->key, []);
    }

    public function count(): int
    {
        return array_sum(array_column($this->items(), 'qty'));
    }

    public function total(): float
    {
        return array_sum(array_map(fn (array $item) => $item['price'] * $item['qty'], $this->items()));
    }

    public function clear(): void
    {
        session()->forget($this->key);
    }
}
