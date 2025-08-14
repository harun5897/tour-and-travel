<div id="login" class="flex justify-center items-center h-screen bg-white">
    <div class="w-1/3">
        <div class="flex justify-center">
            <img
                src="{{ asset('assets/logo.jpg') }}"
                class="max-auto"
                width="150"
                alt="logo-pratama"
            />
        </div>
        <div id="form-login" class="bg-gray-100 p-5 rounded-lg w-full">
            <form action="{{ url('/login') }}" method="POST" class="text-sm flex flex-col gap-4">
                @csrf
                <h1 class="text-xl font-bold text-center">Tour & Travel</h1>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="rounded border p-2 text-base
                        focus:outline-none focus:border-blue-500
                        {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }}"
                    placeholder="Email"
                    required
                />
                @error('email')
                    <p class="text-red-500 text-sm -mt-2">{{ $message }}</p>
                @enderror
                <input
                    type="password"
                    name="password"
                    class="rounded border p-2 text-base
                        focus:outline-none focus:border-blue-500
                        {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }}"
                    placeholder="Password"
                    required
                />
                @error('password')
                    <p class="text-red-500 text-sm -mt-2">{{ $message }}</p>
                @enderror
                @if (session('error'))
                    <p class="text-red-500 text-sm text-center mt-2">{{ session('error') }}</p>
                @endif
                <button type="submit" class="text-base bg-blue-500 hover:bg-blue-600 px-4 py-2 text-white rounded">
                    Sign In
                </button>
            </form>
        </div>
    </div>
</div>
