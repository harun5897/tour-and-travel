<form action="{{ url('/update-user/' . $user->id) }}" method="POST" class="p-6 mx-6 bg-white mt-5">
    @csrf
    @method('PUT')
    <div class="w-1/2">
        <h1 class="text-xl mb-4 font-semibold">Form Update User</h1>
        <input name="name"
            type="text"
            class="rounded border border-gray-300 focus:outline-none focus:border-blue-500 p-2 text-base w-full mb-3 {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }}"
            placeholder="Input name"
            value="{{ old('name', $user->name) }}"
        />
        @error('name')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <input name="email"
            type="email"
            class="rounded border border-gray-300 focus:outline-none focus:border-blue-500 p-2 text-base w-full mb-3 {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }}"
            placeholder="Input email"
            value="{{ old('email', $user->email) }}"
        />
        @error('email')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <select name="role"
            class="rounded border border-gray-300 focus:outline-none focus:border-blue-500 p-2 text-base w-full mb-3 {{ $errors->has('role') ? 'border-red-500' : 'border-gray-300' }}">
            <option value="">Select role</option>
            <option value="super_admin" {{ $user->role == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
        @error('role')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <input name="password"
            type="password"
            class="rounded border border-gray-300 focus:outline-none focus:border-blue-500 p-2 text-base w-full mb-3 {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }}"
            placeholder="Input new password (leave blank if not changing)"
        />
        @error('password')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <div class="flex justify-end gap-2">
            <a href="/user" class="text-base bg-red-500 hover:bg-red-600 px-4 py-1 text-white rounded">Cancel</a>
            <button type="submit" class="text-base bg-blue-500 hover:bg-blue-600 px-4 py-1 text-white rounded">Update</button>
        </div>
    </div>
</form>