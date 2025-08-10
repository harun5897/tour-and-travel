<form action="{{ url('/create-report') }}" method="GET" class="p-6 mx-6 bg-white mt-5">
    <div class="w-1/2">
        <h1 class="text-xl mb-4 font-semibold">Create Report</h1>
        <label for="start_date" class="block mb-1 font-medium">Start Date</label>
        <input name="start_date"
            type="date"
            class="rounded border focus:outline-none focus:border-blue-500 p-2 text-base w-full mb-3 {{ $errors->has('start_date') ? 'border-red-500' : 'border-gray-300' }}"
            value="{{ request('start_date') }}"
        />
        @error('start_date')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <label for="end_date" class="block mb-1 font-medium">End Date</label>
        <input name="end_date"
            type="date"
            class="rounded border focus:outline-none focus:border-blue-500 p-2 text-base w-full mb-3 {{ $errors->has('end_date') ? 'border-red-500' : 'border-gray-300' }}"
            value="{{ request('end_date') }}"
        />
        @error('end_date')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <div class="flex justify-end gap-2">
            <button type="submit" class="text-base bg-blue-500 hover:bg-blue-600 px-4 py-1 text-white rounded">Save</button>
        </div>
    </div>
</form>
