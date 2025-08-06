<form action="{{ url('/update-package/' . $package->id) }}" method="POST" class="p-6 mx-6 bg-white mt-5">
    @csrf
    @method('PUT')
    <div class="w-1/2">
        <h1 class="text-xl mb-4 font-semibold">Form Update Package</h1>
        <input name="name"
            type="text"
            class="rounded border p-2 text-base w-full mb-3 {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} focus:outline-none focus:border-blue-500"
            placeholder="Input package name"
            value="{{ old('name', $package->name) }}"
        />
        @error('name')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <select name="category_id"
            class="rounded border p-2 text-base w-full mb-3 {{ $errors->has('category_id') ? 'border-red-500' : 'border-gray-300' }} focus:outline-none focus:border-blue-500">
            <option value="">-- Select Category --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $package->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <textarea name="description"
            class="rounded border p-2 text-base w-full mb-3 {{ $errors->has('description') ? 'border-red-500' : 'border-gray-300' }} focus:outline-none focus:border-blue-500"
            placeholder="Input description">{{ old('description', $package->description) }}</textarea>
        @error('description')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <input name="cost"
            type="number"
            class="rounded border p-2 text-base w-full mb-3 {{ $errors->has('cost') ? 'border-red-500' : 'border-gray-300' }} focus:outline-none focus:border-blue-500"
            placeholder="Input cost"
            value="{{ old('cost', $package->cost) }}"
        />
        @error('cost')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <div class="flex justify-end gap-2">
            <a href="/packages" class="text-base bg-red-500 hover:bg-red-600 px-4 py-1 text-white rounded">Cancel</a>
            <button type="submit" class="text-base bg-blue-500 hover:bg-blue-600 px-4 py-1 text-white rounded">Update</button>
        </div>
    </div>
</form>
