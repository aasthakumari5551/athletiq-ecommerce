<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="max-w-3xl space-y-5 border border-gray-200 bg-white p-6">
    @csrf
    @if ($method !== 'POST') @method($method) @endif
    <div><label class="text-xs font-black uppercase text-gray-500">Title</label><input name="title" value="{{ old('title', $banner->title) }}" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black">@error('title')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
    <div><label class="text-xs font-black uppercase text-gray-500">Subtitle</label><input name="subtitle" value="{{ old('subtitle', $banner->subtitle) }}" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black"></div>
    <div><label class="text-xs font-black uppercase text-gray-500">Image</label><input type="file" name="image" class="mt-2 w-full border border-gray-300 p-2"></div>
    <div><label class="text-xs font-black uppercase text-gray-500">Link</label><input name="link" value="{{ old('link', $banner->link) }}" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black"></div>
    <div><label class="text-xs font-black uppercase text-gray-500">Sort order</label><input type="number" name="sort_order" value="{{ old('sort_order', $banner->sort_order ?? 0) }}" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black"></div>
    <label class="flex items-center gap-2 text-sm font-bold"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $banner->is_active ?? true))> Active</label>
    <button class="bg-black px-6 py-3 text-sm font-black uppercase text-white">Save</button>
</form>
