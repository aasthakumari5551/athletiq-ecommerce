<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="max-w-3xl space-y-5 border border-gray-200 bg-white p-6">
    @csrf
    @if ($method !== 'POST') @method($method) @endif
    <div><label class="text-xs font-black uppercase text-gray-500">Name</label><input name="name" value="{{ old('name', $brand->name) }}" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black">@error('name')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
    <div><label class="text-xs font-black uppercase text-gray-500">Slug</label><input name="slug" value="{{ old('slug', $brand->slug) }}" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black">@error('slug')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
    <div><label class="text-xs font-black uppercase text-gray-500">Logo</label><input type="file" name="logo" class="mt-2 w-full border border-gray-300 p-2"></div>
    <div><label class="text-xs font-black uppercase text-gray-500">Description</label><textarea name="description" rows="4" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black">{{ old('description', $brand->description) }}</textarea></div>
    <div class="flex gap-6"><label class="flex items-center gap-2 text-sm font-bold"><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $brand->is_featured))> Featured</label><label class="flex items-center gap-2 text-sm font-bold"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $brand->is_active ?? true))> Active</label></div>
    <button class="bg-black px-6 py-3 text-sm font-black uppercase text-white">Save</button>
</form>
