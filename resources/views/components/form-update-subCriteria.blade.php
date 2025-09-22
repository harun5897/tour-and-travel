<form action="{{ url('/update-sub-criteria/' . $subCriteria->id) }}" method="POST" class="p-6 mx-6 bg-white mt-5">
    @csrf
    @method('PUT')

    <div class="w-1/2">
        <h1 class="text-xl mb-4 font-semibold">Form Update Sub Criteria</h1>
        <select name="id_criteria" id="id_criteria"
            class="rounded border focus:outline-none focus:border-blue-500 p-2 text-base w-full mb-3
            {{ $errors->has('id_criteria') ? 'border-red-500' : 'border-gray-300' }}"
            required>
            <option value="">-- Choose Criteria --</option>
            @foreach ($criterias as $criteria)
                <option value="{{ $criteria->id }}"
                    {{ (old('id_criteria') ?? $subCriteria->id_criteria) == $criteria->id ? 'selected' : '' }}>
                    {{ $criteria->criteria }}
                </option>
            @endforeach
        </select>
        @error('id_criteria')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <input name="sub_criteria" id="sub_criteria"
            type="text"
            class="rounded border focus:outline-none focus:border-blue-500 p-2 text-base w-full mb-3
            {{ $errors->has('sub_criteria') ? 'border-red-500' : 'border-gray-300' }}"
            placeholder="Input sub criteria"
            value="{{ old('sub_criteria') ?? $subCriteria->sub_criteria }}"
            required
        />
        @error('sub_criteria')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <input name="value" id="value"
            type="number" step="0.01"
            class="rounded border focus:outline-none focus:border-blue-500 p-2 text-base w-full mb-3
            {{ $errors->has('value') ? 'border-red-500' : 'border-gray-300' }}"
            placeholder="Input value"
            value="{{ old('value') ?? $subCriteria->value }}"
            required
        />
        @error('value')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <div class="flex justify-end gap-2">
            <a href="/sub-criterias" class="text-base bg-red-500 hover:bg-red-600 px-4 py-1 text-white rounded">Cancel</a>
            <button type="submit" class="text-base bg-blue-500 hover:bg-blue-600 px-4 py-1 text-white rounded">Update</button>
        </div>
    </div>
</form>
