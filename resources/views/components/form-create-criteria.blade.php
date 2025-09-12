<form action="{{ url('/create-criteria') }}" method="POST" class="p-6 mx-6 bg-white mt-5">
    @csrf
    <div class="w-1/2">
        <h1 class="text-xl mb-4 font-semibold">Form Create Criteria</h1>
        <input name="criteria"
            type="text"
            class="rounded border focus:outline-none focus:border-blue-500 p-2 text-base w-full mb-3 {{ $errors->has('criteria') ? 'border-red-500' : 'border-gray-300' }}"
            placeholder="Input name criteria"
            value="{{ old('criteria') }}"
        />
        @error('criteria')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <input name="value"
            type="number"
            class="rounded border focus:outline-none focus:border-blue-500 p-2 text-base w-full mb-3 {{ $errors->has('value') ? 'border-red-500' : 'border-gray-300' }}"
            placeholder="Input value criteria"
            value="{{ old('value') }}"
        />
        @error('value')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <div class="flex justify-end gap-2">
            <a href="/criterias" class="text-base bg-red-500 hover:bg-red-600 px-4 py-1 text-white rounded">Cancel</a>
            <button type="submit" class="text-base bg-blue-500 hover:bg-blue-600 px-4 py-1 text-white rounded">Save</button>
        </div>
    </div>
</form>
