<form method="POST" action="{{ $action }}" class="space-y-6 border border-gray-200 bg-white p-6 max-w-2xl">
    @csrf
    @if($method !== 'POST') @method($method) @endif

    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label class="text-xs font-black uppercase text-gray-500">Code</label>
            <input name="code" value="{{ old('code', $coupon->code) }}" class="mt-2 w-full border-gray-300 uppercase focus:border-black focus:ring-black" placeholder="SAVE20">
            @error('code')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="text-xs font-black uppercase text-gray-500">Type</label>
            <select name="type" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black">
                <option value="percent" @selected(old('type', $coupon->type) === 'percent')>Percentage (%)</option>
                <option value="fixed"   @selected(old('type', $coupon->type) === 'fixed')>Fixed Amount (Rs.)</option>
            </select>
        </div>

        <div>
            <label class="text-xs font-black uppercase text-gray-500">Value</label>
            <input type="number" step="0.01" name="value" value="{{ old('value', $coupon->value) }}" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black" placeholder="20">
            @error('value')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="text-xs font-black uppercase text-gray-500">Min Order Amount</label>
            <input type="number" step="0.01" name="min_order" value="{{ old('min_order', $coupon->min_order) }}" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black" placeholder="0">
        </div>

        <div>
            <label class="text-xs font-black uppercase text-gray-500">Max Uses (optional)</label>
            <input type="number" name="max_uses" value="{{ old('max_uses', $coupon->max_uses) }}" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black" placeholder="Unlimited">
        </div>

        <div>
            <label class="text-xs font-black uppercase text-gray-500">Expires At (optional)</label>
            <input type="date" name="expires_at" value="{{ old('expires_at', $coupon->expires_at?->format('Y-m-d')) }}" class="mt-2 w-full border-gray-300 focus:border-black focus:ring-black">
        </div>
    </div>

    <div>
        <label class="flex items-center gap-2 text-sm font-bold">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $coupon->is_active ?? true))> Active
        </label>
    </div>

    <button class="bg-black px-6 py-3 text-sm font-black uppercase text-white">Save Coupon</button>
    <a href="{{ route('admin.coupons.index') }}" class="ml-4 text-sm font-black uppercase underline">Cancel</a>
</form>