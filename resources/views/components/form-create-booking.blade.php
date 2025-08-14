<form action="{{ url('/create-booking') }}" method="POST" class="p-6 mx-6 bg-white mt-5 overflow-y-scroll h-3/4">
    @csrf
    <div class="w-1/2">
        <h1 class="text-xl mb-4 font-semibold">Form Create Booking</h1>
        <label for="form-label" class="font-semibold">Booking Code</label>
        <input name="booking_code"
            type="text"
            class="rounded border p-2 text-base w-full mb-3 mt-2 {{ $errors->has('booking_code') ? 'border-red-500' : 'border-gray-300' }}"
            placeholder="Input booking code"
            value="{{ old('booking_code') }}"
        />
        @error('booking_code')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <label for="form-label" class="font-semibold">Guest Name</label>
        <input name="guest_name"
            type="text"
            class="rounded border p-2 text-base w-full mb-3 mt-2 {{ $errors->has('guest_name') ? 'border-red-500' : 'border-gray-300' }}"
            placeholder="Input guest name"
            value="{{ old('guest_name') }}"
        />
        @error('guest_name')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <label for="form-label" class="font-semibold">Adult</label>
        <input name="total_adult"
            type="number"
            class="rounded border p-2 text-base w-full mb-3 mt-2 {{ $errors->has('total_adult') ? 'border-red-500' : 'border-gray-300' }}"
            placeholder="Total adult"
            value="{{ old('total_adult') }}"
        />
        @error('total_adult')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <label for="form-label" class="font-semibold">Child</label>
        <input name="total_child"
            type="number"
            class="rounded border p-2 text-base w-full mb-3 mt-2 {{ $errors->has('total_child') ? 'border-red-500' : 'border-gray-300' }}"
            placeholder="Total child"
            value="{{ old('total_child') }}"
        />
        @error('total_child')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <label for="form-label" class="font-semibold">Package</label>
        <select name="package_id"
            class="rounded border p-2 text-base w-full mb-3 mt-2 {{ $errors->has('package_id') ? 'border-red-500' : 'border-gray-300' }}">
            <option value="">Select package</option>
            @foreach($packages as $package)
                <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>
                    {{ $package->name }}
                </option>
            @endforeach
        </select>
        @error('package_id')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <label for="form-label" class="font-semibold">Booking Date</label>
        <input name="booking_date"
            type="date"
            class="rounded border p-2 text-base w-full mb-3 mt-2 {{ $errors->has('booking_date') ? 'border-red-500' : 'border-gray-300' }}"
            value="{{ old('booking_date') }}"
        />
        @error('booking_date')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <label for="form-label" class="font-semibold">Arrival Date</label>
        <input name="arrival_date"
            type="date"
            class="rounded border p-2 text-base w-full mb-3 mt-2 {{ $errors->has('arrival_date') ? 'border-red-500' : 'border-gray-300' }}"
            value="{{ old('arrival_date') }}"
        />
        @error('arrival_date')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <label for="form-label" class="font-semibold">Departure Date</label>
        <input name="departure_date"
            type="date"
            class="rounded border p-2 text-base w-full mb-3 mt-2 {{ $errors->has('departure_date') ? 'border-red-500' : 'border-gray-300' }}"
            value="{{ old('departure_date') }}"
        />
        @error('departure_date')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <label for="form-label" class="font-semibold">Price</label>
        <input name="price"
            type="number"
            class="rounded border p-2 text-base w-full mb-3 mt-2 {{ $errors->has('price') ? 'border-red-500' : 'border-gray-300' }}"
            placeholder="Input price"
            value="{{ old('price') }}"
        />
        @error('price')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <label for="form-label" class="font-semibold">Platform</label>
        <select name="platform"
            class="rounded border p-2 text-base w-full mb-3 mt-2 {{ $errors->has('platform') ? 'border-red-500' : 'border-gray-300' }}">
            <option value="">Select platform</option>
            <option value="whatsapp" {{ old('platform') == 'whatsapp' ? 'selected' : '' }}>Whatsapp</option>
            <option value="email" {{ old('platform') == 'email' ? 'selected' : '' }}>Email</option>
            <option value="facebook" {{ old('platform') == 'facebook' ? 'selected' : '' }}>Facebook</option>
            <option value="instagram" {{ old('platform') == 'instagram' ? 'selected' : '' }}>Instagram</option>
        </select>
        @error('platform')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <label for="form-label" class="font-semibold">Sales</label>
        <select name="sales_id"
            class="rounded border p-2 text-base w-full mb-3 mt-2 {{ $errors->has('sales_id') ? 'border-red-500' : 'border-gray-300' }}">
            <option value="">Select sales</option>
            @foreach($sales as $sale)
                <option value="{{ $sale->id }}" {{ old('sales_id') == $sale->id ? 'selected' : '' }}>
                    {{ $sale->name }}
                </option>
            @endforeach
        </select>
        @error('sales_id')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <label for="form-label" class="font-semibold">Status</label>
        <select name="status"
            class="rounded border p-2 text-base w-full mb-3 mt-2 {{ $errors->has('status') ? 'border-red-500' : 'border-gray-300' }}">
            <option value="">Select status</option>
            <option value="not_paid" {{ old('status') == 'not_paid' ? 'selected' : '' }}>Not Paid</option>
            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="cancel" {{ old('status') == 'cancel' ? 'selected' : '' }}>Cancel</option>
            <option value="refund" {{ old('status') == 'refund' ? 'selected' : '' }}>Refund</option>
        </select>
        @error('status')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <div class="flex justify-end gap-2">
            <a href="/bookings" class="text-base bg-red-500 hover:bg-red-600 px-4 py-1 text-white rounded">Cancel</a>
            <button type="submit" class="text-base bg-blue-500 hover:bg-blue-600 px-4 py-1 text-white rounded">Save</button>
        </div>
    </div>
</form>
