@php
    $variants = old('variants', $product->exists ? $product->variants->map(fn ($v) => ['size' => $v->size, 'stock' => $v->stock])->values()->all() : [['size' => '', 'stock' => 0]]);
@endphp

<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-6 border border-gray-200 bg-white p-6" x-data="{ variants: @js($variants) }">
    @csrf
    @if ($method !== 'POST') @method($method) @endif

    <div class="grid gap-6 md:grid-cols-2">
        <div><label class="text-xs font-black uppercase text-gray-500">Name</label><input name="name" value="{{ old('name', $product->name) }}" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black">@error('name')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
        <div><label class="text-xs font-black uppercase text-gray-500">Slug</label><input name="slug" value="{{ old('slug', $product->slug) }}" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black">@error('slug')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
        <div><label class="text-xs font-black uppercase text-gray-500">Brand</label><select name="brand_id" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black">@foreach ($brands as $brand)<option value="{{ $brand->id }}" @selected(old('brand_id', $product->brand_id) == $brand->id)>{{ $brand->name }}</option>@endforeach</select></div>
        <div><label class="text-xs font-black uppercase text-gray-500">Category</label><select name="category_id" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black">@foreach ($categories as $category)<option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>@endforeach</select></div>
        <div><label class="text-xs font-black uppercase text-gray-500">Price</label><input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black"></div>
        <div><label class="text-xs font-black uppercase text-gray-500">Sale Price</label><input type="number" step="0.01" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black"></div>
        <div><label class="text-xs font-black uppercase text-gray-500">Stock</label><input type="number" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black"></div>
        <div><label class="text-xs font-black uppercase text-gray-500">Gender</label><select name="gender" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black"><option value="unisex" @selected(old('gender', $product->gender) === 'unisex')>Unisex</option><option value="men" @selected(old('gender', $product->gender) === 'men')>Men</option><option value="women" @selected(old('gender', $product->gender) === 'women')>Women</option></select></div>
        <div><label class="text-xs font-black uppercase text-gray-500">Images</label><input type="file" name="images[]" multiple class="mt-2 w-full border border-gray-300 p-2"></div>
    </div>

    <div><label class="text-xs font-black uppercase text-gray-500">Description</label><textarea name="description" rows="5" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black">{{ old('description', $product->description) }}</textarea></div>

    <div>
        <div class="mb-3 flex items-center justify-between"><h2 class="text-sm font-black uppercase">Variants</h2><button type="button" x-on:click="variants.push({ size: '', stock: 0 })" class="text-sm font-black uppercase underline">Add row</button></div>
        <template x-for="(variant, index) in variants" :key="index">
            <div class="mb-3 grid gap-3 md:grid-cols-[1fr_1fr_auto]">
                <input x-bind:name="`variants[${index}][size]`" x-model="variant.size" placeholder="Size" class="border-gray-300 focus:border-black focus:ring-black">
                <input type="number" x-bind:name="`variants[${index}][stock]`" x-model="variant.stock" placeholder="Stock" class="border-gray-300 focus:border-black focus:ring-black">
                <button type="button" x-on:click="variants.splice(index, 1)" class="border border-gray-300 px-4 text-sm font-black uppercase">Remove</button>
            </div>
        </template>
    </div>

    <div class="flex gap-6"><label class="flex items-center gap-2 text-sm font-bold"><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $product->is_featured))> Featured</label><label class="flex items-center gap-2 text-sm font-bold"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active ?? true))> Active</label></div>
    <button class="bg-black px-6 py-3 text-sm font-black uppercase text-white">Save</button>
</form>
