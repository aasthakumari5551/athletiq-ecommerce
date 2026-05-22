<?php

namespace App\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductFilter
{
    public function apply(Builder $query, Request $request): Builder
    {
        return $query
            ->when($request->q, fn (Builder $q, string $value) => $q->where('name', 'like', "%{$value}%"))
            ->when($request->brand, function (Builder $q, string $value) {
                $q->where(function (Builder $query) use ($value) {
                    $query->whereHas('brand', fn (Builder $brand) => $brand->where('slug', $value))
                        ->when(is_numeric($value), fn (Builder $idQuery) => $idQuery->orWhere('brand_id', $value));
                });
            })
            ->when($request->category, function (Builder $q, string $value) {
                $q->where(function (Builder $query) use ($value) {
                    $query->whereHas('category', fn (Builder $category) => $category->where('slug', $value))
                        ->when(is_numeric($value), fn (Builder $idQuery) => $idQuery->orWhere('category_id', $value));
                });
            })
            ->when($request->min_price, fn (Builder $q, string $value) => $q->where('price', '>=', $value))
            ->when($request->max_price, fn (Builder $q, string $value) => $q->where('price', '<=', $value))
            ->when($request->sort === 'price_asc', fn (Builder $q) => $q->orderBy('price'))
            ->when($request->sort === 'price_desc', fn (Builder $q) => $q->orderByDesc('price'))
            ->when($request->sort === 'newest', fn (Builder $q) => $q->latest())
            ->when(! $request->sort, fn (Builder $q) => $q->latest())
            ->where('is_active', true);
    }
}
