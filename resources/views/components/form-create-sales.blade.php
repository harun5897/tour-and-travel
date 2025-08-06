<form action="{{ url('/create-sales') }}" method="POST" class="p-6 mx-6 bg-white mt-5">
    @csrf
    <div class="w-1/2">
        <h1 class="text-xl mb-4 font-semibold">Form Create Sales</h1>
        <input name="name"
            type="text"
            class="rounded border focus:outline-none focus:border-blue-500 p-2 text-base w-full mb-3 {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }}"
            placeholder="Input name"
            value="{{ old('name') }}"
        />
        @error('name')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <input name="phone_number"
            type="number"
            class="rounded border focus:outline-none focus:border-blue-500 p-2 text-base w-full mb-3 {{ $errors->has('phone_number') ? 'border-red-500' : 'border-gray-300' }}"
            placeholder="Input phone number"
            value="{{ old('phone_number') }}"
        />
        @error('phone_number')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <input name="email"
            type="email"
            class="rounded border focus:outline-none focus:border-blue-500 p-2 text-base w-full mb-3 {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }}"
            placeholder="Input email"
            value="{{ old('email') }}"
        />
        @error('email')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <input name="address"
            type="text"
            class="rounded border focus:outline-none focus:border-blue-500 p-2 text-base w-full mb-3 {{ $errors->has('address') ? 'border-red-500' : 'border-gray-300' }}"
            placeholder="Input address"
            value="{{ old('address') }}"
        />
        @error('address')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <div class="flex justify-end gap-2">
            <a href="/sales" class="text-base bg-red-500 hover:bg-red-600 px-4 py-1 text-white rounded">Cancel</a>
            <button type="submit" class="text-base bg-blue-500 hover:bg-blue-600 px-4 py-1 text-white rounded">Save</button>
        </div>
    </div>
</form>
